<?php
session_start();
require_once('../db/dbhelper.php');
if(isset($_POST['save'])){
    $target = $des_product=$image='';
    $created_at = $updated_at = date('Y-m-d H:s:i');
    $errors='Trạng thái:';
    // khi thêm mới
    if(!isset($_POST['id']) || $_POST['id']==''){
        if(isset($_POST['name']) and $_POST['name']!='') {
            $name=addslashes(strip_tags($_POST['name']));
            $sql="select name from banner where name ='".$name."'";
            if(numrows($sql)>0) {
                $errors=$errors.'<br> Tên banner đã tồn tại';
            }
        }else $errors=$errors.'<br> Nhập tên banner';
        if(isset($_POST['link']) and $_POST['link']!='') $link=addslashes(strip_tags($_POST['link']));
        else $errors=$errors.'<br> Nhập tên liên kết';
        $image = $_FILES['image']['name'];
        $target = "../images/".$name.basename($image);
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        if($file_name!=''){
            $file_ext=strtolower(pathinfo($target,PATHINFO_EXTENSION));
            $expensions= array("jpeg","jpg","png");
            if(in_array($file_ext,$expensions)=== false){
                $errors=$errors.' <br>Chỉ hỗ trợ upload file JPEG ,JPG ,PNG';        
            }
            elseif($file_size > 2097152) {
                $errors=$errors.'<br>Kích thước file không được lớn hơn 2MB';
            }
        }
        if($errors=='Trạng thái:'){
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $image = $target;
            $sql="insert into banner (name, link, image, created_at, updated_at) values (N'".$name."', N'".$link."', N'".basename($image)."','".$created_at."','".$updated_at."')";
            execute($sql);
            $errors=$errors.'<br>Đã lưu';
            $_SESSION['notify']=$errors;
            $sqlback="select * from banner where name='".$name."'";
            $row=executeSingleResult($sqlback);
            header("Location:edit_add.php?id=".$row['id']);
        }else {
            $_SESSION['notify']=$errors;
            header("Location:edit_add.php");
        }
    }
    // Khi chỉnh sửa
    else{
        if(isset($_POST['id'])) {$id=addslashes(strip_tags($_POST['id']));}
        if(isset($_POST['name'])) {
            $name=addslashes(strip_tags($_POST['name']));
        }else $errors=$errors.'<br> Nhập tên banner';
        if(isset($_POST['link']) and $_POST['link']!='') $link=addslashes(strip_tags($_POST['link']));
        else $errors=$errors.'<br> Nhập tên liên kết';
        if(isset($_POST['img'])) $image1=$_POST['img'];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $image = $_FILES['image']['name'];
        $target = "../images/".$name.basename($image);
        if($file_name!=''){
            $file_ext=strtolower(pathinfo($target,PATHINFO_EXTENSION));
            $expensions= array("jpeg","jpg","png");
            if(in_array($file_ext,$expensions)=== false){
                $errors=$errors.' <br>Chỉ hỗ trợ upload file JPEG ,JPG ,PNG';        
            }
            elseif($file_size > 2097152) {
                $errors=$errors.'<br>Kích thước file không được lớn hơn 2MB';
            }else{
                if(isset($_POST['img']) and $_POST['img']!='unknown_01.png')
                    {
                        $imgSrc='../images/'.$_POST['img'];
                        if (file_exists($imgSrc))
                            {
                                unlink($imgSrc);
                            }
                    }
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            }
            
        }
        if($errors=='Trạng thái:'){
            $sql="update banner set name=N'".$name."', image= N'".$name.basename($image)."', link=N'".$link."', updated_at='".$updated_at."' where id =".$id;
            execute($sql);
            $errors=$errors.'<br>Đã lưu';
            $_SESSION['notify']=$errors;
        }else $_SESSION['notify']=$errors;
        header("Location:edit_add.php?id=".$id);
    }
}
?>