<?php 
    require '../../config/connect.php';
    $id=$_GET['id'];
    $sql="SELECT * FROM `user` where Id=$id";
    $result=mysqli_query($conn,$sql);
    $user=mysqli_fetch_array($result);
    if(empty($user) || empty($id))
        header('location: ../includes/404.php');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id=$_POST['Id'];
        $cart="SELECT * FROM `cart` WHERE IdUser=1";
        $result=mysqli_query($conn,$cart);
        if(mysqli_num_rows($result)>0){
            header("location: ../index.php?delete=Error: user included in the cart");
        }
        echo mysqli_num_rows($result);
        $delete="DELETE FROM `user` WHERE Id='$id'";
        $result=mysqli_query($conn,$delete);
        mysqli_close($conn);
        if($result['bool'])
            header("location: ../index.php?delete=Successfully");
        else
            header("location: ../index.php?delete=Error: user included in the cart");
    }
?>

<?php include '../includes/header.php' ?>

<link rel="stylesheet" href="../../content/css/Users.css">
<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="login">
            <h2>Xóa tài khoản</h2>
            <table class="table table-bordered">
                <input type="hidden" name="Id" value="<?php echo $id?>" />
                <tr>
                    <td>Tài khoản</td>
                    <td><?php echo $user['UserName']?></td>
                </tr>
                <tr>
                    <td>Họ tên</td>
                    <td><?php echo $user['Name']?>e</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $user['Email']?></td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td><?php echo $user['Address']?></td>
                </tr>
            </table>
            <div class="action">
                <button type="submit" class="btn action-1">Xóa</button>
                <a href="./index.php" class="btn action-2">Quay lại trang user</a>
            </div>
        </div>
    </form>
</div>
<?php include '../includes/footer.php' ?>