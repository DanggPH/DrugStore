<?php
	session_start();
	if(isset($_SESSION['userinfor'])) {
		header('Location:../index.php');
		die();
	}
	if(!empty($_POST)) {
		require_once('dbhelper.php');	


		$email = $fullname = $password = $confirmation_pwd = 
        $address1 = $address2 = $district = $phone = $city = '';


		if(isset($_POST['fullname'])) {	
			$fullname = $_POST['fullname'];
		}
		if(isset($_POST['email'])) {
			$email = $_POST['email'];
		}
        if(isset($_POST['phone'])) {
			$phone = $_POST['phone'];
		}
		if(isset($_POST['password'])) {
			$password = $_POST['password'];
		}
		if(isset($_POST['confirmation_pwd'])) {
			$confirmation_pwd = $_POST['confirmation_pwd'];
		}
        if(isset($_POST['address1'])) {
			$address1 = $_POST['address1'];
		}
        if(isset($_POST['address2'])) {
			$address2 = $_POST['address2'];
		}
        if(isset($_POST['district'])) {
			$district = $_POST['district'];
		}
        if(isset($_POST['city'])) {
			$city = $_POST['city'];
		}
        		
		if($password == $confirmation_pwd && !empty($fullname) && !empty($email) 
				&& !empty($phone) && !empty($address1) && !empty($district) && !empty($city)) {
			$password = md5(md5(md5($password)));
			$sql = "insert into customer(id, hoten, email, sodienthoai, matkhau, diachi1, diachi2, quanhuyen, thanhpho) values ('', '$fullname', '$email', '$phone', '$password', '$address1', '$address2', '$district', '$city')";
			execute($sql);
			header('Location: ../../DrugStore-main/Database/Welcome.php');
			die();
		}
	}
?>