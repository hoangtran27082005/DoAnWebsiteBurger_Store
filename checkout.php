<!DOCTYPE html>
<html lang="en">

<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng đến trang login
if (empty($_SESSION["user_id"])) {
    header('location:login.php');
} else {
    $item_total = 0; // Khởi tạo tổng giá trị đơn hàng

    // Duyệt qua từng sản phẩm trong giỏ hàng và tính tổng
    foreach ($_SESSION["cart_item"] as $item) {
        $item_total += ($item["price"] * $item["quantity"]);
    }

    // Kiểm tra khi form được submit
    if ($_POST['submit']) {
        if ($_POST['mod'] == 'COD') {
            // Lưu từng sản phẩm vào cơ sở dữ liệu khi chọn phương thức COD
            foreach ($_SESSION["cart_item"] as $item) {
                $SQL = "INSERT INTO users_orders(u_id, title, quantity, price) 
                        VALUES('" . $_SESSION["user_id"] . "', 
                               '" . $item["title"] . "', 
                               '" . $item["quantity"] . "', 
                               '" . $item["price"] . "')";
                mysqli_query($db, $SQL);
            }

            // Thông báo đơn hàng đã được đặt thành công
            $success = "Cảm ơn bạn! Đơn hàng đã được đặt thành công!";
        } elseif ($_POST['mod'] == 'momo') {
            // Tạo thanh toán qua MoMo
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = $item_total; // Tổng giá trị đơn hàng
            $orderId = rand(00, 9999);
            $redirectUrl = "http://localhost/Website/your_orders.php";
            $ipnUrl = "http://localhost/Website/your_orders.php";
            $extraData = "";
            $requestId = time() . "";
            $requestType = "payWithATM";

            // Ký HMAC SHA256
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            // Tạo yêu cầu JSON
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );

            // Gửi yêu cầu tới MoMo
            function execPostRequest($url, $data)
            {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($data)
                    )
                );
                $result = curl_exec($ch);
                curl_close($ch);
                return $result;
            }

            // Thực hiện yêu cầu đến MoMo
            $result = execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);

            // Lưu từng sản phẩm vào cơ sở dữ liệu
            foreach ($_SESSION["cart_item"] as $item) {
                $SQL = "INSERT INTO users_orders(u_id, title, quantity, price) 
                        VALUES('" . $_SESSION["user_id"] . "', 
                               '" . $item["title"] . "', 
                               '" . $item["quantity"] . "', 
                               '" . $item["price"] . "')";
                mysqli_query($db, $SQL);
            }

            // Chuyển hướng người dùng đến trang thanh toán của MoMo
            header('Location: ' . $jsonResult['payUrl']);
        } elseif ($_POST['mod'] == 'momoqrcode') {
            // Tạo thanh toán qua MoMo QR Code
            function execPostRequest2($url, $data)
            {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($data)
                    )
                );
                $result = curl_exec($ch);
                curl_close($ch);
                return $result;
            }

            // Tạo thanh toán qua MoMo QR Code
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = $item_total; // Tổng giá trị đơn hàng
            $orderId = rand(00, 9999);
            $redirectUrl = "http://localhost/Website/your_orders.php";
            $ipnUrl = "http://localhost/Website/your_orders.php";
            $extraData = "";
            $requestId = time() . "";
            $requestType = "captureWallet";

            // Ký HMAC SHA256
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            // Tạo yêu cầu JSON
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );

            // Gửi yêu cầu đến MoMo
            $result = execPostRequest2($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);

            // Lưu từng sản phẩm vào cơ sở dữ liệu
            foreach ($_SESSION["cart_item"] as $item) {
                $SQL = "INSERT INTO users_orders(u_id, title, quantity, price) 
                        VALUES('" . $_SESSION["user_id"] . "', 
                               '" . $item["title"] . "', 
                               '" . $item["quantity"] . "', 
                               '" . $item["price"] . "')";
                mysqli_query($db, $SQL);
            }

            // Chuyển hướng người dùng đến trang thanh toán của MoMo
            header('Location: ' . $jsonResult['payUrl']);
        }
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Order Confirmation</title>
        <style>
            .notification {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #4CAF50;
                /* Green color */
                color: white;
                padding: 15px;
                border-radius: 5px;
                z-index: 9999;
                display: none;
                /* Initially hidden */
            }
        </style>
    </head>

    <body>

        <?php if (isset($success)): ?>
            <div class="notification">
                <?php echo $success; ?>
            </div>
            <script>
                // Display notification for a few seconds and then hide it
                var notification = document.querySelector('.notification');
                notification.style.display = 'block';
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 3000);
            </script>
        <?php endif; ?>

    </body>

    </html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Starter Template for Bootstrap</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animsition.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>

        <div class="site-wrapper">
            <header id="header" class="header-scroll top-header headrom">
                <nav class="navbar navbar-dark">
                    <div class="container">
                        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                        <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logoko.png" alt="">
                        </a>
                        <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                            <ul class="nav navbar-nav">
                                <li class="nav-item"> <a class="nav-link active" href="index.php">Trang Chủ <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Quán ăn <span class="sr-only"></span></a> </li>


                                <?php
                                if (empty($_SESSION["user_id"])) // if user is not login
                                {
                                    echo '<li class="nav-item"><a href="login.php" class="nav-link active">Đăng Nhập</a> </li>
                        <li class="nav-item"><a href="registration.php" class="nav-link active">Đăng Ký</a> </li>';
                                } else {
                                    //if user is login

                                    echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Đơn Đặt</a> </li>';
                                    echo '<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> ' . $_SESSION["username"] . '</a>
                                <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                    <ul class="dropdown-user" style="
                                    background-color: white !important;">
                                    <li> <a class="dropdown-item" href="change_password.php"><i class="fa fa-gear"></i> Đổi mật khẩu</a> </li>
                                    <li> <a class="dropdown-item" href="Logout.php"><i class="fa fa-power-off"></i> Đăng Xuất </a> </li>
                                    
                                    </ul>
                                </div>
                              </li>';
                                }

                                ?>

                            </ul>

                        </div>
                    </div>
                </nav>
            </header>
            <div class="page-wrapper">
                <div class="top-links">
                    <div class="container">
                        <ul class="row links">

                            <li class="col-xs-12 col-sm-4 link-item">
                                <span>1</span><a href="restaurants.php">Chọn Nhà
                                    Hàng</a>
                            </li>
                            <li class="col-xs-12 col-sm-4 link-item ">
                                <span>2</span><a href="#">Đặt món ăn yêu thích của
                                    bạn</a>
                            </li>
                            <li class="col-xs-12 col-sm-4 link-item active">
                                <span>3</span><a href="checkout.php">Giao hàng
                                    và thanh toán</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="container">

                    <span style="color:green;">
                        <?php echo $success; ?>
                    </span>
                </div>
                <div class="container m-t-30">
                    <form action="" method="post">
                        <div class="widget clearfix">
                            <div class="widget-body">
                                <form method="post" action="#">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="cart-totals margin-b-20">
                                                <div class="cart-totals-title">
                                                    <h4>Thông tin đơn hàng</h4>
                                                </div>
                                                <div class="cart-totals-fields">

                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Tổng tiền</td>
                                                                <td> <?php echo $item_total . " đ"; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Phí vận chuyển
                                                                </td>
                                                                <td>Miễn phí từ ưu
                                                                    đãi Free Ship
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-color">
                                                                    <strong>Total</strong>
                                                                </td>
                                                                <td class="text-color">
                                                                    <strong>
                                                                        <?php echo $item_total . "đ"; ?></strong>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="payment-option">
                                                <ul class=" list-unstyled">
                                                    <li>
                                                        <label class="custom-control custom-radio  m-b-20">
                                                            <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Thanh
                                                                toán khi nhận
                                                                hàng</span>
                                                            <br> <span>Hãy chắc chắn
                                                                rằng địa chỉ của bạn
                                                                ghi đúng để mấy
                                                                anh shipper giao
                                                                đúng tận nơi</span>
                                                        </label>
                                                    </li>

                                                    <li>
                                                        <label class="custom-control custom-radio  m-b-10">
                                                            <input name="mod" type="radio" value="momoqrcode" class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Thanh
                                                                Toán Momo QR CODE
                                                                <img src="images/momo.jpg" alt="" width="18"></span>
                                                        </label>
                                                    </li>

                                                </ul>
                                                <p class="text-xs-center"> <input type="submit" onclick="return confirm('Are you sure?');" name="submit" class="btn btn-outline-success btn-block" value="Đặt ngay"> </p>
                                            </div>
                                </form>
                            </div>
                        </div>

                </div>
            </div>
            </form>
        </div>
        <section class="app-section">
            <div class="app-wrap">
                <div class="container">
                    <div class="row text-img-block text-xs-left">
                        <div class="container">
                            <div class="col-xs-12 col-sm-6  right-image text-center">
                                <figure> <img src="images/app.png" alt="Right Image"> </figure>
                            </div>
                            <div class="col-xs-12 col-sm-6 left-text">
                                <h3>Ứng dụng giao đồ ăn tốt nhất</h3>
                                <p>Giờ đây, bạn có thể chế biến món ăn ở mọi nơi
                                    bạn cảm ơn sự dễ sử dụng miễn phí
                                    Giao đồ ăn &amp; Ứng dụng mang đi.</p>
                                <div class="social-btns">
                                    <a href="#" class="app-btn apple-button clearfix">
                                        <div class="pull-left"><i class="fa fa-apple"></i> </div>
                                        <div class="pull-right"> <span class="text">Có sẵn trên</span>
                                            <span class="text-2">Cửa hàng ứng dụng</span>
                                        </div>
                                    </a>
                                    <a href="#" class="app-btn android-button clearfix">
                                        <div class="pull-left"><i class="fa fa-android"></i> </div>
                                        <div class="pull-right"> <span class="text">Có sẵn trên</span>
                                            <span class="text-2">Cửa hàng Play</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer">
            <div class="container">
                <!-- top footer statrs -->
                <div class="row top-footer">
                    <div
                        class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                        <a href="#"> <img src="images/logoko.png"
                                alt="Footer logo"> </a> <span>Giao đơn hàng
                            &amp; Mang đi </span>
                    </div>
                    <div class="col-xs-12 col-sm-2 about color-gray">
                        <h5>Giới thiệu về chúng tôi</h5>
                        <li><a href="#">Giới thiệu về chúng tôi</a> </li>
                        <li><a href="#">Lịch sử</a> </li>
                        <li><a href="#">Nhóm của chúng tôi</a> </li>
                        <li><a href="#">Chúng tôi đang tuyển dụng</a> </li>
                        </ul>
                    </div>
                    <div
                        class="col-xs-12 col-sm-2 how-it-works-links color-gray">
                        <h5>Cách thức hoạt động</h5>
                        <ul>
                            <li><a href="#">Nhập vị trí của bạn</a> </li>
                            <li><a href="#">Chọn nhà hàng</a> </li>
                            <li><a href="#">Chọn bữa ăn</a> </li>
                            <li><a href="#">Thanh toán qua thẻ tín dụng</a> </li>
                            <li><a href="#">Chờ giao hàng</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-2 pages color-gray">
                        <h5>Trang</h5>
                        <ul>
                            <li><a href="#">Trang kết quả tìm kiếm</a> </li>
                            <li><a href="#">Trang đăng ký của người dùng</a> </li>
                            <li><a href="#">Trang định giá</a> </li>
                            <li><a href="#">Đặt hàng</a> </li>
                            <li><a href="#">Thêm vào giỏ hàng</a> </li>
                        </ul>
                    </div>
                    <div
                        class="col-xs-12 col-sm-3 popular-locations color-gray">
                        <h5>Các địa điểm phổ biến</h5>
                        <ul>
                            <li><a href="#">Đà Nẵng</a> </li>
                            <li><a href="#">Hội An</a> </li>
                            <li><a href="#">Huế</a> </li>
                            <li><a href="#">Hà Nội</a> </li>
                            <li><a href="#">Quảng Ninh</a> </li>
                            <li><a href="#">Lai Châu</a> </li>
                            <li><a href="#">SaPa</a> </li>
                            <li><a href="#">Sóc Trăng</a> </li>
                            <li><a href="#">Cần Thơ</a> </li>
                            <li><a href="#">An Giang</a> </li>
                        </ul>
                    </div>
                </div>
                <!-- top footer ends -->
                <!-- bottom footer statrs -->
                <div class="row bottom-footer">
                    <div class="container">
                        <div class="row">
                            <div
                                class="col-xs-12 col-sm-3 payment-options color-gray">
                                <h5>Tùy chọn thanh toán</h5>
                                <ul>
                                    <li>
                                        <a href="#"> <img
                                                src="images/paypal.png"
                                                alt="Paypal"> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <img
                                                src="images/mastercard.png"
                                                alt="Mastercard"> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <img
                                                src="images/maestro.png"
                                                alt="Maestro"> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <img
                                                src="images/stripe.png"
                                                alt="Stripe"> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <img
                                                src="images/bitcoin.png"
                                                alt="Bitcoin"> </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-sm-4 address color-gray">
                                <h5>Địa chỉ</h5>
                                <p>Thiết kế ý tưởng đặt hàng thực phẩm trực tuyến và
                                    deliveye,được quy hoạch như thư mục nhà hàng</p>
                                <h5>Điện thoại: <a href="tel:+080000012222">080
                                        000012 222</a></h5>
                            </div>
                            <div
                                class="col-xs-12 col-sm-5 additional-info color-gray">
                                <h5>Thông tin bổ sung</h5>
                                <p>Tham gia cùng hàng ngàn nhà hàng khác
                                    được hưởng lợi từ việc có thực đơn của họ trên TakeOff
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- bottom footer ends -->
            </div>
        </footer>

        </div>

        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/animsition.min.js"></script>
        <script src="js/bootstrap-slider.min.js"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <script src="js/headroom.js"></script>
        <script src="js/foodpicky.min.js"></script>
    </body>

</html>

<?php
}
?>