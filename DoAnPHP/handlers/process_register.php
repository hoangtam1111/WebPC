<?php

require '../config/connect.php';

if(empty($_POST['Name'])||empty($_POST['Email'])||empty($_POST['DiaChi'])||empty($_POST['Username'])||empty($_POST['Password'])||empty($_POST['ConfirmPassword'])){
    header('location:../login.php?register error');
}
$name=$_POST['Name'];
$email=$_POST['Email'];
$address=$_POST['DiaChi'];
$username=$_POST['Username'];
$password=$_POST['Password'];
$confirm=$_POST['ConfirmPassword'];
if($password==$confirm){
    $sql="INSERT INTO `user`(`UserName`, `Password`, `Name`, `Email`, `Address`) VALUES ('$username','$password','$name','$email','$address')";       
    mysqli_query($conn,$sql);
    $select="SELECT Id,Name,Admin FROM `user` WHERE UserName='$username' and Password='$password'";
    $result=mysqli_query($conn,$select);
    $each=mysqli_fetch_array($result);
    session_start();
    $_SESSION['Id']=$each['Id'];
    $_SESSION['Name']=$each['Name'];
    $_SESSION['Admin']=0;
    header("location: ../index.php?success=register successfully");
    exit;
}
header("location: ../login.php?error=register unsuccessful");