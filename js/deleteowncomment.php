<?php
require_once ('../admin/db/dbhelper.php');
// session_start();
if (!empty($_POST)) {
    if (isset($_POST['id']) and isset($_POST['userid'])) {
        $id = $_POST['id'];
        $idusername = $_POST['userid'];
        $sql = 'delete from comment where ID ='.$id.' and IDaccount='.$idusername;
        execute($sql);
        // $_SESSION['test']=$sql;
	}
}
?>