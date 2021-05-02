<?php
    session_start();
    // function myfunction($v)
    // {
    // $v=strtoupper($v);
    //   return $v;
    // }   
    // $list=$_POST['data'];
    // // foreach ($list as $item) {
    // //     echo $list;
    // // }
    // print_r(array_map("myfunction",$list)); 
    $_SESSION['test']=$_POST['data'];
?>