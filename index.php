<?php
require_once('Database/dbhelper.php');
session_start();
$username = null; 
$fullname = '';
if(isset($_SESSION['userinfor'])) {
	$username = $_SESSION['userinfor'];
	$fullname = $username['fullname'];
}
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
      <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script><![endif]-->
   </head>
   <body id="home">
      <div class="wrapper" style="margin-top: 100px;">
         <div class="header">    
            <div class="container">
               <div class="row">
                  <div class="col-md-2 col-sm-2">
                     <div class="logo"><a href="index.html"><img src="images/logo.png" alt="FlatShop"></a></div>
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
                                 <li><a href="#">About Us</a></li>
                                 <li><a href="#">News</a></li>
                                 <li><a href="#">Service</a></li>
                                 <li><a href="#">Recruiment</a></li>
                                 <li><a href="#">Media</a></li>
                                 <li><a href="#">Support</a></li>
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
                     <div class="clearfix"></div>
                     <div class="header_bottom">
                        <ul class="option">
                           <li id="search" class="search">
                              <form><input class="search-submit" type="submit" value=""><input class="search-input" placeholder="Enter your search term..." type="text" value="" name="search"></form>
                           </li>
                           <li class="option-cart" onmouseover="updateCart(),updatePrice()">
                              <a href="#" class="cart-icon">cart <span class="cart_no">0</span></a>
                              <ul class="option-cart-item" id="cart-list">
                                 <li id="marker"><span class="total">Total <strong id="total-price" >600.000 VNĐ</strong></span><button class="checkout" onClick="location.href='checkout.html'">CheckOut</button></li>
                              </ul>
                           </li>
                        </ul>
                        <div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div>
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
                                       <li><a href="checkout2.php">CheckOut2</a></li>
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
         </div>
         <div class="clearfix"></div>
         <div class="hom-slider">
            <div class="container">
               <div id="sequence">
                  <div class="sequence-prev"><i class="fa fa-angle-left"></i></div>
                  <div class="sequence-next"><i class="fa fa-angle-right"></i></div>
                  <ul class="sequence-canvas">
                     <li class="animate-in">
                        <div class="flat-caption caption1 formLeft delay300 text-center"><span class="suphead">Tiết kiệm hơn, sống khỏe hơn </span></div>
                        <div class="flat-caption caption2 formLeft delay400 text-center">
                           <h1>Sale 2020</h1>
                        </div>
                        <div class="flat-caption caption3 formLeft delay500 text-center">
                           <p>Chung tay bảo vệ sức khỏe cho cả gia đình bạn.</p>
                        </div>
                        <div class="flat-button caption4 formLeft delay600 text-center"><a class="more" href="#">More Details</a></div>
                       
                        <div class="flat-image formBottom delay200" data-duration="5" data-bottom="true"><img src="images/slider-image-01.png" alt=""></div>
                     </li>
                     <li>
                        <div class="flat-caption caption2 formLeft delay400">
                           <h1>Tư vấn về toa thuốc</h1>
                        </div>
                        <div class="flat-caption caption3 formLeft delay500">
                           <h2>Tìm nơi tư vấn và mua thuốc với giá tốt, uy tín. 
                              Hãy để Pharmacity giúp bạn!</h2>
                        </div>
                        <div class="flat-button caption5 formLeft delay600"><a class="more" href="#">More Details</a></div>
                        <div class="flat-image formBottom delay200" data-bottom="true"><img src="images/slider-image-02.png" alt=""></div>
                     </li>
                     <li>
                        <div class="flat-caption caption2 formLeft delay400 text-center">
                           <h1>Ưu đãi lên đến 50%</h1>
                        </div>
                        <div class="flat-caption caption3 formLeft delay500 text-center">
                           <p>Dành cho thành viên của EXTRA CARE</p>
                        </div>
                        <div class="flat-button caption4 formLeft delay600 text-center"><a class="more" href="#">More Details</a></div>
                        <div class="flat-image formBottom delay200" data-bottom="true"><img src="images/slider-image-03.png" alt=""></div>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="promotion-banner">
               <div class="container">
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="promo-box"><img src="images/promotion-01.png" alt=""></div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="promo-box"><img src="images/promotion-02.png" alt=""></div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="promo-box"><img src="images/promotion-03.png" alt=""></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="container_fullwidth">
            <div class="container">
               <div class="hot-products">
                  <h3 class="title"><strong>Đề Xuất</strong> </h3>
                  <div class="control"><a id="prev_hot" class="prev" href="#">&lt;</a><a id="next_hot" class="next" href="#">&gt;</a></div>
                  <ul id="hot">
                      
                    <li>
                        <?php
                        echo '<div class="row">';
                        // hiện thị sản phẩm đề xuất 4 sản phẩm mới
                        $sql="select * from product where amount>0 and created_at like '%2021%' order by created_at DESC limit 0,4";
                        $listSuggest= executeResult($sql);
                        foreach ($listSuggest as $item ) {
                            echo '<tr>
                            <div class="col-md-3 col-sm-6">
                                <div class="products">
                                    <div class="thumbnail"><a href="details.php?id='.$item['id'].'"><img src="admin/images/'.$item['image'].'" alt="Product Name"></a></div>
                                    <div class="productname"></br></br>'.$item['name'].'</div>
                                    <h4 class="price">'.$item['price'].' VNĐ</h4>
                                    <div class="button_group"><button class="button add-cart" type="button" onclick="addToCart(this);updateCart();">Thêm vào giỏ</button><button class="button compare" type="button"><i class="fa fa-exchange"></i></button><button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button></div>
                                </div>
                            </div>
                            </tr>';
                        }
                        echo '</div>';
                        ?>
                    </li>
                    <li>
                        <div class="row">
                            <?php
                            // hiện thi sản phẩm đề xuất trang 2 4 sản phẩm giảm giá 
                            $sql = "SELECT *, (price_old-price)*100/price_old saleoff FROM `product`   WHERE amount>0 \n"

                                . "ORDER BY created_at DESC, saleoff DESC\n"

                                . "LIMIT 0,4";
                            $listSuggest2=executeResult($sql);
                            foreach ($listSuggest2 as $item) {
                                echo '<tr>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="products">
                                            <div class="thumbnail"><a href="details.php?id-'.$item['id'].'"><img src="admin/images/'.$item['iamge'].'" alt="Product Name"></a></div>
                                            <div class="productname"></br></br>'.$item['name'].'</div>
                                            <h4 class="price">'.$item['price'].' VNĐ</h4>
                                            <div class="button_group"><button class="button add-cart" type="button" onclick="addToCart(this);updateCart();">Thêm vào giỏ</button><button class="button compare" type="button"><i class="fa fa-exchange"></i></button><button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button></div>
                                        </div>
                                    </div>
                                </tr>';
                            }
                            ?>
                        </div>
                    </li>
                  </ul>
               </div>
               <div class="clearfix"></div>
               <div class="featured-products">
                  <h3 class="title"><strong>Sản phẩm </strong> khác</h3>
                  <div class="control"><a id="prev_featured" class="prev" href="#">&lt;</a><a id="next_featured" class="next" href="#">&gt;</a></div>
                  <ul id="featured">
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
                              <div class="button_group"><button class="button add-cart" type="button">Thêm vào giỏ</button><button class="button compare" onclick="addToCart(this);updateCart();" type="button"><i class="fa fa-exchange"></i></button><button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button></div>
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
                                    <div class="button_group"><button class="button add-cart" type="button" onclick="addToCart(this);updateCart();">Thêm vào giỏ</button><button class="button compare" type="button"><i class="fa fa-exchange"></i></button><button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button></div>
                                 </div>
                              </div>
                              </tr>';
                           }
                           ?>
                        </div>
                     </li>
                  </ul>
               </div>
               <div class="clearfix"></div>
               <div class="our-brand">
                  <h3 class="title"><strong>Nhãn hàng </strong> của chúng tôi</h3>
                  <div class="control"><a id="prev_brand" class="prev" href="#">&lt;</a><a id="next_brand" class="next" href="#">&gt;</a></div>
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
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="footer">
            <div class="footer-info">
               <div class="container">
                  <div class="row">
                     <div class="col-md-3">
                        <div class="footer-logo"><a href="#"><img src="images/logo.png" alt=""></a></div>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <h4 class="title">Contact <strong>Info</strong></h4>
                        <p>17A, Cong Hoa, HCM , Vietnam</p>
                        <p>Call Us : (084) 1234567</p>
                        <p>Email : ahihi@gmail.com</p>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <h4 class="title">Customer<strong> Support</strong></h4>
                        <ul class="support">
                           <li><a href="#">FAQ</a></li>
                           <li><a href="#">Payment Option</a></li>
                           <li><a href="#">Booking Tips</a></li>
                           <li><a href="#">Infomation</a></li>
                        </ul>
                     </div>
                     <div class="col-md-3">
                        <h4 class="title">Get Our <strong>Newsletter </strong></h4>
                        <p>Pharmacity VN</p>
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
                        <p>Copyright © 2012. Designed by <a href="#">KMA</a>. All rights reseved</p>
                     </div>
                     <div class="col-md-6">
                        <ul class="social-icon">
                           <li><a href="#" class="linkedin"></a></li>
                           <li><a href="#" class="google-plus"></a></li>
                           <li><a href="#" class="twitter"></a></li>
                           <li><a href="#" class="facebook"></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Bootstrap core JavaScript==================================================-->
	  <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	  <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	  <script type="text/javascript" src="js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="js/jquery.sequence-min.js"></script>
	  <script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript" src="js/script.min.js" ></script>
     <script type="text/javascript" src="js/cart.js"></script>
   </body>
</html>