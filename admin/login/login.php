<?php
require_once('../db/dbhelper.php');
session_start();
?>
<html>
<head>
	<title>Trang đăng nhập</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/login.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<?php
	//Gọi file connection.php ở bài trước
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST["btn_submit"])) {
		// lấy thông tin người dùng
		$username = $_POST["username"];
		$password = $_POST["password"];
        $token= $_POST["token"];
        // if($token==$_SESSION["token"]){
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
            $username = addslashes(strip_tags($username));
            $password = strip_tags($password);
            $password = addslashes($password);

            if ($username == "" || $password =="") {
                $_SESSION["thongbao"]= "username hoặc password bạn không được để trống!";
            }else{
                $sql = "select * from accountad where username = '$username' and password = '$password' ";
                $num_rows=numrows($sql);
                if ($num_rows==0) {
                    $_SESSION["thongbao"]=  "tên đăng nhập hoặc mật khẩu không đúng !";
                }else{
                    //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    // Thực thi hành động sau khi lưu thông tin vào session
                    // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
                    header('Location: ../index.php');
                }
            }
		}
	// }
    $token=rand(0,10000000000);
    $_SESSION["token"]=$token;
?>
    <header>
        <div class="container">
            TRANG QUẢN TRỊ
        </div>
    </header>
    <main>
        <div class="container">
        <div class="login-form">
            <form action="" method="POST">
                <h1>Đăng nhập vào website</h1>
                <div class="input-box">
                    <i ></i>
                    <input type="text" id="username" name="username" placeholder="Nhập username">
                </div>
                <div class="input-box">
                    <i ></i>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu">
                </div>
                <div class="text">
                    <i ></i>
                    <?php
                     if(isset($_SESSION["thongbao"])) 
                    echo $_SESSION["thongbao"];
                    ?>
                </div>
                <input type="hidden" id="token" name="token" value="<?=$token?>" >
                <div class="btn-box">
                    <button name="btn_submit" type="submit">
                        Đăng nhập
                    </button>
                </div>
            </form>
        </div>
        </div>
    </main>
    <footer>
        <div class="container">
        Học viện Kỹ thuật Mật mã
        </div>
    </footer>
</body>