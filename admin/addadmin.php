<?php
require_once('db/dbhelper.php');
session_start();
if(isset($_SESSION['username']) and isset($_SESSION['password'])){
    $username=$_SESSION['username'];
    $password=$_SESSION['password'];
    $sql = "select * from accountad where username = '$username' and password = '$password' and level=100";
    $num_rows=numrows($sql);
    if(numrows($sql)==0){
        session_unset();
        header('Location: login/login.php');
    }

}else header('Location: login/login.php');
if(isset($_POST['token']) and $_POST['token']!=$_SESSION['token']) header('Location: addadmin.php');
$token=rand(1,10);
$_SESSION['token']=$token;
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
          <a class="navbar-brand" href="dashboard/">
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
                <a href="dashboard/" class="list-group-item list-group-item-action">
                  Dashboard
                </a>
                <a href="order/" class="list-group-item list-group-item-action ">
                  Đơn hàng
                </a>
                <a href="brand/" class="list-group-item list-group-item-action ">
                  Nhãn hiệu
                </a>
                <a href="product/" class="list-group-item list-group-item-action ">
                  Sản Phẩm
                </a>
                <a href="../banner/" class="list-group-item list-group-item-action">
                  Banner quảng cáo
                </a>
                <a href="comment/" class="list-group-item list-group-item-action ">
                  Đánh giá khách hàng
                </a>
              </div>
            </ul>
          </div>        
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 top-space">
        <div class="album py-5 bg-light">
          <div class="container ">
            <h1 class="text-center">Thông tin quản trị viên</h1>
            <?php
              if(isset($_SESSION['notify'])){
               echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                    echo $_SESSION['notify'];
                    unset($_SESSION['notify']);
                echo '</div>';
              }
            ?>
            <div class="container container-fluid bg-gradient border border-info">
                <form method="POST" action="processing.php">
                    <div class="mb-3">
                        <label class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" name="username" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật Khẩu</label>
                        <input type="password" class="form-control" id="pass" name="pass" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" id="repass" name="repass" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày sinh</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" value="">
                    </div>
                    <input type="hidden"  name="token" value="<?=$token?>">
                    <div class="mb-3">
                        <label class="form-label">Giới tính</label>
                        <select class="form-select">
                            <option disable selected></option>
                            <option value="1">Nam</option>
                            <option value="2">Nữ</option>
                            <option value="3">Khác</option>
                        </select>
                    </div>
                    <div class="mb-3">
                     <button class="btn btn-outline-primary" type="submit" name="save">Lưu</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
        </main>
      </div>
    </div> 
  </body>
</html>