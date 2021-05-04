<?php
require_once('../db/dbhelper.php');
session_start();
if(isset($_SESSION['username']) and isset($_SESSION['password'])){
    $username=$_SESSION['username'];
    $password=$_SESSION['password'];
    $sql = "select * from accountad where username = '$username' and password = '$password' ";
    $num_rows=numrows($sql);
    if(numrows($sql)==0){
        session_unset();
        header('Location: ../login/login.php');
    }

}else header('Location: ../login/login.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to dash  </title>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <style>
      .circle {
        line-height: 0;		/* remove line-height */ 
        display: inline-block;	/* circle wraps image */
        margin: 5px;
        border: 2px solid rgba(255,255,255,0.4);
        border-radius: 50%;	/* relative value */
        /*box-shadow: 0px 0px 5px rgba(0,0,0,0.4);*/
        transition: linear 0.25s;
        height: 32px;
        width: 32px;
      }
      .circle img {
        border-radius: 50%;	/* relative value for
                adjustable image size */
      }
      .circle:hover {
        transition: ease-out 0.2s;
        border: 2px solid rgba(255,255,255,0.8);
        -webkit-transition: ease-out 0.2s;
      }
      a.circle {
        color: transparent;
      } /* IE fix: removes blue border */	
      body {
        background-color: lightblue;
        }
      .top-space{
        margin-top: 5% !important;
    }
    </style>
  </head>
  <body>
    <head>
      <nav class="navbar navbar-dark bg-dark">
        <!-- <div class="container-fluid"> -->
          <a class="navbar-brand" href="#">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sideBar" aria-controls="sideBar" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <img src="../images/logo.png" alt="" width="80" height="50" class="d-inline-block align-text-top">
          </a>
          <ul class="nav justify-item-end">
            <div class="btn-group dropdown nav-item text-nowrap">
              <button type="button" class="btn btn-secondary dropdown-toggle bg-transparent" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../images/admin.png" alt="Avatar" class="circle d-inline">
              </button>
              <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item" href="../profile.php">Thông tin cá nhân</a></li>
                <li><a class="dropdown-item" href="../login/logout.php">Đăng xuất</a></li>
              </ul>
              </ul>
            </div>
          </ul>
        <!-- </div> -->
      </nav>
    </head>
    <div class="container-fluid">
      <div class="row">
        <nav id="sideBar" class="col-md-5 col-lg-2 bg-light sidebar d-md-block collapse show">
          <div class="position-sticky pt-3">
            <ul class="nav flex-column">
              <div class="list-group">
                <a href="../dashboard/" class="list-group-item list-group-item-action active" aria-current="true">
                  Dashboard
                </a>
                <a href="../order/" class="list-group-item list-group-item-action ">
                  Đơn hàng
                </a>
                <a href="../brand/" class="list-group-item list-group-item-action ">
                  Nhãn hiệu
                </a>
                <a href="../product/index.php" class="list-group-item list-group-item-action ">
                  Sản Phẩm
                </a>
                <a href="../banner/" class="list-group-item list-group-item-action">
                  Banner quảng cáo
                </a>
                <a href="../comment/" class="list-group-item list-group-item-action ">
                  Đánh giá khách hàng
                </a>
              </div>
            </ul>
          </div>        
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 top-space">
        <div class="album py-5 bg-light">
          <div class="container ">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">   
              <div class="col">
                <div class="card shadow-sm" style="width: 18rem;" >
                  <a href="../order/"><img src="../images/order.jpg" class="card-img-top" style="height: 15rem;" href="../oder/"></a>
                  <div class="card-body">
                    <p class="card-text fs-4">
                      <?php
                      $sql="select count(*) total from ordertable";
                      $item=executeSingleResult($sql);
                      $sql1='select count(*) unconfirm from ordertable where status=0';
                      $item1=executeSingleResult($sql1);
                      echo 'Đơn hàng:'.$item['total']. '<a href="../order/index.php?searchz=unconfirm"class="text-danger ">('.$item1['unconfirm'].')</a>';

                      ?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card shadow-sm" style="width: 18rem;">
                  <a href="../product/"><img src="../images/amount.png" class="card-img-top" style="height: 15rem;" href="../product/"></a>
                  <div class="card-body">
                    <p class="card-text fs-4">
                      Sản phẩm tồn kho: 
                      <?php
                      $sql="select count(*) total from product where amount > 0";
                      $item=executeSingleResult($sql);
                      echo $item['total'];
                      ?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card shadow-sm" style="width: 18rem;">
                  <a href="../comment/"><img src="../images/comment.png" class="card-img-top" style="height: 15rem;"></a>
                  <div class="card-body">
                    <p class="card-text fs-4">
                      Số lượng đánh giá: 
                      <?php
                      $sql="select count(*) total from comment";
                      $item=executeSingleResult($sql);
                      echo $item['total'];
                      ?>
                    </p>
                  </div>
                </div>
              </div>
            <!-- nôi dung trong đấy 
          mình cần 4 page
          page 1( dashboard): cần 3 ô tổng quan có title: tổng sản phẩm, tổng đơn hàng, hàng còn lại
          page 2(đơn hàng): ô tìm kiếm, danh sách đơn hàng là bản có các cột: trạng thái, mã đơn hàng, tên khách hàng, địa chỉ, tổng tiền, ngày đặt hàng, ngày hoàn thành, 4 nút : , chi tiết ,xóa ,hoàn thành
             page nhỏ( làm popup nếu có thể): chi tiết đơn hàng: mã đơn hàng, tên khách hàng, địa chỉ, bản sản phẩm có( danh sách sản phẩm ,số lượng, đơn giá) , phí vận chuyển, giảm giá, tổng cộng, ngày đặt, ngày hoàn thành, trạng thái, nút sửa
          page 3(đánh giá khách hành): tên khách hàng, ô hình ảnh, ô hiện đánh giá, ô hiện vote, nút liên hệ khách hàng
          page 4(khuyến mại): nút thêm, form hiện mã giảm ,hiện số tiền giảm, hiện phần trăm giảm
          -->
            </div>
          </div>
        </div>
        </main>
      </div>
    </div> 
  </body>
</html>