<?php
session_start();
require_once('dbhelper.php');
if(isset($_POST['cart']))
{
    $cart = addslashes(strip_tags($_POST['cart']));
    $sql="update accountcus set cart=N'".$cart."' where ID=".$_SESSION['userinfor']['ID'];
    execute($sql);
    // $_SESSION['sql']=$sql;
}
session_destroy();
header('Location: ../index.php');
?>