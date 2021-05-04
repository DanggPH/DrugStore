<?php
$host ="localhost";
$uname = "admin";
$pwd = '';
$db_name = "pharmadb";
$conn = mysqli_connect($host, $uname, $pwd, $db_name);
mysqli_set_charset($conn, 'UTF8');
?>