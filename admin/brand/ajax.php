<?php
require_once ('../db/dbhelper.php');
if (!empty($_POST)) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = 'delete from product where brandid ='.$id;
        execute($sql);
        $sql = 'delete from brands where id ='.$id;
        execute($sql);
	}
}
?>