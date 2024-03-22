<?php 
    require '../../config/connect.php';
    $id=$_GET['id'];
    $sql="SELECT * FROM `user` where Id=$id";
    $result=mysqli_query($conn,$sql);
    $user=mysqli_fetch_array($result);
    if(empty($id) || empty($user)){
        header('location: ../includes/404.php');
    }
?>

<?php include '../includes/header.php' ?>

<link rel="stylesheet" href="../../content/css/Users.css">
<div class="container">
    <h2>Thông tin user</h2>
    <table class="table table-bordered">
        <tr>
            <td>Tài khoản</td>
            <td><?php echo $user['UserName'] ?></td>
        </tr>
        <tr>
            <td>Họ tên</td>
            <td><?php echo $user['Name'] ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $user['Email'] ?></td>
        </tr>
        <tr>
            <td>Địa chỉ</td>
            <td><?php echo $user['Address'] ?></td>
        </tr>
    </table>
    <a href="./index.php" class="btn action-1">Quay lại trang user</a>
</div>
<?php include '../includes/footer.php' ?>