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
$id=$name=$price=$amount=$des_procduct=$brandid='';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="select * from product where id=".$id;
    if(numrows($sql)!=0){
        $product=executeSingleResult($sql);
        if(isset($product['image'])) $imgSrc=$product['image'];
        if(isset($product['name'])) $name=$product['name'];
        if(isset($product['price'])) $price=$product['price'];
        if(isset($product['des_product'])) $des_procduct=$product['des_product'];
        if(isset($product['amount'])) $amount=$product['amount'];
        if(isset($product['brandid'])) $brandid=$product['brandid'];
    }else $id='';
}else $imgSrc='unknown_01.jpg';

// include('processing.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to dash  </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
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
      main {
        background-color: lightblue;
        }
    .top-space{
        margin-top: 5% !important;
    }
    head{
        background-color: lightblue;
    }
    </style>
  </head>
  <body>
    <head>
      <nav class="navbar navbar-dark bg-dark">
        <!-- <div class="container-fluid"> -->
          <a class="navbar-brand" href="../dashboard/">
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
                <a href="../dashboard/" class="list-group-item list-group-item-action ">
                  Dashboard
                </a>
                <a href="../order/" class="list-group-item list-group-item-action ">
                  Đơn hàng
                </a>
                <a href="../brand/" class="list-group-item list-group-item-action ">
                  Nhãn hiệu
                </a>
                <a href="../product/index.php" class="list-group-item list-group-item-action active ">
                  Sản Phẩm
                </a>
                <a href="../banner/" class="list-group-item list-group-item-action">
                  Banner quảng cáo
                </a>
                <a href="../comment/" class="list-group-item list-group-item-action ">
                  Đánh giá của khách hàng
                </a>
              </div>
            </ul>
          </div>        
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="text-center fs-1">
            <?php
             if(isset($_GET['id'])){
                 echo 'Chỉnh sửa thông tin sản phẩm';
             }else echo 'Thêm sản phẩm';
            ?>
        </div>
            <div class="container top-space"> 
            <?php
              if(isset($_SESSION['notify'])){
               echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                    echo $_SESSION['notify'];
                    unset($_SESSION['notify']);
                echo '</div>';
              }
            ?>
                <form method="POST"  action= "processing.php" enctype="multipart/form-data">
                  <div class="row align-items-start row-cols-1 row-cols-sm-2">
                      <div class="col col-lg-4">
                          <div class="card shadow-sm" style="width: 15rem;">
                              <img id="output" src="../images/<?=$imgSrc?>" class="card-img-top">
    <script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
                              <input type="file" name="image" accept="image/*" onchange="loadFile(event)"/>
                          </div>
                      </div>
                      <div class="col">
                          <div class="mb-3">
                              <label for="Name" class="form-label">Tên sản phẩm</label>
                              <input type="text" class="form-control" id="name" name="name" value="<?=$name?>">
                          </div>
                          <div class="mb-3">
                            <label for="Brands" class="form-label" selection>Tên nhãn hàng</label>
                            <select id="brands" name="brands" >
                            <?php
                            $sql='select id, name from brands';
                            $listBrand=executeResult($sql);
                            foreach ($listBrand as $item) {
                               if($item['id']==$brandid) echo '<tr><option value="'.$item['id'].'" selected>'.$item['name'].'</option></tr>';
                               else echo '<tr><option value="'.$item['id'].'">'.$item['name'].'</option></tr>';
                            }
                            ?>
                             
                            </select>
                          </div>
                          <div class="mb-3">
                              <label for="Price" class="form-label">Giá bán</label>
                              <input type="number" class="form-control" id="price" name="price" value="<?=$price?>">
                          </div>
                          <div class="mb-3">
                              <label for="amout" class="form-label">Số lượng</label>
                              <input type="number" class="form-control" id="amount" name="amount" value="<?=$amount?>">
                          </div>   
                          <div class="mb-3" id="des">
                              <label for="des_product" class="form-label">Mô tả</label>
                              <textarea class="form-control" id="des_product1" name="des_product1" rows="10" value=<?=$des_procduct?>></textarea>
                          </div>
                          <input type="hidden" class="form-control" id="id" name="id" value="<?=$id?>">
                          <input type="hidden" class="form-control" id="des_product" name="des_product">
                          <input type="hidden" class="form-control" id="img" name="img" value="<?=$imgSrc?>">
                          <button type="submit" class="btn btn-primary" name="save">Lưu</button>
                          <a class="btn btn-primary" onclick="getvalue()">hhh</a>
                          <a href="index.php" class="btn btn-primary" >Hủy</a>
                        </div>
                      </div> 
                    </div>  
                  </div>
                 </form>
            </div>
<script>
    ClassicEditor
        .create( document.querySelector( '#des_product1' ) )
        .catch( error => {
            console.error( error );
        } );
    function getvalue(){
      document.getElementById('des_product').value=document.getElementById('des').children[2].children[2].children[0].innerHTML;
    }
</script>
        </main>
      </div>
    </div> 
  </body>
</html>