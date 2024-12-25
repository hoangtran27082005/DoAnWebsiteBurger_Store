<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); // connection to db
error_reporting(0);
session_start();
include_once 'product-action.php'; //including controller
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
        <!-- /.navbar -->
    </header>
    <div class="page-wrapper">
        <!-- top Links -->
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a
                            href="restaurants.php">Chọn Quán ăn</a>
                    </li>
                    <li class="col-xs-12 col-sm-4 link-item active">
                        <span>2</span><a
                            href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>">Đặt
                            món ăn yêu thích của bạn</a>
                    </li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a
                            href="#">Giao hàng và thanh toán</a></li>
                </ul>
            </div>
        </div>
        <!-- end:Top links -->
        <!-- start: Inner page hero -->
        <?php $ress = mysqli_query($db, "select * from restaurant where rs_id='$_GET[res_id]'");
        $rows = mysqli_fetch_array($ress);

        ?>
        <section class="inner-page-hero bg-image"
            data-image-src="images/img/food4.jpg">
            <div class="profile">
                <div class="container">
                    <div class="row">
                        <div
                            class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                            <div class="image-wrap">
                                <figure>
                                    <?php echo '<img src="admin/Res_img/' . $rows['image'] . '" alt="Restaurant logo">'; ?>
                                </figure>
                            </div>
                        </div>

                        <div
                            class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                            <div class="pull-left right-text white-txt">
                                <h6><a
                                        href="#"><?php echo $rows['title']; ?></a>
                                </h6>
                                <p><?php echo $rows['address']; ?></p>
                                <ul class="nav nav-inline">
                                    <li class="nav-item"> <a
                                            class="nav-link active" href="#"><i
                                                class="fa fa-check"></i> Min $
                                            10,00</a> </li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="#"><i
                                                class="fa fa-motorcycle"></i>
                                            30 min</a> </li>
                                    <li class="nav-item ratings">
                                        <a class="nav-link" href="#"> <span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </span> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>
        <!-- end:Inner page hero -->
        <div class="breadcrumb">
            <div class="container">

            </div>
        </div>
        <div class="container m-t-30">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">

                    <div class="widget widget-cart">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                                Đơn Hàng Của Bạn
                            </h3>


                            <div class="clearfix"></div>
                        </div>
                        <div class="order-row bg-white">
                            <div class="widget-body">


                                <?php

                                $item_total = 0;

                                foreach ($_SESSION["cart_item"] as $item)  // fetch items define current into session ID
                                {
                                ?>

                                    <div class="title-row">
                                        <?php echo $item["title"]; ?><a
                                            href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                                            <i
                                                class="fa fa-trash pull-right"></i></a>
                                    </div>

                                    <div class="form-group row no-gutter">
                                        <div class="col-xs-8">
                                            <input type="text"
                                                class="form-control b-r-0"
                                                value=<?php echo "$" . $item["price"]; ?>
                                                readonly id="exampleSelect1">

                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control" type="text"
                                                readonly
                                                value='<?php echo $item["quantity"]; ?>'
                                                id="example-number-input">
                                        </div>

                                    </div>

                                <?php
                                    $item_total += ($item["price"] * $item["quantity"]); // calculating current price into cart
                                }
                                ?>



                            </div>
                        </div>

                        <!-- end:Order row -->

                        <div class="widget-body">
                            <div class="price-wrap text-xs-center">
                                <p>Tổng Tiền</p>
                                <h3 class="value">
                                    <strong><?php echo $item_total . " đ"; ?></strong>
                                </h3>
                                <p>Ưu đãi Free Ship</p>
                                <a href="checkout.php?res_id=<?php echo $_GET['res_id']; ?>&action=check"
                                    class="btn theme-btn btn-lg button">Đặt
                                    Hàng</a>
                            </div>
                        </div>




                    </div>
                </div>

                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                    <div class="menu-widget" id="2">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                                Các món ăn xịn xò!! ~~~<a
                                    class="btn btn-link pull-right"
                                    data-toggle="collapse" href="#popular2"
                                    aria-expanded="true">
                                    <i class="fa fa-angle-right pull-right"></i>
                                    <i class="fa fa-angle-down pull-right"></i>
                                </a>
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="collapse in" id="popular2">
                            <?php 
                            $stmt = $db->prepare("select * from dishes where rs_id='$_GET[res_id]'");
                            $stmt->execute();
                            $products = $stmt->get_result();
                            if (!empty($products)) {
                                foreach ($products as $product) {



                            ?>
                                    <div class="food-item">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-lg-8">
                                                <form method="post"
                                                    action='dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                                    <div class="rest-logo pull-left">
                                                        <a class="restaurant-logo pull-left"
                                                            href="#"><?php echo '<img src="admin/Res_img/dishes/' . $product['img'] . '" alt="Food logo">'; ?></a>
                                                    </div>
                                                    <!-- end:Logo -->
                                                    <div class="rest-descr">
                                                        <h6><a
                                                                href="#"><?php echo $product['title']; ?></a>
                                                        </h6>
                                                        <p> <?php echo $product['slogan']; ?>
                                                        </p>
                                                    </div>
                                                    <!-- end:Description -->
                                            </div>
                                            <!-- end:col -->
                                            <div
                                                class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info">
                                                <span
                                                    class="price pull-left"><?php echo $product['price']; ?>
                                                    đ</span>
                                                    <div class="quantity-wrapper">
    <input class="quantity-input" type="number" name="quantity" value="1" min="1" />
</div>
<input type="submit" class="btn theme-btn" style="width:10rem;" value="Thêm vào giỏ hàng" />

                                            </div>
                                            </form>
                                        </div>
                                        <!-- end:row -->
                                    </div>
                                    <!-- end:Food item -->

                            <?php
                                }
                            }

                            ?>



                        </div>
                        <!-- end:Collapse -->
                    </div>
                    <!-- end:Widget menu -->

                </div>
                <!-- end:Bar -->
                <div class="col-xs-12 col-md-12 col-lg-3">
                    <div class="sidebar-wrap">
                        <div class="widget clearfix">
                            <!-- /widget heading -->
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                                    Lựa chọn tag
                                </h3>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:Right Sidebar -->
            </div>
            <!-- end:row -->
        </div>
        <!-- end:Container -->
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
                                <p>Thiết kế ý tưởng đặt hàng thực phẩm trực tuyến và
                                    deliveye,được quy hoạch như thư mục nhà hàng</p>
                                <h5>Điện thoại: <a href="tel:+0912490014">0912490014</a></h5>
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
    <!-- end:page wrapper -->
    </div>
    <!--/end:Site wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="order-modal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close"> <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body cart-addon">
                    <div class="food-item white">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left"
                                        href="#"><img
                                            src="http://placehold.it/70x70"
                                            alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande
                                            Menü (28 - 30 cm.)</a></h6>
                                </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div
                                class="col-xs-6 col-sm-2 col-lg-2 text-xs-center">
                                <span class="price pull-left">$
                                    2.99</span>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0"
                                            id="exampleSelect2">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control"
                                            type="number" value="0"
                                            id="quant-input-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left"
                                        href="#"><img
                                            src="http://placehold.it/70x70"
                                            alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande
                                            Menü (28 - 30 cm.)</a></h6>
                                </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div
                                class="col-xs-6 col-sm-2 col-lg-2 text-xs-center">
                                <span class="price pull-left">$
                                    2.49</span>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0"
                                            id="exampleSelect3">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control"
                                            type="number" value="0"
                                            id="quant-input-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left"
                                        href="#"><img
                                            src="http://placehold.it/70x70"
                                            alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande
                                            Menü (28 - 30 cm.)</a></h6>
                                </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div
                                class="col-xs-6 col-sm-2 col-lg-2 text-xs-center">
                                <span class="price pull-left">$
                                    1.99</span>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0"
                                            id="exampleSelect5">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control"
                                            type="number" value="0"
                                            id="quant-input-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left"
                                        href="#"><img
                                            src="http://placehold.it/70x70"
                                            alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande
                                            Menü (28 - 30 cm.)</a></h6>
                                </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div
                                class="col-xs-6 col-sm-2 col-lg-2 text-xs-center">
                                <span class="price pull-left">$
                                    3.15</span>
                            </div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0"
                                            id="exampleSelect6">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control"
                                            type="number" value="0"
                                            id="quant-input-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-btn">Add to
                        cart</button>
                </div>
            </div>
        </div>
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