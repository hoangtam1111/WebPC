<?php
require '../config/connect.php';
session_start();
if(!empty($_SESSION['Id'])){
    
    $id=$_SESSION['Id'];
    // select cart
    $sql="SELECT * FROM `cart` WHERE IdUser=$id";
    $select=mysqli_query($conn,$sql);

    if(mysqli_num_rows($select)>0){
        // insert order
        $dayNow=date("Y-m-d");
        $insert="INSERT INTO `donhang`(`NgayDat`, `MaUser`) VALUES ('$dayNow','$id')";
        mysqli_query($conn,$insert);

        // select MaDH 
        $selectOder="SELECT MaDH FROM `donhang` WHERE NgayDat='$dayNow' and MaUser=$id ORDER BY MaDH DESC LIMIT 1;";
        $result=mysqli_query($conn,$selectOder);
        $order=mysqli_fetch_array($result);
        $MaDH=$order['MaDH'];

        // insert Order
        foreach($select as $each){
            $maSP=$each['MaSP'];
            $soLuong=$each['Quantity'];
            $insertOrder="INSERT INTO `ctdh`(`MaDH`, `MaSP`, `SoLuong`) VALUES ('$MaDH','$maSP','$soLuong')";
            mysqli_query($conn,$insertOrder);
        }
        // delete Cart
        $deleteCart="DELETE FROM `cart` WHERE IdUser=$id";
        mysqli_query($conn,$deleteCart);
        echo "Xoa thafnh cong ". $id;
        header("location: ../buy.php?MaDH=$MaDH");
        exit;
    }
    header("location: ../index.php?error=Not found product in cart");
}