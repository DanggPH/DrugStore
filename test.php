<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="images/favicon.png">
      <title>Welcome to Drugshop</title>
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
      <link href="css/font-awesome.min.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>
      <link href="css/sequence-looptheme.css" rel="stylesheet" media="all"/>
      <link href="css/style.css" rel="stylesheet">
      <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script><![endif]-->
   </head>
   <body>
   <button onclick="hf()">a</button>
    <script>

    var list1 = localStorage.getItem('arrCart');
    // const cartMap=new Map();
    // cartMap.set('1','2');
    // var list1=JSON.stringify(cartMap);
    var list = JSON.parse(list1);
    console.log(list);
    $.post('test1.php', {'data': list},  function(data){});
    </script>
    <?php
    // session_start();
    // $list=$_POST['data'];
    // function myfunction($v)
    // {
    // $v=strtoupper($v);
    //   return $v;
    // }   
    $list=$_SESSION['test'];
    foreach ($list as $item) {
        echo $item['name'];
        echo $item['quality'];
    }
    // print_r(array_map("myfunction",$list)); 
    // // echo $_SESSION['test'];
    ?>
   </body>
</html>
