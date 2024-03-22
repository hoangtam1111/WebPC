<?php require './config/connect.php'; ?>

<?php include './includes/header.php' ?>
<div class="container">
    <h2>Thông tin của tôi</h2>
    <?php
        if(!empty($_SESSION['Id'])){
            $id=$_SESSION['Id'];
            $sql="SELECT UserName,Name,Address,Email FROM `user` WHERE Id=$id";
            $result=mysqli_query($conn,$sql);
            $each=mysqli_fetch_array($result);
    ?>
    <table class="table table-bordered">
        <tr>
            <td><strong>Tên tài khoản: </strong></td>
            <td><?php echo $each['UserName']?></td>
        </tr>
        <tr>
            <td><strong>Email: </strong></td>
            <td><?php echo $each['Email'] ?></td>
        </tr>
        <tr>
            <td><strong>Họ tên:</strong></td>
            <td><?php echo $each['Name'] ?></td>
        </tr>
        <tr>
            <td><strong>Địa chỉ:</strong></td>
            <td><?php echo $each['Address'] ?></td>
        </tr>
    </table>
    <?php
        }else{
            echo "Không có thông tin";
        }
    ?>
</div>

<?php include './includes/footer.php' ?>