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
if(isset($_POST['token']))
{
    if($_POST['token']!= $_SESSION['token']) header('Location: index.php');
}
$token=rand(1,10);
$_SESSION['token']=$token;
}else header('Location: ../login/login.php');
if(isset($_GET['sort'])) $sort=$_GET['sort']; else $sort='';
$limit=10;
$page=1;
if(isset($_GET['page'])) 
{$page=$_GET['page'];
}
$key='';
// if($_SERVER['REQUEST_URI']=='/admin/order/' or $_SERVER['REQUEST_URI']=='/admin/order/index.php') $url= $_SERVER['REQUEST_URI'].'?';
// else $url= $_SERVER['REQUEST_URI'];
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
          <a class="navbar-brand" href="../brand/">
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
                <a href="../dashboard/" class="list-group-item list-group-item-action " >
                  Dashboard
                </a>
                <a href="../order/" class="list-group-item list-group-item-action active" aria-current="true">
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
            <div class="row">
            <form method="GET"> 
              <div class="col-md-2">
              
                <!-- <input type="hidden"  name="token" value="<?=$token?>"> -->
                <select class="form-select form-select-sm" name="sort" onchange="this.form.submit()">
                  <option disabled selected>Sắp xếp</option>
                  <option <?php if($sort=='id') echo 'selected';?> value="id">Mã đơn hàng</option>
                  <option <?php if($sort=='created_at') echo 'selected';?> value="created_at">Đơn gần nhất</option>
                  <option <?php if($sort=='fullname') echo 'selected';?> value="fullname">Tên khách hàng</option>
                  <option <?php if($sort=='status') echo 'selected';?> value="status">Trạng thái</option>
                </select>
              </div>
              <div class="col">
                  <div class="row justify-content-end">
                      <div class="col-4">
                      <!-- <input type="hidden"  name="token" value="<?=$token?>"> -->
                      <input name="search" type="text" class="form-control" id="search" placeholder="Nhập từ khóa tìm kiếm">
                      </div>
                  </div>
              </div>
            </form>
          </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID </th>
                        <th scope="col">Tên khách hàng</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col"> Trạng thái</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
<?php
$limit=10;
$page=1;
$sqlCount="select count(id) count from ordertable";
$count=executeSingleResult($sqlCount)['count'];
$countPage=ceil(($count/$limit));
if(isset($_GET['page'])) 
{$page=$_GET['page'];
}
$firtIndex=($page-1)*$limit;
if($sort!='') 
  {
    if($sort=="created_at") $sort1=' ORDER BY '.$sort.' DESC ';
    else $sort1=' ORDER BY '.$sort.' ASC ';
  }else $sort1=' ORDER BY created_at DESC ';
if(isset($_GET['search'])) {$key=addslashes(strip_tags($_GET['search']));
  $sql='SELECT a.id, b.fullname, b.phonenumber, a.status, a.created_at
  FROM ordertable a, accountcus b
  WHERE a.IDcus=b.ID AND ( a.id LIKE "%'.$key.'%" OR b.fullname LIKE "%'.$key.'%" OR  b.phonenumber LIKE "%'.$key.'%") '.$sort1.' limit '.$firtIndex.','.$limit;'';
}
// Đơn chưa confirm liên kết từ dashboard
elseif(isset($_GET['searchz'])) {$key=addslashes(strip_tags($_GET['searchz']));
  if($key=='unconfirm')
  $sql='SELECT a.id, b.fullname, b.phonenumber, a.status, a.created_at
  FROM ordertable a, accountcus b
  WHERE a.IDcus=b.ID AND a.status=0 '.$sort1.' limit '.$firtIndex.','.$limit;'';
}
else {$sql="SELECT a.id, b.fullname, b.phonenumber, a.status, a.created_at
FROM ordertable a, accountcus b
WHERE a.IDcus=b.ID ".$sort1." limit ".$firtIndex.",".$limit;
$key='';
}

$listorder= executeResult($sql);
foreach ($listorder as $item) {
    $xn='Chưa xác nhận';
    if($item['status']==1) $xn='Đã xác nhận';
    echo '<tr>
            <th scope="row">'.$item['id'].'</th>
                        <td>'.$item['fullname'].'</td>
                        <td>'.$item['phonenumber'].'</td>
                        <td>'.$xn.'</td>
                        <td>
                            <a href="edit_add.php?id='.$item['id'].'" class="btn btn-primary align-middle btn-sm">Chi tiết</a>
                            <a class="btn btn-primary align-middle btn-sm" onclick="deleteoder('.$item['id'].')">Xóa</a>
                        </td>
                    </tr>';
}
?>

                        
                </tbody>
            </table>
            <script>
                function deleteoder(id){
                    var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
                    if(!option) {
                    return;
                    }
                    console.log(id)
                    //ajax - lenh post
                    $.post('ajax.php',{'method':'deleteorder','id' : id},
                    function(data) {
                    location.reload()
                    });
                }
             </script>
             <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center top-space">
                <li class="page-item <?php
                  if($page<=1) {echo 'disabled';}
                  ?>">
                  <a class="page-link" <?php echo "href='?sort=".$sort."&search=".$key."&page=".($page-1)."'";?> tabindex="-1" aria-disabled="false">Previous</a>
                </li>
                <?php
                  $avaiablePage= [1,$page-1,$page,$page+1,$countPage];
                  $isFirst=$isLast =false;
                   for($i=1;$i<=$countPage;$i++){
                    if(!in_array($i,$avaiablePage)){
                      if(!$isFirst &&  $page >3){
                        echo '<li class="page-item"><a class="page-link" href="?sort='.$sort.'&search='.$key.'&page='.($page-3).'">...</a></li>';
                        $isFirst=true;
                      }
                      if(!$isLast and  $i>$page){
                        echo '<li class="page-item"><a class="page-link" href="?sort='.$sort.'&search='.$key.'&page='.($page+3).'">...</a></li>';
                        $isLast=true;
                      }
                      
                      continue;
                    }
                    if($i==$page)
                    echo '<li class="page-item active"><a class="page-link"  href="index.php?sort='.$sort.'&search='.$key.'&page='.$i.'">'.$i.'</a></li>';
                    else echo '<li class="page-item"><a class="page-link"  href="index.php?sort='.$sort.'&search='.$key.'&page='.$i.'">'.$i.'</a></li>';
                  }
                ?>
                <li class="page-item <?php
                  if($page>=$countPage) {echo 'disabled';}
                  ?>">
                  <a class="page-link" aria-disabled="false" href="<?php echo "?sort=".$sort."&search=".$key."&page=".($page+1);?>" >Next</a>
                </li>
              </ul>
            </nav>    
            </div>
          </div>
        </div>
        </main>
      </div>
    </div> 
  </body>
</html>