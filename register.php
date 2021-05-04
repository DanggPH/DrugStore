<?php
    session_start();
	if(isset($_SESSION['userinfor'])) {
		header('Location: index.php');
		die();
	}
    require_once('Database/dbhelper.php');
    $email = $fullname = $address1 = $address2 = $phone = $usr= $sex='';
    $temp=['email'=>$email, 'fullname'=>$fullname , 'address1'=>$address1 , 'address2'=>$address2 , 'phone'=>$phone , 'usr'=>$usr, 'sex'=>$sex];
    if(isset($_SESSION['temp'])) $temp=$_SESSION['temp'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>
        Đăng kí tài khoản
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
                            <a href="index.php">
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
                                </div>
                                <div class="col-md-3">
                                    <ul class="usermenu">
                                        <li>
                                            <a href="login.php" class="log">
                                                Đăng nhập
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
                                    <form method="GET" action="productlist.php">
                                        <input class="search-submit" type="submit" value="">
                                        <input class="search-input" placeholder="Nhập từ khóa tìm kiếm..." type="text" value="" name="search">
                                    </form>
                                </li>
                                <!-- <li class="option-cart">
                                    <a href="#" class="cart-icon">
                                        cart
                                        <span class="cart_no">
                                            0
                                        </span>
                                    </a>
                                    <ul class="option-cart-item">
                                        <li>
                                            <div class="cart-item"> -->
                                                <!--<div class="image">
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
                                        </li>-->
                                        <!-- <li>
                                            <span class="total">
                                                Tổng cộng
                                                <strong>
                                                    0 VNĐ
                                                </strong>
                                            </span>
                                            <button class="checkout" onClick="location.href='checkout.php'">
                                                Thanh Toán
                                            </button>
                                        </li>
                                    </ul> -->
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
            <div class="clearfix">
            </div>
            <div class="page-index">
                <div class="container">
                    <p>
                        Đăng Kí
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
                                    <td>   <a href="details.php?id='.$item['id'].'"> </td>
                                        <td>    <img src="admin/images/'.$item['image'].'" alt=""> </td>
                                    <td>    </a> </td>
                                    <td> </div> </td>
                                    <td> <div class="product-info"> </td>
                                    <td>    <p> </td>
                                    <td>        <a href="details.php?id='.$item['id'].'"> </td>
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
                    </div>
                    <div class="col-md-9">
                        <div class="checkout-page">
                            <ol class="checkout-steps">
                                <li class="steps active">
                                    <a href="register.php" class="step-title">
                                       Thông tin đăng kí
                                    </a>
                                    <div class="step-description">
                                        <form action="processRegis.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="your-details">
                                                        <h5>
                                                            Thông tin cá nhân
                                                        </h5>
                                                        <div class="form-row">
                                                            <label class="lebel-abs">
                                                                Họ tên
                                                                <strong class="red">
                                                                    *
                                                                </strong>
                                                            </label>
                                                            <input required = "true" type="text" class="input namefild" name="fullname" value="<?=$temp['fullname']?>">
                                                        </div>
                                                        <div class="form-row">
                                                            <label class="lebel-abs">
                                                                Username
                                                                <strong class="red">
                                                                    *
                                                                </strong>
                                                            </label>
                                                            <input required = "true" type="text" class="input namefild" name="usr" value="<?=$temp['usr']?>">
                                                        </div>
                                                        <div class="form-row">
                                                            <label class="lebel-abs">
                                                                Email
                                                                <strong class="red">
                                                                    *
                                                                </strong>
                                                            </label>
                                                            <input required = "true" type="email" class="input namefild" name="email" value="<?=$temp['email']?>">
                                                        </div>
                                                        <div class="form-row">
                                                            <label class="lebel-abs">
                                                                SĐT
                                                                <strong class="red">
                                                                    *
                                                                </strong>
                                                            </label>
                                                            <input required = "true" type="text" class="input namefild" name="phone" maxlength="10" value="<?=$temp['phone']?>">
                                                        </div>  
                                                        <label class="lebel-abs" style="width: fit-content; font-size: 14px;">
                                                            Giới tính
                                                            <strong class="red">
                                                                <select name="sex">
                                                                    <option selected disabled></option>
                                                                    <option value="0" <?php if($temp['sex']=='0') echo 'selected';?>>Nam</option>
                                                                    <option value="1" <?php if($temp['sex']=='1') echo 'selected';?>>Nữ</option>
                                                                    <option value="2" <?php if($temp['sex']=='2') echo 'selected';?>>Khác</option>
                                                                </select>
                                                                <input type="hidden"> 
                                                            </strong>   
                                                        </label>                                                                                                       
                                                        <div class="pass-wrap">
                                                            <div class="form-row">
                                                                <label class="lebel-abs">
                                                                    Mật khẩu
                                                                    <strong class="red">
                                                                        *
                                                                    </strong>
                                                                </label>
                                                                <input required = "true" type="password" class="input namefild" name="password" minlength="8">
                                                            </div>
                                                            <div class="form-row">
                                                                <label class="lebel-abs">
                                                                    Nhập lại mật khẩu
                                                                    <strong class="red">
                                                                        *
                                                                    </strong>
                                                                </label>
                                                                <input required = "true" type="password" class="input cpass" name="confirmation_pwd" minlength="8">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="your-details">
                                                        <h5>
                                                            Địa chỉ của bạn
                                                        </h5>  
                                                        <label class="lebel-abs" style="width: fit-content; font-size: 14px;">
                                                            Thành phố
                                                                <select name="calc_shipping_provinces">
                                                                    <option>Tỉnh / Thành phố</option>
                                                                </select>
                                                                <input class ="billing_address_1" type="hidden" value=""> 
                                                        </label>                          
                                                        <label class="lebel-abs" style="width: fit-content; font-size: 14px;">
                                                                Quận/Huyện
                                                                <select name="calc_shipping_district">
                                                                    <option>Quận / Huyện</option>
                                                                </select> 
                                                                <input class="billing_address_2" type="hidden" value="">
                                                        </label>
                                                        <div class="form-row">
                                                            <label class="lebel-abs">
                                                                Địa chỉ  01
                                                                <strong class="red">
                                                                    *
                                                                </strong>
                                                            </label>
                                                            <input required = "true" type="text" class="input namefild" name="address1" value="<?=$temp['address1']?>">
                                                        </div>                                                    
                                                        <div class="form-row">
                                                            <label class="lebel-abs">
                                                                Địa chỉ  02
                                                            </label>
                                                            <input type="text" class="input namefild" name="address2" value="<?=$temp['address2']?>">
                                                        </div>
                                                        <p class="privacy">
                                                            <span class="text">
                                                                <?php
                                                                if(isset($_SESSION['notify'])) echo $_SESSION['notify'];
                                                                unset($_SESSION['notify']);
                                                                unset($_SESSION['temp']);
                                                                ?>
                                                            </span>
                                                        </p>
                                                        <button type="submit" class="btn btn-success">Đăng ký</button>
                                                        <button type="reset" class="btn btn-success" onclick="reload()">Hủy</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--js-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='js/districts.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<<script>
        /*if (address_2 = localStorage.getItem('address_2_saved')) {
            /*$('select[name="calc_shipping_district"] option').each(function() {
                if ($(this).text() == address_2) {
                    $(this).attr('selected', '')
                }
            })*/
            //$('input.billing_address_2').attr('value', address_2)
        //}
        if (district = localStorage.getItem('district')) {
            $('select[name="calc_shipping_district"]').html(district)
            $('select[name="calc_shipping_district"]').on('change', function() {
                var target = $(this).children('option:selected')
                //target.attr('selected', '')
                $('select[name="calc_shipping_district"] option').not(target).removeAttr('selected')
                address_2 = target.text()
                $('input.billing_address_2').attr('value', address_2)
                district = $('select[name="calc_shipping_district"]').html()
                localStorage.setItem('district', district)
                localStorage.setItem('address_2_saved', address_2)
            })
        }
        $('select[name="calc_shipping_provinces"]').each(function() {
            var $this = $(this),
                stc = ''
            c.forEach(function(i) {
                stc += '<option value="' + i + '">' + i + '</option>'
                $this.html('<option value="">Tỉnh / Thành phố</option>' + stc)
                if (address_1 = localStorage.getItem('address_1_saved')) {
                /*$('select[name="calc_shipping_provinces"] option').each(function() {
                    if ($(this).text() == address_1) {
                        $(this).attr('selected', '');                     
                    }
                })*/
                $('input.billing_address_1').attr('value', address_1)
                }
                $this.on('change', function(i) {
                i = $this.children('option:selected').index() - 1
                var str = '',
                    r = $this.val()
                if (r != '') {
                    arr[i].forEach(function(el) {
                        str += '<option value="' + el + '">' + el + '</option>'
                        $('select[name="calc_shipping_district"]').html('<option value="">Quận / Huyện</option>' + str)
                    })
                    var address_1 = $this.children('option:selected').text()
                    var district = $('select[name="calc_shipping_district"]').html()
                    localStorage.setItem('address_1_saved', address_1)
                    localStorage.setItem('district', district)
                    $('select[name="calc_shipping_district"]').on('change', function() {
                        var target = $(this).children('option:selected')
                        //target.attr('selected', '')
                        $('select[name="calc_shipping_district"] option').not(target).removeAttr('selected')
                        var address_2 = target.text()
                        $('input.billing_address_2').attr('value', address_2)
                        district = $('select[name="calc_shipping_district"]').html()
                        localStorage.setItem('district', district)
                        localStorage.setItem('address_2_saved', address_2)
                    })
                } else {
                    $('select[name="calc_shipping_district"]').html('<option value="">Quận / Huyện</option>')
                    district = $('select[name="calc_shipping_district"]').html()
                    localStorage.setItem('district', district)
                    localStorage.removeItem('address_1_saved', address_1)
                    }
                })
            })
        })
</script>
</body>
</html>