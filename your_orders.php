<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if (empty($_SESSION['user_id'])) //if usser is not login redirected baack to login page

{
    header('location:login.php');
} else {
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Starter Template for Bootstrap</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animsition.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <style type="text/css" rel="stylesheet">
            .indent-small {
                margin-left: 5px;
            }

            .form-group.internal {
                margin-bottom: 0;
            }

            .dialog-panel {
                margin: 10px;
            }

            .datepicker-dropdown {
                z-index: 200 !important;
            }

            .panel-body {
                background: #e5e5e5;
                /* Old browsers */
                background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                /* FF3.6+ */
                background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
                /* Chrome,Safari4+ */
                background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                /* Chrome10+,Safari5.1+ */
                background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                /* Opera 12+ */
                background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                /* IE10+ */
                background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
                /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
                /* IE6-9 fallback on horizontal gradient */
                font: 600 15px "Open Sans", Arial, sans-serif;
            }

            label.control-label {
                font-weight: 600;
                color: #777;
            }


            table {
                width: 750px;
                border-collapse: collapse;
                margin: auto;

            }

            /* Zebra striping */
            tr:nth-of-type(odd) {
                background: #eee;
            }

            th {
                background: #ff3300;
                color: white;
                font-weight: bold;

            }

            td,
            th {
                padding: 10px;
                border: 1px solid #ccc;
                text-align: left;
                font-size: 14px;

            }

            /* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
            @media only screen and (max-width: 760px),
            (min-device-width: 768px) and (max-device-width: 1024px) {

                table {
                    width: 100%;
                }

                /* Force table to not be like tables anymore */
                table,
                thead,
                tbody,
                th,
                td,
                tr {
                    display: block;
                }

                /* Hide table headers (but not display: none;, for accessibility) */
                thead tr {
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }

                tr {
                    border: 1px solid #ccc;
                }

                td {
                    /* Behave  like a "row" */
                    border: none;
                    border-bottom: 1px solid #eee;
                    position: relative;
                    padding-left: 50%;
                }

                td:before {
                    /* Now like a table header */
                    position: absolute;
                    /* Top/left values mimic padding */
                    top: 6px;
                    left: 6px;
                    width: 45%;
                    padding-right: 10px;
                    white-space: nowrap;
                    /* Label the data */
                    content: attr(data-column);

                    color: #000;
                    font-weight: bold;
                }

            }
        </style>

    </head>

    <body>

        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button"
                        data-toggle="collapse"
                        data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img
                            class="img-rounded" src="images/logoko.png" alt=""> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right"
                        id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active"
                                    href="index.php">Trang Chủ <span
                                        class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active"
                                    href="restaurants.php">Quán ăn <span
                                        class="sr-only"></span></a> </li>


                            <?php
                            if (empty($_SESSION["user_id"])) // if user is not login

                            {
                                echo '<li class="nav-item"><a href="login.php" class="nav-link active">Đăng Nhập</a> </li>
                        <li class="nav-item"><a href="registration.php" class="nav-link active">Đăng Ký</a> </li>';
                            } else {
                                //if user is login
                                echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Đơn Đặt</a> </li>';
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
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <!-- top Links -->

            <!-- end:Top links -->
            <!-- start: Inner page hero -->
            <div class="inner-page-hero bg-image"
                data-image-src="images/img/res.jpeg">
                <div class="container"> </div>
                <!-- end:Container -->
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">


                    </div>
                </div>
            </div>
            <!-- //results show -->
            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">


                            <div class="widget clearfix">

                                <div class="widget-heading">
                                    <h3 class="widget-title text-dark">
                                        Lựa chọn tag
                                    </h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="widget-body">
                                    <ul class="tags">
                                        <li> <a href="#" class="tag">
                                                Pizza
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Sendwich
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Sendwich
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Fish
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Desert
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Salad
                                            </a> </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 ">
                            <div class="bg-gray restaurant-entry">
                                <div class="row">

                                    <table>
                                        <thead>
                                            <tr>

                                                <th>Tên Món</th>
                                                <th>Số lượng</th>
                                                <th>Giá tiền</th>
                                                <th>Tình trạng</th>
                                                <th>Date</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                            // displaying current session user login orders
                                            $query_res = mysqli_query($db, "select * from users_orders where u_id='" . $_SESSION['user_id'] . "'");
                                            if (!mysqli_num_rows($query_res) > 0) {
                                                echo '<td colspan="6"><center>You have No orders Placed yet. </center></td>';
                                            } else {

                                                while ($row = mysqli_fetch_array($query_res)) {

                                            ?>
                                                    <tr>
                                                        <td data-column="Item">
                                                            <?php echo $row['title']; ?>
                                                        </td>
                                                        <td data-column="Quantity">
                                                            <?php echo $row['quantity']; ?>
                                                        </td>
                                                        <td data-column="price">
                                                            <?php echo $row['price']; ?>đ
                                                        </td>
                                                        <td data-column="status">
                                                            <?php
                                                            $status = $row['status'];
                                                            if ($status == "" or $status == "NULL") {
                                                            ?>
                                                                <button type="button"
                                                                    class="btn btn-info"
                                                                    style="font-weight:bold;">Đang
                                                                    xét duyệt</button>
                                                            <?php
                                                            }
                                                            if ($status == "in process") { ?>
                                                                <button type="button"
                                                                    class="btn btn-warning"><span
                                                                        class="fa fa-cog fa-spin"
                                                                        aria-hidden="true"></span>Đang
                                                                    vận
                                                                    chuyển!</button>
                                                            <?php
                                                            }
                                                            if ($status == "closed") {
                                                            ?>
                                                                <button type="button"
                                                                    class="btn btn-success"><span
                                                                        class="fa fa-check-circle"
                                                                        aria-hidden="true">Đã
                                                                        giao
                                                                        hàng</button>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($status == "rejected") {
                                                            ?>
                                                                <button type="button"
                                                                    class="btn btn-danger"> <i
                                                                        class="fa fa-close"></i>Đã
                                                                    hủy</button>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-column="Date">
                                                            <?php echo $row['date']; ?></td>
                                                        <td data-column="Action"> <a
                                                                href="delete_orders.php?order_del=<?php echo $row['o_id']; ?>"
                                                                onclick="return confirm('Are you sure you want to cancel your order?');"
                                                                class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i
                                                                    class="fa fa-trash-o"
                                                                    style="font-size:16px"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!--end:row -->
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
        <section class="app-section">
            <div class="app-wrap">
                <div class="container">
                    <div class="row text-img-block text-xs-left">
                        <div class="container">
                            <div
                                class="col-xs-12 col-sm-6 hidden-xs-down right-image text-center">
                                <figure> <img src="images/app.png"
                                        alt="Right Image"> </figure>
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
        <!-- start: FOOTER -->
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
                                <p>43 Ngô Thì Sĩ, quận Sơn Trà, thành phố Đà Nẵng</p>
                                <h5>Điện thoại: <a href="tel:+080000012222">0912490014</a></h5>
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
        <!-- end:Footer -->
        </div>

        <!-- Bootstrap core JavaScript
    ================================================== -->
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