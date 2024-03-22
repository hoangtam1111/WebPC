<?php 

require '../config/connect.php';
echo $_POST['ProId'];
if(!empty($_POST['ProId'])&&!empty($_POST['Quantity'])){
    $proId=$_POST['ProId'];
    $num=$_POST['Quantity'];
    session_start();
    $Id=$_SESSION['Id'];
    $update="UPDATE `cart` SET `Quantity`='$num' WHERE MaSP='$proId' and IdUser='$Id'";
    mysqli_query($conn,$update);
    header("location: ../cart.php");
    exit();
}
header("location: ../index.php?error=update quantity error");
