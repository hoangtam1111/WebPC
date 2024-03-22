<?php 

require '../config/connect.php';
if(!empty($_POST['IdCart'])){
    $IdCart=$_POST['IdCart'];
    $delete="DELETE FROM `cart` WHERE IdCart='$IdCart'";
    mysqli_query($conn,$delete);
    header("location: ../cart.php");
    exit();
}
header("location: ../index.php?error=delete cart error");
