<?php
require_once('../Database/dbhelper.php');
session_start();
if(isset($_POST))
{
    if(isset($_POST['idproduct'])){
        $idproduct=$_POST['idproduct'];
        $sql='select * from product where id='.$idproduct;
        if(numrows($sql)>0 and numrows($sql) !=null)
        {
            $alert='';
            if(isset($_POST['summary']) and $_POST['summary']!='')
            {
                $summary=addslashes(strip_tags($_POST['summary']));
            }else $alert=$alert.'<br>Nhập tóm tắt';
            if(isset($_POST['email']) and $_POST['email']!='')
            {
                $email=addslashes(strip_tags($_POST['email']));
                $regex = '/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i'; 
                if(!preg_match($regex, $email)) $alert=$alert.'<br>Nhập lại email';
            } else $alert=$alert.'<br>Nhập email';
            if(isset($_POST['fullname']) and $_POST['fullname']!='') 
            $fullname=addslashes(strip_tags($_POST['fullname']));
            else $alert=$alert.'<br>Nhập họ tên';
            if(isset($_POST['content']) and $_POST['content']!='') 
            $content=addslashes(strip_tags($_POST['content']));
            if(isset($_POST['idCus']) and $_POST['idCus']!='') $idCus=addslashes(strip_tags($_POST['idCus'])); else $idCus="null";
            if(isset($_POST['quality']) and $_POST['quality']!='') $quality=$_POST['quality']; else $quality=5;
            if(isset($_POST['price']) and $_POST['price']!='') $price=$_POST['price']; else $price=5;
            if(isset($_POST['value']) and $_POST['value']!='') $value=$_POST['value']; else $value=5;
            $voted=($quality+$price+$value)/3;
            if($alert==''){
                $created_at = date('Y-m-d H:s:i');
                $sql = "INSERT INTO comment(idproduct, email, fullname, IDaccount, summary, content, voted, create_at) VALUES( ".$idproduct.", '".$email."', N'".$fullname."',".$idCus.", N'".$summary."', N'".$content."', ".$voted.",'".$created_at."')";
                execute($sql);
                header('Location: ../details.php?id='.$idproduct);
                $_SESSION['notify']=$sql;
            }else {
                header('Location: ../details.php?id='.$idproduct);
                $_SESSION['notify']=$alert;
            }
        }else header('Location:../index.php');
    } else header('Location:../index.php');
}else header('Location:../index.php');
?>