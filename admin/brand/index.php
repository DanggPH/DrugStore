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
$limit=9;
$page=1;
$sqlCount="select count(id) count from brands";
$count=executeSingleResult($sqlCount)['count'];
$countPage=ceil($count/$limit);
if(isset($_GET['page'])) 
{$page=$_GET['page'];  
}
$firtIndex=($page-1)*$limit;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to dash  </title>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
      <header class="navbar navbar-dark bg-dark fixed-top">
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
                <li><a class="dropdown-item" href="../profile.php">Th??ng tin c?? nh??n</a></li>
                <li><a class="dropdown-item" href="../login/logout.php">????ng xu???t</a></li>
              </ul>
              </ul>
            </div>
          </ul>
        <!-- </div> -->
      </header>
    <div class="container-fluid">
      <div class="row top-space">
        <nav id="sideBar" class="col-md-3 col-lg-2 bg-light sidebar d-md-block collapse show">
          <div class="position-sticky pt-3 ">
            <ul class="nav flex-column">
              <div class="list-group">
                <a href="../dashboard/" class="list-group-item list-group-item-action">
                  Dashboard
                </a>
                <a href="../order/" class="list-group-item list-group-item-action ">
                  ????n h??ng
                </a>
                <a href="../brand/" class="list-group-item list-group-item-action active">
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
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <ul class=" d-md-flex justify-content-md-end top-space">
				<a href="edit_add.php" class="btn btn-primary align-middle">Th??m</a>
			</ul>
        <div class="album py-5 bg-light">
          <div class="container ">
            <form method="GET">
                <div class="row justify-content-end">
                    <div class="col-4">
                    <!-- <input type="hidden"  name="token" value="<?=$token?>"> -->
                    <input name="search" type="text" class="form-control" id="search" placeholder="Nh???p t??? kh??a t??m ki???m">
                    </div>  
                </div>
            </form>
            <div class="row">
<?php
if(isset($_GET['search'])) {
    $key=addslashes(strip_tags($_GET['search']));
    // C??u truy v???n c?? t??m ki???m
    $sql='select * from brands where name like "%'.$key.'%" limit '.$firtIndex.','.$limit;
} 
// c??u truy v???n khi kh??ng c?? t??m ki???m
else { $sql='select * from brands limit '.$firtIndex.','.$limit;  $key='';}
$listbrands=executeResult($sql);
if($listbrands!=null){
    foreach ($listbrands as $item) {
        echo '<tr>
               <div class="col-lg-4 top-space ">
                    <div class="container-fluid bg-light bg-gradient border border-info">
                        <p class="text-center"><img src="../images/'.$item['logolink'].'" class="rounded-circle rounded-1" alt="" style="width:10rem;height:10rem;"></p>
                        <p class="text-center">'.$item['name'].'</p>
                        <p class="text-center">
                            <a href="edit_add.php?id='.$item['id'].'" class="btn btn-primary align-middle">S???a</a>
                            <a class="btn btn-primary align-middle" onclick="deleteBrand('.$item['id'].')">X??a</a>
                        </p>
                    </div>
                </div>
            </tr>';
    }
}
?>
<script type="text/javascript">
  function deleteBrand(id) {
    var option = confirm('B???n c?? ch???c ch???n mu???n xo?? danh m???c n??y kh??ng? ( X??a c??? nh???ng s???n ph???m c???a h??ng)')
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
                  <a class="page-link" aria-disabled="false" href="<?php echo "?search=".$key."&page=".($page+1);?>" >Next</a>
                </li>
              </ul>
            </nav>    
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