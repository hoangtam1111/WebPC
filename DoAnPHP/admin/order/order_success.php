<?php
if(!empty($_POST['MaDH'])){
    $maDH=$_POST['MaDH'];
    require '../../config/connect.php';
    
    $sql="DELETE FROM `ctdh` WHERE MaDH=$maDH";
    mysqli_query($conn,$sql);
    $deleteOrder="DELETE FROM `donhang` WHERE MaDH=$maDH";
    mysqli_query($conn,$deleteOrder);
    header("location: ../order/index.php?Order=successfully");
    exit;
}

header("location: ../order/index.php?Order=Error can't find MaDH");
