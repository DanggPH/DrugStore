<?php
require_once('Database/dbhelper.php');
session_start();
$username = null; 
$fullname = '';
if(isset($_SESSION['userinfor'])) {
	$username = $_SESSION['userinfor'];
	$fullname = $username['fullname'];
}
if(isset($_GET['id'])) {
  $id=$_GET['id'];
  $sql = "SELECT a.*, avg(b.voted) vote, COUNT(b.ID) count\n"
    . "FROM product a\n"
    . "LEFT JOIN comment b\n"
    . "ON a.id=b.idproduct\n"
    . "GROUP by a.id\n"
    . "HAVING a.id=".$id;
  if(executeSingleResult($sql)!=null) $product=executeSingleResult($sql);
  else header('Location: productlist.php');
}
else header('Location: productlist.php');
$sql = "SELECT a.*, avg(b.voted) vote, COUNT(b.ID) count\n"

    . "FROM product a\n"

    . "LEFT JOIN comment b\n"

    . "ON a.id=b.idproduct\n";

?>


<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>
      Welcome to DrugStore
    </title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>
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
                  <li id="search" class="search" >
                    <form method="GET" action="productlist.php">
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
                              Trang chủ
                            </a>
                          </li>
                          <li>
                            <a href="productlist.php">
                              Danh sách sản phẩm
                            </a>
                          </li>        
                          <li>
                            <a href="cart.php">
                              Cart
                            </a>
                          </li>
                          <li>
                            <a href="checkout.php">
                              CheckOut
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
                      <a href="productgird.html">
                        Sale
                      </a>
                    </li>
                    <li>
                      <a href="productlitst.html">
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
                                  New Collection
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Shirts & tops
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Laptop & Brie
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Dresses
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Blazers & Jackets
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Shoulder Bags
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <ul class="mega-menu-links">
                              <li>
                                <a href="productgird.html">
                                  New Collection
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Shirts & tops
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Laptop & Brie
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Dresses
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Blazers & Jackets
                                </a>
                              </li>
                              <li>
                                <a href="productgird.html">
                                  Shoulder Bags
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <a href="productgird.html">
                        blog
                      </a>
                    </li>
                    <li>
                      <a href="productgird.html">
                        Liên hệ chúng tôi
                      </a>
                    </li>
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
              Chi tiết sản phẩm
            </p>
          </div>
        </div>
      </div>
      <div class="clearfix">
      </div>
      <div class="container_fullwidth">
        <div class="container">
          <div class="row">
            <div class="col-md-9">
              <div class="products-details">
                <div class="preview_image">
                  <div class="preview-small">
                    <img id="zoom_03" src="admin/images/<?=$product['image']?>" alt="">
                  </div>
                  <!-- <div class="thum-image">
                    <ul id="gallery_01" class="prev-thum">
                      <li>
                        <a href="#" data-image="images/products/medium/products-01.jpg" data-zoom-image="images/products/Large/products-01.jpg">
                          <img src="images/products/thum/products-01.png" alt="">
                        </a>
                      </li>
                      <li>
                        <a href="#" data-image="images/products/medium/products-02.jpg" data-zoom-image="images/products/Large/products-02.jpg">
                          <img src="images/products/thum/products-02.png" alt="">
                        </a>
                      </li>
                      <li>
                        <a href="#" data-image="images/products/medium/products-03.jpg" data-zoom-image="images/products/Large/products-03.jpg">
                          <img src="images/products/thum/products-03.png" alt="">
                        </a>
                      </li>
                      <li>
                        <a href="#" data-image="images/products/medium/products-04.jpg" data-zoom-image="images/products/Large/products-04.jpg">
                          <img src="images/products/thum/products-04.png" alt="">
                        </a>
                      </li>
                      <li>
                        <a href="#" data-image="images/products/medium/products-05.jpg" data-zoom-image="images/products/Large/products-05.jpg">
                          <img src="images/products/thum/products-05.png" alt="">
                        </a>
                      </li>
                    </ul>
                    <a class="control-left" id="thum-prev" href="javascript:void(0);">
                      <i class="fa fa-chevron-left">
                      </i>
                    </a>
                    <a class="control-right" id="thum-next" href="javascript:void(0);">
                      <i class="fa fa-chevron-right">
                      </i>
                    </a>
                  </div> -->
                </div>
                <div class="products-description">
                  <h5 class="name">
                    <?=$product['name']?>
                  </h5>
                  <p>
                    <img alt="" src="images/<?=round($product['vote'])?>star.png">
                    <a class="review_num" href="#">
                      <?=$product['count']?> Review(s)
                    </a>
                  </p>
                  <p>
                    Tình trạng: 
                    <span class=" light-red">
                      <?php
                      if($product['amount']>0) echo 'Còn hàng';
                      else echo 'Hết hàng';
                      ?>
                    </span>
                  </p>
                  <p>
                    Mã sản phẩm: 
                    <span class=" light-red">
                      <?=$product['id']?>
                      </span>
                  </p>
                  <hr class="border">
                  <div class="price">
                    Giá : 
                    <span class="new_price">
                      <?=$product['price']?>
                      <sup>
                        VNĐ
                      </sup>
                    </span>
                    <span class="old_price">
                    <?=$product['price_old']?>
                      <sup>
                        VNĐ
                      </sup>
                    </span>
                  </div>
                  <hr class="border">
                  <div class="wided">
                    <div class="Sô lượng">
                      Sô lượng &nbsp;&nbsp;: 
                      <select>
                        <?php
                        for ($i=1; $i <= $product['amount']; $i++) { 
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="button_group">
                      <button class="button" onclick="addToCart(this);updateCart();" >
                        Thêm vào giỏ
                      </button>
                      <button class="button compare">
                        <i class="fa fa-exchange">
                        </i>
                      </button>
                      <button class="button favorite">
                        <i class="fa fa-heart-o">
                        </i>
                      </button>
                      <button class="button favorite">
                        <i class="fa fa-envelope-o">
                        </i>
                      </button>
                    </div>
                  </div>
                  <div class="clearfix">
                  </div>
                  <hr class="border">
                  <img src="images/share.png" alt="" class="pull-right">
                </div>
              </div>
              <div class="clearfix">
              </div>
              <div class="tab-box">
                <div id="tabnav">
                  <ul>
                    <li>
                      <a href="#Descraption">
                        MÔ TẢ
                      </a>
                    </li>
                    <li>
                      <a href="#Reviews">
                        PHẢN HỒI
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="tab-content-wrap">
                  <div class="tab-content" id="Descraption">
                    <p>
                      <?=$product['des_product']?>
                    </p>
                  </div>
                  <div class="tab-content" id="Reviews">
                    <form>
                      <table>
                        <thead>
                          <tr>
                            <th>
                              &nbsp;
                            </th>
                            <th>
                              1 star
                            </th>
                            <th>
                              2 stars
                            </th>
                            <th>
                              3 stars
                            </th>
                            <th>
                              4 stars
                            </th>
                            <th>
                              5 stars
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              Quality
                            </td>
                            <td>
                              <input type="radio" name="quality" value="Blue"/>
                            </td>
                            <td>
                              <input type="radio" name="quality" value="">
                            </td>
                            <td>
                              <input type="radio" name="quality" value="">
                            </td>
                            <td>
                              <input type="radio" name="quality" value="">
                            </td>
                            <td>
                              <input type="radio" name="quality" value="">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Price
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                            <td>
                              <input type="radio" name="price" value="">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Value
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                            <td>
                              <input type="radio" name="value" value="">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <div class="form-row">
                            <label class="lebel-abs">
                              Your Name 
                              <strong class="red">
                                *
                              </strong>
                            </label>
                            <input type="text" name="" class="input namefild">
                          </div>
                          <div class="form-row">
                            <label class="lebel-abs">
                              Your Email 
                              <strong class="red">
                                *
                              </strong>
                            </label>
                            <input type="email" name="" class="input emailfild">
                          </div>
                          <div class="form-row">
                            <label class="lebel-abs">
                              Summary of You Review 
                              <strong class="red">
                                *
                              </strong>
                            </label>
                            <input type="text" name="" class="input summeryfild">
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <div class="form-row">
                            <label class="lebel-abs">
                              Your Name 
                              <strong class="red">
                                *
                              </strong>
                            </label>
                            <textarea class="input textareafild" name="" rows="7" >
                            </textarea>
                          </div>
                          <div class="form-row">
                            <input type="submit" value="Submit" class="button">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-content" >
                    <div class="review">
                      <p class="rating">
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star-half-o gray">
                        </i>
                        <i class="fa fa-star-o gray">
                        </i>
                      </p>
                      <h5 class="reviewer">
                        Reviewer name
                      </h5>
                      <p class="review-date">
                        Date: 01-01-2014
                      </p>
                      <p>
                        Tiết kiệm hơn - Sống khỏe hơn
                      </p>
                    </div>
                    <div class="review">
                      <p class="rating">
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star light-red">
                        </i>
                        <i class="fa fa-star-half-o gray">
                        </i>
                        <i class="fa fa-star-o gray">
                        </i>
                      </p>
                      <h5 class="reviewer">
                        Reviewer name
                      </h5>
                      <p class="review-date">
                        Date: 01-01-2014
                      </p>
                      <p>
                        Tiết kiệm hơn - Sống khỏe hơn
                      </p>
                    </div>
                  </div>
                  <div class="tab-content" id="tags">
                    <div class="tag">
                      Add Tags : 
                      <input type="text" name="">
                      <input type="submit" value="Tag">
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix">
              </div>
              <div id="productsDetails" class="hot-products">
                <h3 class="title">
                  <strong>
                    Đề 
                  </strong>
                  Xuất
                </h3>
                <div class="control">
                  <a id="prev_hot" class="prev" href="#">
                    &lt;
                  </a>
                  <a id="next_hot" class="next" href="#">
                    &gt;
                  </a>
                </div>
                <ul id="hot">
                <li>
                     <div class="row">
                     <?php
                     //hiện thị 8 sản phẩm ngẫu nhiên
                     $limit=4;
                     $sqlCount="select count(id) count from product";
                     $count=executeSingleResult($sqlCount)['count'];
                     $countPage=round(($count/$limit),1);
                     $page=rand(0,$countPage);
                     $firtIndex=$page;
                     $sql="select * from product where 1 limit ".$firtIndex.",".$limit;
                     $listSuggest3=executeResult($sql);
                     foreach ($listSuggest3 as $item) {
                        echo '<tr>
                        <div class="col-md-3 col-sm-6">
                           <div class="products">
                              <div class="thumbnail"><a href="details.php?id='.$item['id'].'"><img src="admin/images/'.$item['image'].'" alt="Product Name"></a></div>
                              <div class="productname">'.$item['name'].'</div>
                              <h4 class="price">'.$item['price'].' VNĐ</h4>
                              <div class="button_group"><button class="button add-cart" type="button" onclick="addToCart(this);updateCart();">Thêm vào giỏ</button><button class="button compare" type="button"><i class="fa fa-exchange"></i></button><button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button></div>
                           </div>
                        </div>
                        </tr>';
                     }
                     ?>
                     </div>
                  </li>
                     <li>
                        <div class="row">
                           <?php
                           $page=rand(0,$countPage);
                           $firtIndex=$page;
                           $sql="select * from product where 1 limit ".$firtIndex.",".$limit;
                           $listSuggest3=executeResult($sql);
                           foreach ($listSuggest3 as $item) {
                              echo '<tr>
                              <div class="col-md-3 col-sm-6">
                                 <div class="products">
                                    <div class="thumbnail"><a href="details.php?id='.$item['id'].'"><img src="admin/images/'.$item['image'].'" alt="Product Name"></a></div>
                                    <div class="productname">'.$item['name'].'</div>
                                    <h4 class="price">'.$item['price'].' VNĐ</h4>
                                    <div class="button_group"><button class="button add-cart" type="button" onclick="addToCart(this);updateCart();" >Thêm vào giỏ</button><button class="button compare" type="button"><i class="fa fa-exchange"></i></button><button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button></div>
                                 </div>
                              </div>
                              </tr>';
                           }
                           ?>
                        </div>
                     </li>
                </ul>
              </div>
              <div class="clearfix">
              </div>
            </div>
            <div class="col-md-3">
              <div class="special-deal leftbar">
                <h4 class="title">
                  Đặc 
                  <strong>
                    Biệt
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
              <div class="clearfix">
              </div>
              <div class="get-newsletter leftbar">
                <h3 class="title">
                  PHẢN  
                  <strong>
                    HỒI
                  </strong>
                </h3>
                <p>
                  Vui lòng nhập email để phản hồi cho chúng tôi
                </p>
                <form>
                  <input class="email" type="text" name="" placeholder="Your Email...">
                  <input class="submit" type="submit" value="Submit">
                </form>
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
                    Facebook của chúng tôi
                  </a>
                </div>
              </div>
              <div class="clearfix">
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
                  Liên  
                  <strong>
                    hệ
                  </strong>
                </h4>
                <p>
                  17A, Cong Hoa, HCM , Vietnam
                </p>
                <p>
                  Sđt : (084) 1234567
                </p>
                <p>
                  Email : ahihi@gmail.com
                </p>
              </div>
              <div class="col-md-3 col-sm-6">
                <h4 class="title">
                  Hỗ trợ
                  <strong>
                    khách hàng
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
                  Phản 
                  <strong>
                    Hồi 
                  </strong>
                </h4>
                <p>
                  Pharmacity VN.
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
                    Michael Lee
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
    <!-- Bootstrap core JavaScript==================================================-->
    <script type="text/javascript" src="js/jquery-1.10.2.min.js">
    </script>
    <script type="text/javascript" src="js/bootstrap.min.js">
    </script>
    <script defer src="js/jquery.flexslider.js">
    </script>
    <script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js">
    </script>
    <script type="text/javascript" src='js/jquery.elevatezoom.js'>
    </script>
    <script type="text/javascript" src="js/script.min.js" >
    </script>
  </body>
</html>