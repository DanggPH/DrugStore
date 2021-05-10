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
if(isset($_GET['id'])) $id=$_GET['id'];
else header('Location:index.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to dash  </title>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"
    integrity="sha256-c9vxcXyAG4paArQG3xk6DjyW/9aHxai2ef9RpMWO44A=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
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
                <a href="../dashboard/" class="list-group-item list-group-item-action " aria-current="true">
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
          <div class="container">
            <div id="orderpage" class="container">
            <div class="text-primary text-center top-space" style="width: 100%;">
              <p class="fs-1">Hóa đơn khách hàng</p>
            </div>
<?php
$sql='select IDcus,ID,status,created_at from ordertable where ID='.$id;
$tmp=executeSingleResult($sql);
if(empty($tmp)) echo '<script> location.href = "index.php"; </script>';
else {
  $sql2="SELECT a.*, b.fullname, b.phonenumber\n"

  . "FROM address1 a, accountcus b\n"

  . "WHERE a.idCus=b.ID AND b.ID=".$tmp['IDcus'];
;
  $tmp2=executeSingleResult($sql2);
  if(empty($tmp2))  echo '<script> location.href = "index.php"; </script>';
  else {
          echo '<div class=" text-end top-space" >
          <p class="fs-5"><b>Tên khách hàng :</b>'.$tmp2['fullname'].' </p>
        </div>
        <div class=" text-end" >
          <p class="fs-5"><b>Số điện thoại :</b>'.$tmp2['phonenumber'].' </p>
        </div>
        <div class=" text-end" >
        <p class="fs-5"><b>Địa chỉ :</b><i>'.$tmp2['street1'].', '.$tmp2['district'].', '.$tmp2['province'].'</i></p>';
        if(isset($tmp2['street2']) and $tmp2['street2']!='') echo '<p class="fs-5"><b>Địa chỉ 2 :</b><i>'.$tmp2['street2'].', '.$tmp2['district'].', '.$tmp2['province'].'</i></p>';
        echo '</div>
        <div class=" text-end" >
          <p class="fs-5"><b>Mã đơn hàng :</b>'.$tmp['ID'].' </p>
          <p class="fs-5"><b>thời gian tạo đơn :</b>'.$tmp['created_at'].' </p>
        </div>';

  }
}
?>
            <table class="table top-space">
                <thead>
                    <tr>
                        <th scope="col">Tên sản phẩm </th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="coll">Đáp ứng</th>
                        <th scope="coll">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
 <?php
 $sql = "SELECT b.name, b.price, a.quality, b.amount, ( b.price *a.quality ) total, a.Idodertable, a.idproduct\n"

 . "FROM orderdetail a, product b\n"

 . "WHERE a.Idodertable=\"".$id."\" AND a.idproduct=b.id";
 $list=executeResult($sql);
 $totalall=0;
 $noenough="Không đủ: ";
 if(!empty($list)){
  foreach ($list as $item) {
    echo '  <tr>
    <td>'.$item['name'].'</td>
    <td>'.$item['price'].'</td>
    <td>'.$item['quality'].'</td>
';
    if($item['quality']<=$item['amount'] or $tmp['status']=1){
    echo '<td> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></td>';
      $totalall=$totalall + $item['total'];
    echo '<td>'.$item['total'].'</td>';
    }else {echo '<td><a onclick="deleteitem('.$item['Idodertable'].','.$item['idproduct'].')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></td>';
      $noenough=$noenough.$item['name']." ";
      }
    }
 }
 ?>  
  <script>
                function deleteitem(Idodertable, idproduct){
                    var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
                    if(!option) {
                    return;
                    }
                    console.log(Idodertable, idproduct)
                    //ajax - lenh post
                    $.post('ajax.php',{'method':'deleteitem', 'idodertable' : Idodertable , 'idproduct': idproduct},
                    function(data) {
                    location.reload();
                    });
                }
                function deleteorder(id){
                    var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
                    if(!option) {
                    return;
                    }
                    console.log(id)
                    //ajax - lenh post
                    $.post('ajax.php',{'method':'deleteorder','id' : id},
                    function(data) {
                    location.href='index.php'; 
                    });
                }
  </script>               
                <tr>
                  <td colspan="4" class="table-active"><b>Tổng cộng:</b></td>
                  <td><b><?php echo $totalall;?></b></td>
                </tr>
                </tbody>
            </table>
            </div>
            <div class="d-grid gap-2 d-md-block top-space">
            <?php
            if($tmp['status']==0) echo '<button class="btn btn-primary" type="button" id="confirm">Xác nhận</button>';
            ?>
            <button class="btn btn-primary" type="button" id="saveorder">Lưu hóa đơn</button>
              <button class="btn btn-primary" type="button" onclick="deleteorder(<?=$id?>)">Xóa</button>
            </div>
<script>
$('#saveorder').click(function(){
  domtoimage.toPng(document.getElementById('orderpage'))
        .then(function (blob) {
            var pdf = new jsPDF('l', 'pt', [$('#orderpage').width(), $('#orderpage').height()]);

            pdf.addImage(blob, 'PNG', 0, 0, $('#orderpage').width(), $('#orderpage').height());
            pdf.save("<?=$tmp['ID']?>_<?=$tmp2['fullname']?>.pdf");

            that.options.api.optionsChanged();
        });
  alert("Đã tải xuống hóa đơn");
});
$('#confirm').click(function () {
  if("<?=$noenough?>"=="Không đủ: "){
    $.post('ajax.php',{'method':'setstatus','idodertable' : <?=$id?>},
                    function(data) {
                    location.reload(); 
                    });  
  } 
    else alert("<?=$noenough?>");
});

</script>
          <?php
          
          ?>
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