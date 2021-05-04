<?php
require_once('db/dbhelper.php');
session_start();
if(isset($_SESSION['username']) and isset($_SESSION['password'])){
    $username1=$_SESSION['username'];
    $password1=$_SESSION['password'];
    $sql = "select * from accountad where username = '$username1' and password = '$password1'";
    $num_rows=numrows($sql);
    if(numrows($sql)==0){
        session_unset();
        header('Location: login/login.php');
    }
}else header('Location: login/login.php');
if(isset($_POST['save'])){
    $errors='Trạng thái:';
    if(isset($_POST['username'])) {
        $username=addslashes(strip_tags($_POST['username']));
    }else $errors=$errors.'<br> Nhập lại tên đăng nhập';
    if(isset($_POST['pass'])) {
        $password=addslashes(strip_tags($_POST['pass']));
        if(isset($_POST['repass'])) {
            $repassword=addslashes(strip_tags($_POST['repass']));
            if($repassword!=$password) $errors=$errors.'<br> Mật khẩu nhập lại chưa đúng';
        }else $errors=$errors.'<br> Nhập lại mật khẩu';
    }else $errors=$errors.'<br> Nhập mật khẩu';
    if(isset($_POST['email'])) {
        $email=addslashes(strip_tags($_POST['email']));
    }else $errors=$errors.'<br> Nhập email';
    if(isset($_POST['fullname'])) {
        $fullname=addslashes(strip_tags($_POST['fullname']));
    }else $errors=$errors.'<br> Nhập đầy đủ họ tên';
    if(isset($_POST['birthday'])) {$birthday=$_POST['birthday'];}
    if(isset($_POST['sex'])) {$sex=addslashes(strip_tags($_POST['sex']));}
    if($errors=='Trạng thái:')
    {
        $sql="select * from accountad where username = '".$username."'";
        $num_rows=numrows($sql);
        if(numrows($sql)>0 ){
            if($username==$username1) {
            $sql="update accountad set password='".$password."', email='".$email."', fullname=N'".$fullname."', birthday='".$birthday."', sex='".$sex."' where username='".$username."'";
            $_SESSION['username']=$username;
            $_SESSION['password']=$password;
            execute($sql);
            $errors=$errors.'<br>Đã lưu';
            } else $errors=$errors.'<br> Tên đăng nhập đã tồn tại';
        }else {
            $sql='select * from accountad where username = "'.$username1.'" and level=0';
            $num_rows=numrows($sql);
            if(numrows($sql)>0){
                $sql="insert into accountad (username, password, email, fullname, birthday, sex) values ('".$username."','".$password."','".$email."',N'".$fullname."','".$birthday."','".$sex."')";
                execute($sql);
                $errors=$errors.'<br>Đã lưu';
            }    
        }
        $_SESSION['notify']=$errors;
    }else $_SESSION['notify']=$errors;
    header("Location:profile.php");
}
?>