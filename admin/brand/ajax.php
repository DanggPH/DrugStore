<?php
require_once ('../db/dbhelper.php');
if (!empty($_POST)) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $img=executeSingleResult('select * from brands where id ='.$id)['logolink'];
        $imgSrc='../images/'.$img;
        $sql = 'delete from product where brandid ='.$id;
        execute($sql);
        $sql = 'delete from brands where id ='.$id;
        execute($sql);
        if (file_exists($imgSrc)) unlink($imgSrc);
	}
}
?>