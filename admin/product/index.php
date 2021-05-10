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
if(isset($_POST['token']) and $_POST['token']!=$_SESSION['token']) header('Location: index.php');
$token=rand(1,10);
$_SESSION['token']=$token;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to dash  </title>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
	  main {
        background-color: lightblue;
        }
    .top-space{
        margin-top: 5% !important;
    }
    .card-text{
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 20px;
        -webkit-line-clamp: 3;
        display: -webkit-box;
        -webkit-box-orient: vertical;
    }
    </style>
  </head>
  <body>
    <head>
    	<nav class="navbar navbar-dark bg-dark fixed-top">
			<div class="container-fluid d-flex flex-row">
				<a class="navbar-brand" href="index.php">
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
			</div> 
    	</nav>
    </head>
    <div class="container-fluid">
      <div class="row top-space">
        <nav id="sideBar" class="col-md-3 col-lg-2 bg-light sidebar d-md-block collapse show">
          <div class="position-sticky pt-3">
            <ul class="nav flex-column">
              <div class="list-group">
                <a href="../dashboard/" class="list-group-item list-group-item-action" >
                  Dashboard
                </a>
                <a href="../order/" class="list-group-item list-group-item-action ">
                  Đơn hàng
                </a>
                <a href="../brand/" class="list-group-item list-group-item-action ">
                  Nhãn hiệu
                </a>
                <a href="../product/index.php" class="list-group-item list-group-item-action active" aria-current="true">
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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
			<ul class=" d-md-flex justify-content-md-end top-space">
				<a href="edit_add.php" class="btn btn-primary align-middle">Thêm</a>
			</ul>
			<div class="album py-5 bg-light">
				<div class="container">
        <form method="GET">
                    <div class="row justify-content-end">
                        <div class="col-4">
                        <!-- <input type="hidden"  name="token" value="<?=$token?>"> -->
                        <input name="search" type="text" class="form-control" id="search" placeholder="Nhập từ khóa tìm kiếm">
                        </div>
                        
                    </div>
        </form>
					<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 top-space">
<?php
$limit=9;
$page=1;
$sqlCount="select count(id) count from product";
$count=executeSingleResult($sqlCount)['count'];
$countPage=ceil(($count/$limit));
if(isset($_GET['page'])) 
{$page=$_GET['page'];
}
$firtIndex=($page-1)*$limit;
if(isset($_GET['idproduct'])) 
{$key=$_GET['idproduct'];
  $sql="select * from product where id=".$key." limit ".$firtIndex.",".$limit;
}elseif(isset($_GET['search'])) {
  $key=addslashes(strip_tags($_GET['search']));
  // Câu truy vấn có tìm kiếm
  $sql='select a.*, b.name namebrand from product a, brands b  where a.brandid=b.id and (a.name LIKE "%'.$key.'%" or b.name LIKE "%'.$key.'%" or a.id LIKE "%'.$key.'%" or des_product  LIKE "%'.$key.'%" or amount LIKE "%'.$key.'%"  or price LIKE "%'.$key.'%" or price_old LIKE "%'.$key.'%")  limit '.$firtIndex.','.$limit;
}
// câu truy vấn khi không có tìm kiếm
else {$sql="select * from product where 1 limit ".$firtIndex.",".$limit; $key='';}
$productList= executeResult($sql);
foreach($productList as $item){
  if (!isset($item['image']) or $item['image']=='') $item['image']='../images/logo.png';
  $sqlcheckvote='SELECT avg(voted) voted FROM comment WHERE idproduct='.$item['id'];
  $row=executeSingleResult($sqlcheckvote);
  if(!empty($row) and $row['voted']!=null) $voted=$row['voted']; else $voted=5.0;
  echo '<tr>
					<td>  <div class="col"> </td>
						<td>	<div class="card shadow-sm" style="width: 18rem; height:25rem;"> </td>
						<td>	<img src="../images/'.$item['image'].'" style="width: 18rem; height:45%;" class="card-img-top" alt="..."> </td>
							<td>	<div class="card-body"> </td>
              <td>	<p class="card-text fw-bold">'.$item['name'].'</p> </td>
								<td>	<p class="card-text "><b>Mô tả: </b>'.addslashes(strip_tags($item['des_product'])).'</p> </td>
								<td><div class="row align-items-end"></td>
                <div class="d-flex justify-content-between align-items-center">
                <td>	<small class="text-muted"><b>Giá:</b>'.$item['price'].' </small> </td>
                <div class="d-flex justify-content-end align-items-center"> </td>
                  Số lượng: '.$item['amount'].'</div>
                </div>
								<td>	<div class="d-flex justify-content-between align-items-center"> </td>
                <td> <div> </td>
                  <td>  <a href="edit_add.php?id='.$item['id'].'"><button class="btn btn-sm btn-outline-secondary">Sửa</button></a> </td>
                  <td>  <button class="btn btn-sm btn-outline-secondary" onclick="deleteProduct('.$item['id'].')">Xóa</button> </td>
                <td> </div> </td>		
                <td> <div class="d-flex justify-content-end align-items-center"> </td>
                <div>Vote:'.round($voted).'</div>
                <td></div>		</td?	
								<td>	</div> </td> 	 
                <td></div><td> 
							<td>	</div> </td>
						<td>	</div> </td>
					<td>	</div> </td>';
}
?>
<script type="text/javascript">
  function deleteProduct(id) {
    var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
    if(!option) {
      return;
    }
    console.log(id)
    //ajax - lenh post
    $.post('ajax.php',{'id' : id},
     function(data) {
      location.reload()
    });
  }
</script> 
            </div>
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center top-space">
              <li class="page-item <?php
                  if($page<=1) {echo 'disabled';}
                  ?>">
                  <a class="page-link" <?php echo "href='?search=".$key."&page=".($page-1)."'";?> tabindex="-1" aria-disabled="false">Previous</a>
                </li>
                <?php
                  $avaiablePage= [1,$page-1,$page,$page+1,$countPage];
                  $isFirst=$isLast =false;
                   for($i=1;$i<=$countPage;$i++){
                    if(!in_array($i,$avaiablePage)){
                      if(!$isFirst &&  $page >3){
                        echo '<li class="page-item"><a class="page-link" href="?search='.$key.'&page='.($page-3).'">...</a></li>';
                        $isFirst=true;
                      }
                      if(!$isLast and  $i>$page){
                        echo '<li class="page-item"><a class="page-link" href="?search='.$key.'&page='.($page+3).'">...</a></li>';
                        $isLast=true;
                      }
                      
                      continue;
                    }
                    if($i==$page)
                    echo '<li class="page-item active"><a class="page-link"  href="index.php?search='.$key.'&page='.$i.'">'.$i.'</a></li>';
                    else echo '<li class="page-item"><a class="page-link"  href="index.php?search='.$key.'&page='.$i.'">'.$i.'</a></li>';
                  }
                ?>
                <li class="page-item <?php
                  if($page>=$countPage) {echo 'disabled';}
                  ?>">
                  <a class="page-link" aria-disabled="false" href="<?php echo "?search='.$key.'&page=".($page+1);?>" >Next</a>
                </li>
              </ul>
            </nav>    
				  </div>
			  </div>
        </main>
      </div>
    </div> 
  </body>
</html>