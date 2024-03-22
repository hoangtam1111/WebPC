<?php 
session_start();
$_SESSION['Id']="";
$_SESSION['Name']="";
session_destroy();
// setcookie('PHPSESSID','',-1,'/');

header("location: ../index.php");
