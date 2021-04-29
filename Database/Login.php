<?php
	session_start();
	if(isset($_SESSION['userinfor'])) {
		header('Location: ../index.php');
		die();
	}
	if(!empty($_POST)) {
		require_once('dbhelper.php');
		$alert='';
		$email = $password = '';
		if(isset($_POST['email']) and $_POST['email']!='') {
			$email = $_POST['email'];
			$_SESSION['email']=$email;
		} else $alert=$alert.'<br> Vui lòng nhập email';
		if(isset($_POST['password'])and $_POST['password']!='') {
			$password = $_POST['password'];
			$_SESSION['password']=$password;
		} else $alert=$alert.'<br> Vui lòng nhập password';
		
		if($alert=='') {
			$password = md5(md5(md5($password)));
			$sql = "select * from accountcus where email = '$email' and password = '$password'";
			$result = executeResult($sql);
			if($result != null && count($result) > 0) {
				//login success
				$_SESSION['userinfor'] = $result[0];
				unset($_SESSION['email']);
				unset($_SESSION['password']);
				header('Location:../index.php');
				die();
			} else {
				$alert=$alert.'<br> Vui lòng nhập đúng email và password';
				$_SESSION['notify']=$alert;
				header('Location: ../login.php');	
			}
		}
		else {
			$_SESSION['notify']=$alert;
			header('Location: ../login.php');
		}
		
	}
?>
