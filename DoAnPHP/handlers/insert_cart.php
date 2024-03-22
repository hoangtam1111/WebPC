<?php 

require '../config/connect.php';
session_start();
if(!empty($_SESSION['Id'])){
    
    if(!empty($_POST['MaSP'])){
        $maSP=$_POST['MaSP'];
        $user=$_SESSION['Id'];
        $sql="SELECT * FROM `cart` WHERE IdUser='$user' and MaSP='$maSP'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            $each=mysqli_fetch_array($result);
            $quantity=$each['Quantity']+1;
            $insert="UPDATE cart SET Quantity=$quantity WHERE MaSP=$maSP and IdUser=$user";
        }else{
            
            $insert="INSERT INTO cart (`MaSP`, `IdUser`, `Quantity`) VALUES ('$maSP','$user','1')";
        }
        mysqli_query($conn,$insert);
        header("location: ../cart.php");
        exit();
    }
}
header("location: ../index.php?error=insert cart error");