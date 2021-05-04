<?php
require_once ('../db/dbhelper.php');
if (!empty($_POST)) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $img=executeSingleResult('select * from banner where id ='.$id)['image'];
        $imgSrc='../images/'.$img;
        $sql = 'delete from banner where id ='.$id;
        execute($sql);
        if (file_exists($imgSrc)) unlink($imgSrc);

	}
}
?>