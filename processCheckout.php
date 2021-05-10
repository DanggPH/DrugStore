<?php
session_start();
require_once('Database/dbhelper.php');
if(isset($_SESSION['userinfor'])) {
	$username = $_SESSION['userinfor'];
}else header('Location: login.php');
$sql='select * from address1 where idCus='.$username['ID'];
$add=executeSingleResult($sql);
if(isset($_SESSION['cart'])) {
    $cartdump=$_SESSION["cart"];
    $cart=json_decode($cartdump,true);
     for ($i=0; $i < count($cart); $i++) { 
            if(numrows("select * from product where name='".$cart[$i]['name']."'")!=0) {}else unset($cart[$i]);
         }
} else header('Location:index.php');
if(isset($_POST)){
    $email = $fullname = $address1 = $address2 = $district = $phone = $city = $sex= '';
    $alert='';
    if(isset($_POST['idCus']) and $_POST['idCus']!='') {
        $idCus =addslashes(strip_tags($_POST['idCus']));
    }
    if(isset($_POST['fullname']) and $_POST['fullname']!='') {
        $fullname =addslashes(strip_tags($_POST['fullname']));
    } else $alert=$alert.'<br> Nhập họ tên';
    if(isset($_POST['email']) and $_POST['email']!='')
    {
        $email=addslashes(strip_tags($_POST['email']));
        $regex = '/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i'; 
        if(!preg_match($regex, $email)) $alert=$alert.'<br>Nhập lại email';
    } else $alert=$alert.'<br>Nhập email';
    if(isset($_POST['sex']) and $_POST['sex']!='') {
        $sex = addslashes(strip_tags($_POST['sex']));
    }  else $alert=$alert.'<br> Chọn giới tính';
    if(isset($_POST['phone']) and $_POST['phone']!='') {
        $phone = addslashes(strip_tags($_POST['phone']));
        if(!preg_match('/^[0-9]{10}+$/', $phone)) $alert=$alert.'<br>Nhập lại số điện thoại';
    } else $alert=$alert.'<br>Nhập số điện thoại';
    if(isset($_POST['address1']) and $_POST['address1']!='') {
        $address1 = addslashes(strip_tags($_POST['address1']));
    } else $alert=$alert.'<br>Nhập địa chỉ 1';
    if(isset($_POST['address2']) and $_POST['address2']!='') {
        $address2 = addslashes(strip_tags($_POST['address2']));
    }
    if(isset($cart) and $cart!='') {} else $alert=$alert.'<br>Giỏ hàng rỗng';
    if ($alert=='') {
        if($fullname!= $username['fullname']
        or $email!=$username['email']
        or $sex!=$username['sex']
        or  $phone !=$username['phonenumber']
        or $address1!=$add['address1']
        or $address2!=$add['address2'])
        {
            // Update thông tin khách hàng
            $sql="update accountcus set fullname=N'".$fullname."' , email='".$email."', sex='".$sex."', phonenumber='".$phone."' where ID=".$username['ID'];
            execute($sql);
            $_SESSION['userinfor']=executeSingleResult("select * from accountcus where ID='".$username['ID']."'");
            $sql="update address1 set street1=N'".$address1."' , street2=N'".$address2."' where idCus=".$username['ID'];
            execute($sql);
            // $_SESSION['alert']=$sql;
        }
        // Tạo hóa đơn lớn
        $created_at =date('Y-m-d H:s:i');
        
        $sql="INSERT INTO ordertable(idAddress, IDcus, status, created_at) VALUES('".$add['id']."', '".$username['ID']."',' 0', '".$created_at."')";
        // $_SESSION['alert']=$sql;
        execute($sql);
        $created_at1=date('Y-m-d H:s');
        // get id ordertable
        $sql= "select * from ordertable where idAddress=".$add['id']." and IDcus=".$username['ID']." and status=0 and created_at LIKE '".$created_at1."%'";
        $key=executeSingleResult($sql);
        foreach ($cart as $item){
            // $_SESSION['alert']="select * from product where name='".$item['name']."'";
            $idproduct=executeSingleResult("select * from product where name='".$item['name']."'")['id'];
            // $_SESSION['alert']="select * from product where name=".$item['name'];
            execute("insert into orderdetail(Idodertable, idproduct, quality) VALUES (".$key['ID'].", ".$idproduct.", ".$item['quality'].")");
            $_SESSION['alert']=$sql;
        }
        unset($_SESSION['cart']);
        echo "<script>localStorage.removeItem('cart');
        localStorage.removeItem('arrCart');
        location.href='index.php';</script>";

    }else {
        $_SESSION['alert']=$alert;
        header('Location:checkout.php');}
} else header('Location:checkout.php');
?>