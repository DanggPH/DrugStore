
<?php
require_once('Database/dbhelper.php');
session_start();
$username = null;
$fullname = '';
if(isset($_SESSION['userinfor'])) {
	$username = $_SESSION['userinfor'];
	$fullname = $username['fullname'];
}
if(isset($_POST['token']) and $_POST['token']!=$_SESSION['token']) header('Location: productlist.php');
$token=rand(1,10);
$_SESSION['token']=$token;
$sort="";
$limit=3;
$page=1;
if(isset($_SESSION['show'])) $limit=$_SESSION['show'];
if(isset($_SESSION['sort'])) $sort=$_SESSION['sort'];
if(isset($_POST['show'])) {$limit=$_POST['show']; $_SESSION['show']=$_POST['show'];}
if(isset($_POST['sort'])) {
  if($_POST['sort']!='') $sort="ORDER BY ".$_POST['sort']." ASC"; else $sort="";
  $_SESSION['sort']=$sort;}
if(isset($_GET['page'])) $page=$_GET['page']; 
if(isset($_GET['from'])) $from=$_GET['from']; else $from="";
if(isset($_GET['to'])) $to=$_GET['to']; else $to="";
if(is_numeric($from) and is_numeric($to)) $sortprice=" (a.price >=".$from." AND a.price <=".$to.")"; else $sortprice="1";
if(isset($_GET['search'])) {
  $key=addslashes(strip_tags($_GET['search']));
  $sqlCount = "SELECT COUNT(*) count \n"
. "FROM (select  a.*, c.name brandname from product a, brands c WHERE a.brandid=c.id AND ".$sortprice." AND (a.name LIKE '%".$key."%' OR a.id LIKE '%".$key."%' OR c.name LIKE '%".$key."%')) d\n"
. "LEFT JOIN comment b ON d.id = b.idproduct";
}else {$key="";$sqlCount="select count(id) count from product";}
if(executeSingleResult($sqlCount)!=null) $count=executeSingleResult($sqlCount)['count'];
else $count=0;

$countPage=ceil($count/$limit);
// echo $sqlCount;
$firtIndex=($page-1)*$limit;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>
      Welcome to DrugShop
    </title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>
    <link href="css/style.css" rel="stylesheet">
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
                    <?php
if($username!= null){
   echo '<tr>
   <h5 class="text-center">Xin chào <strong>'.$fullname.'</strong></h5>
   <li><a href="Database/Logout.php" class="log">Đăng xuất</a></li>
   </tr>';
}else echo '<tr>
      <li><a href="login.php" class="log">Đăng nhập</a></li>
      <li><a href="register.php" class="reg">Đăng kí</a></li>  
   </tr>';
?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="clearfix">
              </div>
              <div class="header_bottom">
                <ul class="option">
                  <li id="search" class="search">
                    <form method="GET">
                      <input class="search-submit" type="submit" value="">
                      <input class="search-input" placeholder="Enter your search term..." type="text" value="" name="search">
                    </form>
                  </li>
                  <li class="option-cart" onmouseover="updateCart(),updatePrice()">
                    <a href="#" class="cart-icon">cart <span class="cart_no">0</span></a>
                    <ul class="option-cart-item" id="cart-list">
                      <li id="marker"><span class="total">Total <strong id="total-price" >600.000 VNĐ</strong></span><button class="checkout" onClick="location.href='checkout.html'">CheckOut</button></li>
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
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Trang chủ
                      </a>
                      <div class="dropdown-menu">
                        <ul class="mega-menu-links">
                          <li>
                            <a href="index.php">
                              home
                            </a>
                          </li>
                          <li>
                            <a href="productlist.php">
                              Productlitst
                            </a>
                          </li>
                          <li>
                            <a href="productgird.php">
                              Productgird
                            </a>
                          </li>
                          <li>
                            <a href="cart.php">
                              Cart
                            </a>
                          </li>
                          <li>
                            <a href="contact.html">
                              contact
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                      <a href="productgird.php">
                        Sale
                      </a>
                    </li>
                    <li>
                      <a href="productlist.php">
                        Tư vấn thuốc 
                      </a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Sống khỏe
                      </a>
                      <div class="dropdown-menu mega-menu">
                        <div class="row">
                          <div class="col-md-6 col-sm-6">
                            <ul class="mega-menu-links">
                              <li>
                                <a href="productgird.html">
                                  Bệnh thường gặp
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Gia đình
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Bệnh mãn tính
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Làm đẹp
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Dinh dưỡng
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Tin tức 
                                </a>
                              </li>
                            </ul>
                          </div>
                          
                        </div>
                      </div>
                    </li>
                    <li>
                      <a href="productgird.html">
                        Blog
                      </a>
                    </li>
                    <li>
                      <a href="productgird.html">
                        Liên hệ chúng tôi
                      </a>
                    </li>>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix">
      </div>
      <div class="container_fullwidth">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="category leftbar">
                <h3 class="title">
                  Hạng mục
                </h3>
                <ul>
                  <li>
                    <a href="#">
                      Thuốc không kê đơn
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Thực phẩm chức năng
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Chăm sóc sức khỏe
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Chăm sóc cá nhân
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Sản phẩm khyến mãi
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Sản phẩm tiện lợi
                    </a>
                  </li>
                </ul>
              </div>
              <div class="clearfix">
              </div>
              
              <div class="clearfix">
              </div>
              <div class="price-filter leftbar">
                <h3 class="title">
                  Price
                </h3>
                <form class="pricing" method="GET">
                  <label>
                    VNĐ 
                    <input type="number" name="from" value="<?=$from?>">
                  </label>
                  <span class="separate">
                    - 
                  </span>
                  <label>
                    VNĐ 
                    <input type="number" name="to" value="<?=$to?>"> 
                  </label>
                  <input type="submit" value="Go">
                </form>
              </div>
              <div class="clearfix">
              </div>
              <div class="others leftbar">
                <h3 class="title">
                  Others
                </h3>
              </div>
              <div class="clearfix">
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
                  12k người thích trang này .
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
              <div class="clearfix">
              </div>
              <div class="leftbanner">
                <img src="images/banner-small-01.png" alt="">
              </div>
            </div>
            <div class="col-md-9">
              <div class="banner">
                <div class="bannerslide" id="bannerslide">
                  <ul class="slides">
                    <li>
                      <a href="#">
                        <img src="images/banner-01.jpg" alt=""/>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="images/banner-02.jpg" alt=""/>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="clearfix">
              </div>
              <div class="products-grid">
                <div class="toolbar">
                  <div class="sorter">
                    <div class="view-mode">
                      <a href="productlist.php" class="list">
                        List
                      </a>
                      <a href="#" class="grid active">
                        Grid
                      </a>
                    </div>
                    <div class="sort-by">
                      Sort by : 
                      <form method="POST">
                        <input type="hidden"  name="token" value="<?=$token?>">
                        <select name="sort" onchange="this.form.submit()" >
                          <option value="" <?php if($sort=='') echo 'selected';?>>
                            Default
                          </option>
                          <option value="name" <?php if($sort=='ORDER BY name ASC') echo 'selected';?>>
                            Name
                          </option>
                          <option value="price" <?php if($sort=='ORDER BY price ASC') echo 'selected';?>>
                            Price
                          </option>
                        </select>
                      </form>
                    </div>
                    <div class="limiter">
                      Show : 
                      <form method="POST">
                        <input type="hidden"  name="token" value="<?=$token?>">
                        <select name="show" onchange="this.form.submit()">
                          <option value="3" <?php if($limit=='3') echo 'selected';?>>
                            3
                          </option>
                          <option value="6" <?php if($limit=='6') echo 'selected';?>>
                            6
                          </option>
                          <option value="9" <?php if($limit=='9') echo 'selected';?>>
                            9
                          </option>
                        </select>
                      </form>
                    </div>
                  </div>
                  <div class="pager">
                    <a <?php if($page>1) echo 'href="?page='.($page-1).'&search='.$key.'"'; else echo 'href="?search='.$key.'&from='.$from.'&to='.$to.'"'; ?> class="prev-page">
                      <i class="fa fa-angle-left">
                      </i>
                    </a>
                    <?php
                    if($countPage>3){
                     $avaiablePage= [1,2,3];
                     if($page>=3) {$avaiablePage= [$page-1,$page,$page+1];
                     if($page>=$countPage-2) $avaiablePage= [$countPage-2,$countPage-1,$countPage];}
                     foreach ($avaiablePage as $pageid) {
                       if($page==$pageid) echo '<a href="?page='.$pageid.'&search='.$key.'&from='.$from.'&to='.$to.'" class="active">'.$pageid.'</a>';
                       else echo '<a href="?page='.$pageid.'&search='.$key.'&from='.$from.'&to='.$to.'">'.$pageid.'</a>';
                     }
                    }else for ($i=1; $i <= $countPage; $i++) { 
                      if($page==$i) echo '<a href="?page='.$i.'&search='.$key.'&from='.$from.'&to='.$to.'" class="active">'.$i.'</a>';
                       else echo '<a href="?page='.$i.'&search='.$key.'&from='.$from.'&to='.$to.'">'.$i.'</a>';
                    }
                    ?>
                    <a <?php if($page<$countPage) echo 'href="?page='.($page+1).'&search='.$key.'"&from='.$from.'&to='.$to.''; else echo 'href="?search='.$key.'&from='.$from.'&to='.$to.'"'; ?> class="next-page">
                      <i class="fa fa-angle-right">
                      </i>
                    </a>
                  </div>
                </div>
                <div class="clearfix">
                </div>
                <div class="row">
                <?php
$sql = "SELECT d.*, avg(b.voted) vote, COUNT(b.id) review\n"
. "FROM (select  a.*, c.name brandname from product a, brands c WHERE a.brandid=c.id AND ".$sortprice." AND (a.name LIKE '%".$key."%' OR a.id LIKE '%".$key."%' OR c.name LIKE '%".$key."%')) d\n"
. "LEFT JOIN comment b ON d.id = b.idproduct"
. " GROUP BY d.id\n"
. "".$sort."\n"
. "LIMIT ".$firtIndex.",".$limit;
$timesys=date('Y-m-d H:s:i');
// $_SESSION['sql']=$sql;
// echo $_SESSION['sql'];
$productList= executeResult($sql);
foreach($productList as $item){
  if((($item['price_old']-$item['price'])/$item['price_old'])>=0.1) $offer=round(($item['price_old']-$item['price'])*100/$item['price_old']).'%';
  elseif(strtotime($timesys)-strtotime($item["created_at"])<=2592000) $offer='New';
  else $offer='';
  echo '<div class="col-md-4 col-sm-6">
          <a href="details.php?id='.$item['id'].'"><div class="products">
            <div class="offer">
              '.$offer.'
            </div>
            <div class="thumbnail">
              <a href="?id='.$item['id'].'">
                <img src="admin/images/'.$item['image'].'" alt="Product Name">
              </a>
            </div>
            <div class="productname">
              '.$item['name'].'
            </div>
            <h4 class="price">
              '.$item['price'].'&nbsp;VNĐ
            </h4>
            <div class="button_group">
              <button class="button add-cart" type="button" onclick="addToCart(this);updateCart();">
                Thêm vào giỏ
              </button>
              <button class="button compare" type="button">
                <i class="fa fa-exchange">
                </i>
              </button>
              <button class="button wishlist" type="button">
                <i class="fa fa-heart-o">
                </i>
              </button>
            </div>
          </div></a>
        </div>';
}
  ?>
                </div>
                <div class="clearfix">
                </div>
                <div class="toolbar">
                  <div class="sorter bottom">
                    <div class="view-mode">
                      <a href="productlist.php" >
                        List
                      </a>
                      <a href="#" class="grid" class="list active">
                        Grid
                      </a>
                    </div>
                    <div class="sort-by">
                      Sort by : 
                      <form method="POST">
                        <input type="hidden"  name="token" value="<?=$token?>">
                        <select name="sort" onchange="this.form.submit()" >
                          <option value="" <?php if($sort=='') echo 'selected';?>>
                            Default
                          </option>
                          <option value="name" <?php if($sort=='ORDER BY name ASC') echo 'selected';?>>
                            Name
                          </option>
                          <option value="price" <?php if($sort=='ORDER BY price ASC') echo 'selected';?>>
                            Price
                          </option>
                        </select>
                      </form>
                    </div>
                    <div class="limiter">
                      Show : 
                      <form method="POST">
                        <input type="hidden"  name="token" value="<?=$token?>">
                        <select name="show" onchange="this.form.submit()">
                          <option value="3" <?php if($limit=='3') echo 'selected';?>>
                            3
                          </option>
                          <option value="6" <?php if($limit=='6') echo 'selected';?>>
                            6
                          </option>
                          <option value="9" <?php if($limit=='9') echo 'selected';?>>
                            9
                          </option>
                        </select>
                      </form>
                    </div>
                  </div>
                  <div class="pager">
                    <a <?php if($page>1) echo 'href="?page='.($page-1).'&from='.$from.'&to='.$to.'"'; else echo 'href="?search='.$key.'&from='.$from.'&to='.$to.'"'; ?> class="prev-page">
                      <i class="fa fa-angle-left">
                      </i>
                    </a>
                    <?php
                    if($countPage>3){
                     $avaiablePage= [1,2,3];
                     if($page>=3) {$avaiablePage= [$page-1,$page,$page+1];
                     if($page>=$countPage-2) $avaiablePage= [$countPage-2,$countPage-1,$countPage];}
                     foreach ($avaiablePage as $pageid) {
                       if($page==$pageid) echo '<a href="?page='.$pageid.'&search='.$key.'&from='.$from.'&to='.$to.'" class="active">'.$pageid.'</a>';
                       else echo '<a href="?page='.$pageid.'&search='.$key.'&from='.$from.'&to='.$to.'">'.$pageid.'</a>';
                     }
                    }else for ($i=1; $i <= $countPage; $i++) { 
                      if($page==$i) echo '<a href="?page='.$i.'&search='.$key.'&from='.$from.'&to='.$to.'" class="active">'.$i.'</a>';
                       else echo '<a href="?page='.$i.'&search='.$key.'&from='.$from.'&to='.$to.'">'.$i.'</a>';
                    }
                    ?>
                    <a <?php if($page<$countPage) echo 'href="?page='.($page+1).'&search='.$key.'&from='.$from.'&to='.$to.'"'; else echo 'href="?search='.$key.'&from='.$from.'&to='.$to.'"'; ?> class="next-page">
                      <i class="fa fa-angle-right">
                      </i>
                    </a>
                  </div>
                </div>
                <div class="clearfix">
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix">
          </div>
          <div class="our-brand">
            <h3 class="title">
              <strong>
                Nhãn hàng  
              </strong>
              của chúng tôi
            </h3>
            <div class="control">
              <a id="prev_brand" class="prev" href="#">
                &lt;
              </a>
              <a id="next_brand" class="next" href="#">
                &gt;
              </a>
            </div>
            <ul id="braldLogo">
            <?php
              //  Hiện thị logo các nhãn hiệu
              $sql='select * from brands';
              $listBrand=executeResult($sql);
              for ($i=0; $i < count($listBrand) ; $i++) { 
                if($i==0) echo '<tr><li>
                <ul class="brand_item"> </tr>';
                echo '<tr> <li>
                          <a href="#">
                            <div class="brand-logo"><img src="admin/images/'.$listBrand[$i]['logolink'].'" alt=""></div>
                          </a>
                      </li></tr>';
                if($i==count($listBrand)) echo '<tr> </ul>
                                                  </li> </tr>';
                if($i%5==0) echo '<tr>  </ul>
                                      </li>
                                  <li>
                                  <ul class="brand_item"> </tr>';
              }
            ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="clearfix">
      </div>
      <div class="footer">
        <div class="footer-info">
          <div class="container">
            <div class="row">
              <div class="col-md-3">
                <div class="footer-logo">
                  <a href="#">
                    <img src="images/logo.png" alt="">
                  </a>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <h4 class="title">
                  Contact 
                  <strong>
                    Info
                  </strong>
                </h4>
                <p>
                  17A, Cong Hoa, HCM, Viet Nam
                </p>
                <p>
                  Call Us : (084) 123456
                </p>
                <p>
                  Email : ahihi@gmail.com
                </p>
              </div>
              <div class="col-md-3 col-sm-6">
                <h4 class="title">
                  Customer
                  <strong>
                    Support
                  </strong>
                </h4>
                <ul class="support">
                  <li>
                    <a href="#">
                      FAQ
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Payment Option
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Booking Tips
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Infomation
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-md-3">
                <h4 class="title">
                  Get Our 
                  <strong>
                    Newsletter 
                  </strong>
                </h4>
                <p>
                  Tiết kiệm hơn - Sống khỏe hơn
                </p>
                <form class="newsletter">
                  <input type="text" name="" placeholder="Type your email....">
                  <input type="submit" value="SignUp" class="button">
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="copyright-info">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <p>
                  Copyright © 2012. Designed by 
                  <a href="#">
                    KMA
                  </a>
                  . All rights reseved
                </p>
              </div>
              <div class="col-md-6">
                <ul class="social-icon">
                  <li>
                    <a href="#" class="linkedin">
                    </a>
                  </li>
                  <li>
                    <a href="#" class="google-plus">
                    </a>
                  </li>
                  <li>
                    <a href="#" class="twitter">
                    </a>
                  </li>
                  <li>
                    <a href="#" class="facebook">
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="js/jquery-1.10.2.min.js">
    </script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js">
    </script>
    <script type="text/javascript" src="js/bootstrap.min.js">
    </script>
    <script defer src="js/jquery.flexslider.js">
    </script>
    <script type="text/javascript" src="js/jquery.sequence-min.js">
    </script>
    <script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js">
    </script>
    <script type="text/javascript" src="js/script.min.js" >
    </script>
  </body>
</html>