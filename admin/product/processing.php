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
            $sql="select name from product where name ='$name'";
            if(numrows($sql)>0) {
                $errors=$errors.'<br> Tên sản phẩm đã tồn tại';
            }
        }else $errors=$errors.'<br> Nhập tên sản phẩm';

        if(isset($_POST['price']) and $_POST['price']!=''and is_numeric($_POST['price'])){ $price=addslashes(strip_tags($_POST['price']));
        }else $errors=$errors.'<br> Nhập giá sản phẩm';

        if(isset($_POST['amount']) and $_POST['amount']!='' and is_numeric($_POST['amount'])){ $amount=addslashes(strip_tags($_POST['amount']));
        }else $errors=$errors.'<br> Nhập số lượng sản phẩm';
        if(isset($_POST['brands']) and $_POST['brands']!=''){ $brandid=addslashes(strip_tags($_POST['brands']));
        }else $errors=$errors.'<br> Chọn nhãn hiệu';
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
        if(isset($_POST['des_product'])) $des_product=$_POST['des_product'];
        if($errors=='Trạng thái:'){
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $image = $target;
            $sql="insert into product (brandid, name, price, price_old, amount, image, des_product, created_at, updated_at) values ('".$brandid."',N'".$name."','".$price."','".$price."','".$amount."',N'".basename($image)."',N'".$des_product."','".$created_at."','".$updated_at."')";
            execute($sql);
            $errors=$errors.'<br>Đã lưu';
            $_SESSION['notify']=$errors;
            $sqlback="select * from product where name=N'".$name."'";
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
        }else $errors=$errors.'<br> Nhập tên sản phẩm';

        if(isset($_POST['price']) and $_POST['price']!=''and is_numeric($_POST['price'])){ $price=addslashes(strip_tags($_POST['price']));
        }else $errors=$errors.'<br> Nhập giá sản phẩm';

        if(isset($_POST['amount']) and $_POST['amount']!='' and is_numeric($_POST['amount'])){ $amount=addslashes(strip_tags($_POST['amount']));
        }else $errors=$errors.'<br> Nhập số lượng sản phẩm';
        if(isset($_POST['brands']) and $_POST['brands']!='' and is_numeric($_POST['brands'])){ $brandid=addslashes(strip_tags($_POST['brands']));
        }else $errors=$errors.'<br> Chọn nhãn hiệu';
        if(isset($_POST['des_product'])){ $des_product=$_POST['des_product'];}
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
                if(isset($_POST['img']) and $_POST['img']!='https://wallpapercave.com/wp/wp2537078.jpg')
                    {
                        $imgSrc='../images/'.$_POST['img'];
                        if (file_exists($imgSrc))
                            {
                                unlink($imgSrc);
                            }
                    }
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                $image1=$name.basename($image);
            }
            
        }
        if($errors=='Trạng thái:'){
            $sql="update product set name=N'".$name."',brandid='".$brandid."',price_old=price , price ='".$price."', des_product=N'".$des_product."', image= N'".$image1."', amount='".$amount."', updated_at='".$updated_at."' where id =".$id;
            execute($sql);
            $errors=$errors.'<br>Đã lưu';
            $_SESSION['notify']=$errors;
        }else $_SESSION['notify']=$errors;
        header("Location:edit_add.php?id=".$id);
    }
}
?>