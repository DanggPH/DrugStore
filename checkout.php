<?php
require_once('Database/dbhelper.php');
session_start();
$username = null; 
$fullname = '';
if(isset($_SESSION['userinfor'])) {
	$username = $_SESSION['userinfor'];
	$fullname = $username['fullname'];
}else header('Location: login.php');
if(isset($_POST['cart'])) {$_SESSION['cart'] = $_POST['cart'];}
if(isset($_SESSION['cart'])) {
    $cartdump=$_SESSION["cart"];
    $cart=json_decode($cartdump,true);
    for ($i=0; $i < count($cart); $i++) { 
            if(numrows("select * from product where name='".$cart[$i]['name']."'")!=0) {}else unset($cart[$i]);
         }
    // $cart="'".$_SESSION["cart"]."'";
} else $cart='';
$sql='select * from address1 where idCus='.$username['ID'];
$add=executeSingleResult($sql);
?>
<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="images/favicon.png">
      <title>Welcome to Drugshop</title>
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
      <link href="css/font-awesome.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>
      <link href="css/sequence-looptheme.css" rel="stylesheet" media="all"/>
      <link href="css/style.css" rel="stylesheet">
            <!-- Bootstrap core JavaScript==================================================-->
	  <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	  <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	  <script type="text/javascript" src="js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="js/jquery.sequence-min.js"></script>
	  <script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
	  <script defer src="js/jquery.flexslider.js"></script>
      <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script><![endif]-->
        <style>
        .top-space{
        margin-top: 1.5% !important;
        }
        </style>
    </head>
   <body id="home">
      <div class="wrapper" style="margin-top: auto;">
         <div class="header">    
            <div class="container">
               <div class="row">
                  <div class="col-md-2 col-sm-2">
                     <div class="logo"><a href="index.php"><img src="images/logo.png" alt="FlatShop"></a></div>
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
                                <?php
                                //  echo $_SESSION['test'];
                                 if($username!= null){
                                 echo '<tr>
                                 <h5 class="text-center">Xin chào <strong>'.$fullname.'</strong></h5>
                                 <li><a href="" class="log" onclick="logout()">Đăng xuất</a></li>
                                 </tr>';   
                                    }
                                ?>
                              </ul>
                           </div>
                        </div>
                    </div>
                    <div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div>
                        <div class="navbar-collapse collapse">
                           <ul class="nav navbar-nav">
                              <li class="active dropdown">
                                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Trang chủ</a>
                                 <div class="dropdown-menu">
                                    <ul class="mega-menu-links">
                                       <li><a href="index.php">Trang  Chủ</a></li>
                                       <li><a href="productlist.php">Danh sách sản phẩm</a></li>
                                       
                                       <li><a href="checkout.php">Thanh toán</a></li>
                                       <li><a href="contact.php">Liên hệ</a></li>
                                    </ul>
                                 </div>
                              </li>
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
        <div class="col-md-13">
            <div class="checkout-page">
                <ol class="checkout-steps">
                    <li class="steps active">
                        <a href="checkout.php" class="step-title" style="font-size: large; color:aliceblue">
                            Thông tin thanh toán
                        </a>
                        <div class="step-description">
                            <form action="processCheckout.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6"> 
                                        <div class="your-details">
                                            <h5 style="font-size: large; color:aliceblue">
                                                Thông tin cá nhân
                                            </h5>
                                            <div class="form-row">
                                                <label class="lebel-abs" style="font-size: medium; color:black">
                                                    Họ tên
                                                </label>
                                                <input type="text" class="input namefild" name="fullname" value="<?=$username['fullname']?>">
                                            </div>
                                            <div class="form-row">
                                                <label class="lebel-abs" style="font-size: medium; color:black">
                                                    Email
                                                </label>
                                                <input type="email" class="input namefild" name="email" value="<?=$username['email']?>">
                                            </div>
                                            <div class="row">
                                                <div class="form-col col-md-6">
                                                <div class="form-row">
                                                    <label class="lebel-abs" style="font-size: medium; color:black">
                                                        SĐT
                                                    </label>
                                                    <input type="text" class="input namefild" name="phone" maxlength="10" value="<?=$username['phonenumber']?>">
                                                </div>
                                                </div>
                                                <div class="form-col col-lg-4">
                                                    <label class="lebel-abs" style="font-size: medium; color:black">
                                                        Giới tính
                                                    </label>
                                                    <select name="sex">
                                                        <option selected disabled></option>
                                                        <option value="0" <?php if($username['sex']=='0') echo 'selected';?>>Nam</option>
                                                        <option value="1" <?php if($username['sex']=='1') echo 'selected';?>>Nữ</option>
                                                        <option value="2" <?php if($username['sex']=='2') echo 'selected';?>>Khác</option>
                                                    </select>
                                                </div> 
                                            </div> 
                                            <div class="clearfix top-space"></div>
                                            <div class="form-row">
                                                <label class="lebel" style="font-size: medium; color:black">
                                                Quận/Huyện-Thành phố/Tỉnh   
                                                </label>
                                                <input type="text" class="input" name="city" value="<?php echo $add['district'].','.$add['province'];?>" readonly>
                                            </div>  
                                            <div class="form-row">
                                                <label class="lebel-abs" style="font-size: medium; color:black">
                                                    Địa chỉ
                                                </label>
                                                <input type="text" class="input namefild" name="address1" value="<?=$add['street1']?>">
                                            </div>  
                                            <div class="form-row">
                                                <label class="lebel-abs" style="font-size: medium; color:black">
                                                    Địa chỉ 2
                                                </label>
                                                <input type="text" class="input namefild" name="address2" value="<?=$add['street2']?>">
                                            </div>                                                        
                                            <label class="lebel-abs" style="font-size:large; color:aliceblue">
                                                Đơn vị vận chuyển
                                                    <select name="dvvc">
                                                        <option value="Viettel Post">Viettel Post</option>
                                                        <option value="VN Post">VN Post</option>
                                                        <option value="J&T">J&T</option>
                                                        <option value="GHN">GHN</option>
                                                        <option value="GHTK">GHTK</option>
                                                    </select> 
                                                    <input class="billing_dvvc" type="hidden">
                                            </label>
                                            <label class="lebel-abs" style="font-size:large; color:aliceblue">
                                                Phương thức thanh toán
                                                    <select name="checkout">
                                                        <option value="Chuyển khoản">Chuyển khoản</option>
                                                        <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                                                    </select> 
                                                    <input class="billing_checkout" type="hidden">
                                            </label>
                                            <p>
                                                <span class="input-checkbox">
                                                    <input require ="true" type="checkbox" name="confirm">
                                                </span>
                                                <span class="text" style="font-size: large; color:aliceblue" >
                                                        Tôi xác nhận thông tin trên là chính xác đóóóóóóóó
                                                </span>
                                            </p>
                                        </div>
                                        <?php
                                         if($cart!='' and $cart!= null) echo '<button type="submit" onclick="removecart()">Xác nhận</button>';
                                        ?>
                                        <!-- <script>
                                        function removecart(){
                                            localStorage.removeItem('cart');
                                            localStorage.removeItem('arrCart');
                                        }
                                        </script> -->
                                    </div>
                                    <input type="hidden" name="cart" value="<?=$cart?>">
                                    <input type="hidden" name="idCus" value="<?=$username['ID']?>">
                                    <div class="col-md-4 col-sm-4"> 
                                            <?php
                                        
                                            $total=0;
                                            if($cart!='' and $cart!= null){
                                            foreach ($cart as $item) {
                                                
                                                echo '<div class="form-row">
                                                <li>
                                                <div class="cart-item">
                                                    <div class="image"><img src="'.$item['image'].'"></div>
                                                    <div class="item-description">
                                                        <p class="name" style="font-size: large; color:aliceblue">'.$item['name'].'</p>
                                                        <p>Số lượng: <span class="light-red" style="font-size: large; color:aliceblue">'.$item['quality'].'</span></p>
                                                    </div>
                                                    <div class="right">
                                                        <p class="price" style="font-size: large; color:aliceblue">'.$item['price'].'</p>
                                                    </div>
                                                </div>
                                            </li>
                                            </div>';
                                            $total=$total+(int)$item['price']*(int)$item['quality'];
                                                }
                                            } else echo '<h5 style="font-size: large; color:aliceblue">
                                            Không có sản phẩm nào trong giỏ hàng.
                                            </h5>'  
                                            ?>
                                        <div class="form-row">
                                            <div id="marker">
                                                <span class="total" style="font-size: large; color:aliceblue">Tổng <strong id="total-price"><?=$total?> &nbsp;VNĐ</strong></span>
                                            </div>
                                        </div>
                                        <!-- <?php echo $_SESSION['alert'];?> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </body>
</html>