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
if(isset($_POST['sort'])) $sort=$_POST['sort'];
else $sort='';
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
    .space{
        margin-top: 3px !important;
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
						<li><a class="dropdown-item" href="../profile.php">Th??ng tin c?? nh??n</a></li>
						<li><a class="dropdown-item" href="../login/logout.php">????ng xu???t</a></li>
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
                  ????n h??ng
                </a>
                <a href="../brand/" class="list-group-item list-group-item-action ">
                  Nh??n hi???u
                </a>
                <a href="../product/index.php" class="list-group-item list-group-item-action">
                  S???n Ph???m
                </a>
                <a href="../banner/" class="list-group-item list-group-item-action">
                  Banner qu???ng c??o
                </a>
                <a href="../comment/" class="list-group-item list-group-item-action active" aria-current="true">
                  ????nh gi?? kh??ch h??ng
                </a>
              </div>
            </ul>
          </div>        
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
			<div class="album py-5 bg-light top-space">
				<div class="container">
        <div class="row">
          <div class="col-md-2">
          <form method="POST">
            <input type="hidden"  name="token" value="<?=$token?>">
            <select class="form-select form-select-sm" name="sort" onchange="this.form.submit()">
              <option disabled selected>S???p x???p</option>
              <option <?php if($sort=='created_at') echo 'selected';?> value="created_at">Ng??y gi???</option>
              <option <?php if($sort=='fullname') echo 'selected';?> value="fullname">T??n kh??ch h??ng</option>
              <option <?php if($sort=='nameproduct') echo 'selected';?> value="nameproduct">T??n s???n ph???m</option>
              <option <?php if($sort=='voted') echo 'selected';?> value="voted">Vote</option>
            </select>
          </form>
          </div>
          <div class="col">
            <form method="POST">
              <div class="row justify-content-end">
                  <div class="col-4">
                  <input type="hidden"  name="token" value="<?=$token?>">
                  <input name="search" type="text" class="form-control" id="search" placeholder="Nh???p t??? kh??a t??m ki???m">
                  </div>
              </div>
            </form>
          </div>
        </div>
        <div class="d-flex flex-column bd-highlight mb-3 top-space">
<?php
$limit=10;
$page=1;
$sqlCount="select count(id) count from comment";
$count=executeSingleResult($sqlCount)['count'];
$countPage=ceil($count/$limit);
if(isset($_GET['page'])) 
{$page=$_GET['page'];
}
$firtIndex=($page-1)*$limit;
if($sort!='') $sort='ORDER BY '.$sort.' DESC ';
if(isset($_GET['search'])) {
  $key=addslashes(strip_tags($_GET['search']));
  // C??u truy v???n c?? t??m ki???m
  $sql='SELECT a.*, c.name nameproduct FROM comment a, product c WHERE  a.idproduct=c.id AND (a.summary LIKE "%'.$key.'%" OR a.content LIKE "%'.$key.'%" OR voted LIKE "%'.$key.'%" OR nameproduct LIKE "%'.$key.'%") '.$sort.' limit '.$firtIndex.','.$limit;
}
// c??u truy v???n khi kh??ng c?? t??m ki???m
else { $sql='SELECT a.* , c.name nameproduct FROM comment a, product c WHERE a.idproduct=c.id '.$sort.' limit '.$firtIndex.','.$limit; $key='';}
$list=executeResult($sql);
foreach ($list as $item) {
  echo '<tr>
          <div class="p-2 bd-highlight bg-light bg-gradient border border-info space">
          <div class="container-fluid">
            <div class="d-flex flex-column">
              <div class="d-flex align-items-start"><a href="" data-bs-toggle="modal" data-bs-target="#CusModal"><b>'.$item['fullname'].'</b> </a> &nbsp; ???? ????nh gi?? v??? s???n ph???m t??n &nbsp; <a href="../product/index.php?idproduct='.$item['idproduct'].'"><b>'.$item['nameproduct'].'</b></a></div>
              <!-- Modal -->
                <div class="modal fade" id="CusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Th??ng tin kh??ch h??ng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="d-flex flex-column">
                          <td class="align-middle"><div class="d-flex justify-content-center top-space"><b>H??? t??n:</b>&nbsp;<i>'.$item['fullname'].'</i></div></td>
                          <td class="align-middle"><div class="d-flex justify-content-center"><b>Email:</b>&nbsp;<i>'.$item['email'].'</i></div></td>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-stretch"><b>T??m t???t:&nbsp; </b>'.$item['summary'].'</div>
              <div class="d-flex align-items-stretch"><b>N???i dung ????nh gi??:&nbsp; </b>'.$item['content'].'</div>
              <div class="d-flex align-items-stretch">
                <div class="ms-auto p-2 bd-highlight"><b>Vote: &nbsp;</b>'.$item['voted'].'</div>
              </div>
            </div>
          </div>
        </div>

  </tr>';
}


?>
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
                  <a class="page-link" aria-disabled="false" href="<?php echo "?search=".$key."&page=".($page+1);?>" >Next</a>
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