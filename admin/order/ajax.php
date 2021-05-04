<?php
require_once ('../db/dbhelper.php');
if (!empty($_POST)) {
    if ($_POST['method']=='deleteorder') {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $sql = 'delete from ordertable where ID ='.$id;
            $sql1='delete from orderdetail where Idodertable ='.$id;
            execute($sql1);
            execute($sql);
        }

    }
            
    if ($_POST['method']=='deleteitem') {
        if (isset($_POST['idproduct']) and isset($_POST['idodertable'])) {
            $idproduct = $_POST['idproduct'];
            $idodertable = $_POST['idodertable'];
            $sql = 'delete from orderdetail where Idodertable ='.$idodertable.' and idproduct='.$idproduct;
            execute($sql);
        } 
    } 
    if ($_POST['method']=='setstatus') {
        if (isset($_POST['idodertable'])) {
            $idodertable = $_POST['idodertable'];
            $sql = 'update ordertable set status=1 where id='.$idodertable;
            execute($sql);
            $sql = 'select idproduct, quality from orderdetail where Idodertable='.$idodertable;
            $list=executeResult($sql);
            foreach ($list as $item ) {
                $sql='update product set amount= amount-'.$item['quality'].' where id='.$item['idproduct'];
                execute($sql);
            }
        } 
    }
}
?>