<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

$sil=$_GET['id'];



$conn = mysqli_connect("localhost","root","","data34");

$a=mysqli_query($conn,"DELETE FROM `data3434` WHERE `data3434`.`id` = $sil");

header("location:index3.php");

?>
</body>
</html>