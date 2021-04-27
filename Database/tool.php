<?php
	session_start();
	require_once('dbhelper.php');

	if(!empty($_POST)) {
		$action = '';
		if(isset($_POST['action'])) {
			$action = $_POST['action'];
		}

		if($action == 'database') {
			//create database
			//createDatabase();
		} else if($action == 'table') {
			//create table
			$sql = 'create table if not exists users (
					id int primary key auto_increment,
					name varchar(50),
					email varchar(150),
					password varchar(50)
				)';
			execute($sql);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tools Database</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Tools Database</h2>
			</div>
			<div class="panel-body" style="text-align: center;">
				<form method="post">
					<button class="btn btn-warning" name="action" value="database">Create Database</button>
					<button class="btn btn-danger" name="action" value="table">Create Table</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>