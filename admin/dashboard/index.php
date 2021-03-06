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
                <li><a class="dropdown-item" href="../profile.php">Th??ng tin c?? nh??n</a></li>
                <li><a class="dropdown-item" href="../login/logout.php">????ng xu???t</a></li>
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
                  ????n h??ng
                </a>
                <a href="../brand/" class="list-group-item list-group-item-action ">
                  Nh??n hi???u
                </a>
                <a href="../product/index.php" class="list-group-item list-group-item-action ">
                  S???n Ph???m
                </a>
                <a href="../banner/" class="list-group-item list-group-item-action">
                  Banner qu???ng c??o
                </a>
                <a href="../comment/" class="list-group-item list-group-item-action ">
                  ????nh gi?? kh??ch h??ng
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
                      echo '????n h??ng:'.$item['total']. '<a href="../order/index.php?searchz=unconfirm"class="text-danger ">('.$item1['unconfirm'].')</a>';

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
                      S???n ph???m t???n kho: 
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
                      S??? l?????ng ????nh gi??: 
                      <?php
                      $sql="select count(*) total from comment";
                      $item=executeSingleResult($sql);
                      echo $item['total'];
                      ?>
                    </p>
                  </div>
                </div>
              </div>
            <!-- n??i dung trong ?????y 
          m??nh c???n 4 page
          page 1( dashboard): c???n 3 ?? t???ng quan c?? title: t???ng s???n ph???m, t???ng ????n h??ng, h??ng c??n l???i
          page 2(????n h??ng): ?? t??m ki???m, danh s??ch ????n h??ng l?? b???n c?? c??c c???t: tr???ng th??i, m?? ????n h??ng, t??n kh??ch h??ng, ?????a ch???, t???ng ti???n, ng??y ?????t h??ng, ng??y ho??n th??nh, 4 n??t : , chi ti???t ,x??a ,ho??n th??nh
             page nh???( l??m popup n???u c?? th???): chi ti???t ????n h??ng: m?? ????n h??ng, t??n kh??ch h??ng, ?????a ch???, b???n s???n ph???m c??( danh s??ch s???n ph???m ,s??? l?????ng, ????n gi??) , ph?? v???n chuy???n, gi???m gi??, t???ng c???ng, ng??y ?????t, ng??y ho??n th??nh, tr???ng th??i, n??t s???a
          page 3(????nh gi?? kh??ch h??nh): t??n kh??ch h??ng, ?? h??nh ???nh, ?? hi???n ????nh gi??, ?? hi???n vote, n??t li??n h??? kh??ch h??ng
          page 4(khuy???n m???i): n??t th??m, form hi???n m?? gi???m ,hi???n s??? ti???n gi???m, hi???n ph???n tr??m gi???m
          -->
            </div>
          </div>
        </div>
        </main>
      </div>
    </div> 
  </body>
</html>