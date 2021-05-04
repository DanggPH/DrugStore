<!DOCTYPE html> 
<html> 
<head> 
<title>Image Upload</title> 
<link rel="stylesheet" href="style.css"> 
</head> 
<body> 
<div id="content"> 
<form method="POST" action="upload.php" enctype="multipart/form-data"> 
<input type="hidden" name="size" value="1000000"> 
<input type="file" name="image"> 
<button type="submit" name="upload">POST</button>
<?php require "xuly.php"?>
</form> 
</div> 
</body> 
</html>