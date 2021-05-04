<?php
require_once('Database/dbhelper.php');
session_start();
if(isset($_POST)) {	
    $password = $confirmation_pwd ='';
    $email = $fullname = $address1 = $address2 = $district = $phone = $city = $usr= $sex= '';
    $alert='';
    if(isset($_POST['fullname']) and $_POST['fullname']!='') {
        $fullname =addslashes(strip_tags($_POST['fullname']));
    } else $alert=$alert.'<br> Nhập họ tên';
    if(isset($_POST['usr']) and $_POST['usr']!='') {
        $usr = addslashes(strip_tags($_POST['usr']));
    } else $alert=$alert.'<br> Nhập username';
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
    if(isset($_POST['password'])and $_POST['password']!='') {
        $password = addslashes(strip_tags($_POST['password']));
        if(isset($_POST['confirmation_pwd']) and $_POST['confirmation_pwd']!='') {
            $confirmation_pwd = addslashes(strip_tags($_POST['confirmation_pwd']));
            if($password!=$confirmation_pwd) $alert=$alert.'<br>Mật khẩu nhập lại sai';
        } else $alert=$alert.'<br>Nhập lại mật khẩu';
    } else $alert=$alert.'<br>Nhập mật khẩu';
    if(isset($_POST['address1']) and $_POST['address1']!='') {
        $address1 = addslashes(strip_tags($_POST['address1']));
    } else $alert=$alert.'<br>Nhập địa chỉ 1';
    if(isset($_POST['address2']) and $_POST['address2']!='') {
        $address2 = addslashes(strip_tags($_POST['address2']));
    }
    if(isset($_POST['calc_shipping_district']) and $_POST['calc_shipping_district']!='') {
        $district = addslashes(strip_tags($_POST['calc_shipping_district']));
    } else $alert=$alert.'<br>chọn quận/huyện';
    if(isset($_POST['calc_shipping_provinces']) and $_POST['calc_shipping_provinces']!='') {
        $city = addslashes(strip_tags($_POST['calc_shipping_provinces']));
    } else $alert=$alert.'<br>Chọn tỉnh/thành phố';
    if($alert=='')
    {
        $created_at =$updated_at =date('Y-m-d H:s:i');
        $sql = "INSERT INTO accountcus (usernameCus, password, email, fullname, sex, phonenumber, created_at, updated_at) VALUES ('".$usr."','".md5(md5(md5($password)))."','".$email."', N'".$fullname."', '".$sex."', '".$phone."', '".$created_at."', '".$updated_at."')";
        execute($sql);
        // $_SESSION['notify']=$sql; 
        $sqlfindID='select * from accountcus where usernameCus="'.$usr.'" and email="'.$email.'"';
        $user=executeSingleResult($sqlfindID);
        $sql="INSERT INTO address1 (IDcus, province, district, street1, street2) VALUES ('".$user['ID']."', N'".$city."', N'".$district."', N'".$address1."', N'".$address2."')";
        execute($sql);
        $_SESSION['userinfor']=$user;
        $_SESSION['notify']=$sql;   
    } else{
        $temp=['email'=>$email, 'fullname'=>$fullname , 'address1'=>$address1 , 'address2'=>$address2 , 'phone'=>$phone , 'usr'=>$usr, 'sex'=>$sex];
        $_SESSION['temp']=$temp;
        $_SESSION['notify']=$alert;
    }
}
header('Location:register.php');
?>