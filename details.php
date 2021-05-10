<?php
require_once('Database/dbhelper.php');
session_start();
$username = null; 
$fullname = '';
if(isset($_SESSION['userinfor'])) {
	$username = $_SESSION['userinfor'];
	$fullname = $username['fullname'];
  $email= $username['email'];
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
      Chi tiết sản phẩm
    </title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script type="text/javascript" src="js/logout.js"></script>
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js">
</script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js">
</script>
<![endif]-->
 <!-- Bootstrap core JavaScript==================================================-->
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	  <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	  <script type="text/javascript" src="js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="js/jquery.sequence-min.js"></script>
	  <script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript" src="js/script.min2.js" ></script>
    <script type="text/javascript" src="js/cartfordetails.js"></script>
    <style>
    .top-space{
      margin-top: 7% !important;
    }
    </style>
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
                    <?php
                      if($username!= null){
                        echo '<tr>
                        <h5 class="text-center">Xin chào <strong>'.$fullname.'</strong></h5>
                        <li><a href="Database/Logout.php" class="log" onclick="logout()">Đăng xuất</a></li>
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
                        <li id="marker"><span class="total">Tổng <strong id="total-price" >0 VNĐ</strong></span><button class="checkout" onClick="checkout()">Thanh Toán</button></li>
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
                            <a href="checkout.php">
                              Thanh Toán
                            </a>
                          </li>
                          <li>
                            <a href="contact.php">
                              Liên hệ
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                      <a href="">
                        blog
                      </a>
                    </li>
                    <li>
                      <a href="contact.php">
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
                      <select id="quality">
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

<script>
$(document).ready(function(){
    // Hàm active tab nào đó
    function activeTab(obj)
    {
        // Xóa class active tất cả các tab
        $('.tab-box #tabnav ul li').removeClass('active');
 
        // Thêm class active vòa tab đang click
        $(obj).addClass('active');
 
        // Lấy href của tab để show content tương ứng
        var id = $(obj).find('a').attr('href');
 
        // Ẩn hết nội dung các tab đang hiển thị
        $('.tab').hide();
 
        // Hiển thị nội dung của tab hiện tại
        $(id) .show();
    }
 
    // Sự kiện click đổi tab
    $('#tabnav li').click(function(){
        activeTab(this);
        return false;
    });
 
    // Active tab đầu tiên khi trang web được chạy
    activeTab($('#tabnav li:first-child'));
});
</script>
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
                <div class="tab-content top-space">
                  <div class="tab" id="Descraption">
                    <p>
                      <?=$product['des_product']?>
                    </p>
                  </div>
                  <div class="tab" id="Reviews">
                    <form method="POST" action="js/upcomment.php">
                      <table>
                        <thead>
                          <tr>
                            <th>
                              &nbsp;
                            </th>
                            <th>
                              1 sao
                            </th>
                            <th>
                              2 sao
                            </th>
                            <th>
                              3 sao
                            </th>
                            <th>
                              4 sao
                            </th>
                            <th>
                              5 sao
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              Số lượng
                            </td>
                            <td>
                              <input type="radio" name="quality" value="1"/>
                            </td>
                            <td>
                              <input type="radio" name="quality" value="2">
                            </td>
                            <td>
                              <input type="radio" name="quality" value="3">
                            </td>
                            <td>
                              <input type="radio" name="quality" value="4">
                            </td>
                            <td>
                              <input type="radio" name="quality" value="5">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Giá
                            </td>
                            <td>
                              <input type="radio" name="price" value="1">
                            </td>
                            <td>
                              <input type="radio" name="price" value="2">
                            </td>
                            <td>
                              <input type="radio" name="price" value="3">
                            </td>
                            <td>
                              <input type="radio" name="price" value="4">
                            </td>
                            <td>
                              <input type="radio" name="price" value="5">
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Chất lượng
                            </td>
                            <td>
                              <input type="radio" name="value" value="1">
                            </td>
                            <td>
                              <input type="radio" name="value" value="2">
                            </td>
                            <td>
                              <input type="radio" name="value" value="3">
                            </td>
                            <td>
                              <input type="radio" name="value" value="4">
                            </td>
                            <td>
                              <input type="radio" name="value" value="5">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <div class="form-row"> 
                            <label class="lebel-abs">  
                            Họ tên:   
                              <!-- tự fill full name và disable form khi đã đăng nhập -->                       
                              <?php
                              if(isset($fullname) and $fullname!='') $statusname=' value="'.$fullname.'" readonly';
                              else {
                                $statusname='';
                                echo '<tr> 
                                <strong class="red">
                                *
                              </strong>  
                                </tr>';
                              }   
                              ?>
                            </label>

                            <input type="text" id="fullname" name="fullname" class="input namefild"  <?php echo $statusname;?>>
                          </div>
                          <div class="form-row">
                            <label class="lebel-abs">
                              Email 
                              <!-- tự fill email -->
                              <?php
                              if(isset($email) and $email!='') $statusemail=' value="'.$email.'" readonly';
                              else {
                                $statusemail='';
                                echo '<tr>
                                <strong class="red">
                                *
                              </strong>
                                </tr>';
                              }
                              ?>
                            </label>
                            <input type="email" name="email" id="email" class="input emailfild" <?php echo $statusemail;?>>
                          </div>
                          <div class="form-row">
                            <label class="lebel-abs">
                              Tóm tắt 
                              <strong class="red">
                                *
                              </strong>
                            </label>
                            <input type="text" name="summary" class="input summeryfild">
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <div class="form-row">
                            <label class="lebel-abs">
                              Đánh giá chi tiết
                            </label>
                            <textarea class="input textareafild" name="content" rows="7" >
                            </textarea>
                          </div>
                          <input type="hidden" name="idproduct" value="<?=$id?>">
                          <?php if(isset($username)) echo '<input type="hidden" name="idCus" value="'.$username['ID'].'">';?>
                          <?php  if(isset($_SESSION['notify'])) {
                            echo $_SESSION['notify'];
                            unset($_SESSION['notify']);
                          }
                            ?>
                          <div class="form-row">
                            <input type="submit" value="Submit" class="button">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- hiện thị bình luận sản phẩm -->
                <?php
                $sql = 'SELECT * FROM comment  WHERE Idproduct='.$id.' ORDER BY create_at DESC';
                $listcomment=executeResult($sql);
                foreach ($listcomment as $item) {
                  echo '<tr>
                    <div class="tab-content">
                    <div class="row">
                      <div class="col-md-9">
                        <h5 class="reviewer">
                          '.$item['fullname'].'
                        </h5>
                        <p class="review-date">
                          Date: '.$item['create_at'].'
                        </p>
                        <p>
                          <b>Tóm tắt:</b>&nbsp'.$item['summary'].'
                          <br><b>Nội dung:</b>&nbsp'.$item['content'].'
                        </p>
                      </div>
                      <div class="col-md-2">
                      <p class="rating">';
                      for ($i=1; $i <= round($item['voted']); $i++) { 
                        echo '<i class="fa fa-star light-red">
                          </i>';
                      }  
                      for ($i=5; $i > round($item['voted']) and $i>0; $i--) { 
                        echo '<i class="fa fa-star-o gray">
                        </i>';
                      }                     
                      echo'</p>';
                      if(isset($username)){
                      if($username['ID']==$item['IDaccount']) echo ' <button onclick="deleteComment('.$item['ID'].','.$item['IDaccount'].')">Xóa</button>';}
                      echo'</div>
                        </div>
                      </div>
                        </tr>';
                }
                ?>
<script type="text/javascript">
  function deleteComment(id,userid) {
    var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
    if(!option) {
      return;
    }
    console.log(id)
    //ajax - lenh post
    $.post('js/deleteowncomment.php',{'id' : id, 'userid' : userid},
     function(data) {
      location.reload()
    });
  }
</script>
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
                              <div class="button_group"><button class="button add-cart" type="button" onclick="addToCart(this);updateCart();">Thêm vào giỏ</button></div>
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
                            $temp=0;
                            $sql='select * from brands';
                            $listBrand=executeResult($sql);
                            for ($i=0; $i < count($listBrand) ; $i++) { 
                                if($i==0) echo '<tr><li>
                                <ul class="brand_item"> </tr>';
                                echo '<tr> <li>
                                        <a href="produclist.php?search='.$listBrand[$i]['name'].'">
                                            <div class="brand-logo"><img src="admin/images/'.$listBrand[$i]['logolink'].'" alt=""></div>
                                        </a>
                                    </li></tr>';
                                    $temp=$temp+1;
                                    
                                if($i==(count($listBrand)-1)) echo '<tr> </ul>
                                                              </li> </tr>';
                                if($temp==5) {
                                    echo '<tr>  </ul>
                                                    </li>
                                                <li>
                                                <ul class="brand_item"> </tr>';
                                
                                    $temp=0;
                                }
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
  </body>
</html>