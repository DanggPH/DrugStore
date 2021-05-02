<?php
require_once('Database/dbhelper.php');
session_start();
if(isset($_SESSION['email'])) $email=$_SESSION['email']; else $email='';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/favicon.png">
        <title>
            Welcome to DrugStore
        </title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js">
        </script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js">
        </script>
        <![endif]-->
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="images/logo.png" alt="FlatShop">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <div class="header_top">
                                <div class="row">
                                    <div class="col-md-3">
                                        <ul class="option_nav">
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="topmenu">
                                            <li>
                                                <a href="#">
                                                    About Us
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    News
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    Service
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    Recruiment
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    Media
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    Support
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3">
                                        <ul class="usermenu">
                                            <li>
                                                <a href="login.html" class="log">
                                                    Đăng nhập
                                                </a>
                                            </li>
                                            <li>
                                                <a href="register.html" class="reg">
                                                    Đăng kí
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                            </div>
                            <div class="header_bottom">
                                <ul class="option">
                                    <li id="search" class="search">
                                        <form>
                                            <input class="search-submit" type="submit" value="">
                                            <input class="search-input" placeholder="Nhập từ khóa tìm kiếm..." type="text" value="" name="search">
                                        </form>
                                    </li>
                                    <li class="option-cart">
                                        <a href="#" class="cart-icon">
                                            cart
                                            <span class="cart_no">
                                                02
                                            </span>
                                        </a>
                                        <ul class="option-cart-item">
                                            <li>
                                                <div class="cart-item">
                                                    <div class="image">
                                                        <img src="images/products/thum/products-01.png" alt="">
                                                    </div>
                                                    <div class="item-description">
                                                        <p class="name">
                                                            Lincoln chair
                                                        </p>
                                                        <p>
                                                            Size:
                                                            <span class="light-red">
                                                                One size
                                                            </span>
                                                            <br>
                                                            Quantity:
                                                            <span class="light-red">
                                                                01
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="right">
                                                        <p class="price">
                                                            300.000 VNĐ
                                                        </p>
                                                        <a href="#" class="remove">
                                                            <img src="images/remove.png" alt="remove">
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="cart-item">
                                                    <div class="image">
                                                        <img src="images/products/thum/products-02.png" alt="">
                                                    </div>
                                                    <div class="item-description">
                                                        <p class="name">
                                                            Sản phẩm 2021
                                                        </p>
                                                        <p>
                                                            Size:
                                                            <span class="light-red">
                                                                One size
                                                            </span>
                                                            <br>
                                                            Số lượng:
                                                            <span class="light-red">
                                                                01
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="right">
                                                        <p class="price">
                                                            300.000 VNĐ
                                                        </p>
                                                        <a href="#" class="remove">
                                                            <img src="images/remove.png" alt="remove">
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <span class="total">
                                                    Tổng cộng
                                                    <strong>
                                                        600.000 VNĐ
                                                    </strong>
                                                </span>
                                                <button class="checkout" onClick="location.href='checkout.html'">
                                                    CheckOut
                                                </button>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">
                                            Toggle navigation
                                        </span>
                                        <span class="icon-bar">
                                        </span>
                                        <span class="icon-bar">
                                        </span>
                                        <span class="icon-bar">
                                        </span>
                                    </button>
                                </div>
                                <div class="navbar-collapse collapse">
                           <ul class="nav navbar-nav">
                              <li class="active dropdown">
                                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Trang chủ</a>
                                 <div class="dropdown-menu">
                                    <ul class="mega-menu-links">
                                       <li><a href="index.php">Trang  Chủ</a></li>
                                       <li><a href="productlist.php">Danh sách sản phẩm</a></li>
                                       <li><a href="cart.php">Giỏ hàng </a></li>
                                       <li><a href="checkout.php">CheckOut</a></li>
                                       <li><a href="contact.php">Liên hệ</a></li>
                                    </ul>
                                 </div>
                              </li>
                              <li><a href="productgird.php">Sale</a></li>
                              <li><a href="productlist.php">Tư vấn thuốc </a></li>
                              <li class="dropdown">
                                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sống Khỏe</a>
                                 <div class="dropdown-menu mega-menu">
                                    <div class="row">
                                       <div class="col-md-6 col-sm-6">
                                          <ul class="mega-menu-links">
                                             <li><a href="">Bệnh thường gặp</a></li>
                                             <li><a href="">Gia đình</a></li>
                                             <li><a href="">Bệnh mãn tính</a></li>
                                             <li><a href="">Làm đẹp</a></li>
                                             <li><a href="">Dinh dưỡng</a></li>
                                             <li><a href="">Tin tức </a></li>
                                          </ul>
                                       </div>

                                    </div>
                                 </div>
                              </li>
                              <li><a href="">blog</a></li>
                              <li><a href="contact.php">Liên hệ chúng tôi</a></li>
                           </ul>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                </div>
                <div class="page-index">
                    <div class="container">
                        <p>
                            Đăng nhập
                        </p>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
            <div class="container_fullwidth">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="special-deal leftbar" style="margin-top:0;">
                                <h4 class="title">
                                    Special
                                    <strong>
                                        Deals
                                    </strong>
                                </h4>
                                <?php
                                $sql='SELECT id,name,price,image, ((price_old - price)/ price_old)*100 saleoff FROM product ORDER BY `saleoff` DESC LIMIT 4';
                                $special_deal=executeResult($sql);
                                foreach ($special_deal as $item ) {
                                    echo '<tr> 
                                    <td> <div class="special-item"> </td>
                                    <td> <div class="product-image"> </td>
                                    <td>   <a href="detail.php?id='.$item['id'].'"> </td>
                                        <td>    <img src="admin/images/'.$item['image'].'" alt=""> </td>
                                    <td>    </a> </td>
                                    <td> </div> </td>
                                    <td> <div class="product-info"> </td>
                                    <td>    <p> </td>
                                    <td>        <a href="details.html"> </td>
                                    <td>           '.$item['name'].' </td>
                                        <td>    </a> </td>
                                    <td> </p>   </td>
                                    <td> <h5 class="price"> </td>
                                        <td>    '.$item['price'].' VND</td>
                                        <td></h5> </td>
                                    <td></div> </td>
                                <td></div></td>';
                                }
                                ?>
                            </div>
                            <div class="fbl-box leftbar">
                                <h3 class="title">
                                    Facebook
                                </h3>
                                <span class="likebutton">
                                    <a href="#">
                                        <img src="images/fblike.png" alt="">
                                    </a>
                                </span>
                                <p>
                                    12k người thích trang này.
                                </p>
                                <ul>
                                    <li>
                                        <a href="#">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        </a>
                                    </li>
                                </ul>
                                <div class="fbplug">
                                    <a href="#">
                                        <span>
                                            <img src="images/fbicon.png" alt="">
                                        </span>
                                        Facebook social plugin
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="checkout-page">
                                <ol class="checkout-steps">
                                    <li class="steps active">
                                        <a href="login.html" class="step-title">
                                            Thông tin đăng nhập
                                        </a>
                                        <div class="step-description">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="new-customer">
                                                        <h5>
                                                            Bạn là khách hàng mới ?
                                                        </h5>
                                                        <p class="requir">
                                                            Bằng cách tạo một tài khoản, bạn sẽ có thể mua sắm nhanh chóng, được cập nhật về trạng thái của đơn đặt hàng và theo dõi các đơn đặt hàng bạn đã thực hiện trước đó.
                                                        </p>
                                                        <p>
                                                            Tạo tài khoản ngay hôm nay !
                                                        </p>
                                                        <a href="register.php">
                                                            <button>
                                                                Tiếp tục
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="run-customer">
                                                        <h5>
                                                            Đăng nhập
                                                        </h5>
                                                        <form action = "Database/Login.php" method = "POST">
                                                            <div class="form-row">
                                                                <label class="lebel-abs">
                                                                    Email
                                                                    <strong class="red">
                                                                        *
                                                                    </strong>
                                                                </label>
                                                                <input type="text" class="input namefild" name="email" value="<?=$email?>">
                                                                <?php unset($_SESSION['email']);?>
                                                            </div>
                                                            <div class="pass-wrap">
                                                                <div class="form-row">
                                                                    <label class="lebel-abs">
                                                                        Mật khẩu
                                                                        <strong class="red">
                                                                            *
                                                                        </strong>
                                                                    </label>
                                                                    <input type="password" class="input namefild" name="password" >
                                                                </div>
                                                            </div>
                                                            <p>
                                                            <?php 
                                                             if(isset($_SESSION['notify'])){
                                                                     echo $_SESSION['notify'];
                                                                     unset($_SESSION['notify']);
                                                                }
                                                            ?>
                                                            </p>
                                                            <p class="forgoten">
                                                                <a href="#">
                                                                    Quên mật khẩu?
                                                                </a>
                                                            </p>
                                                            <button>
                                                                Đăng nhập
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </body>
</html>