<?php 
    require '../../config/connect.php';
    $TenLoai="";
    $errTenLoai="";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(empty($_POST['TenLoai'])){
            $errTenLoai="Vui lòng nhập tên loại";
        }
        else{
            $TenLoai=$_POST['TenLoai'];
            $insert="INSERT INTO `loaisp`(`TenLoai`) VALUES ('$TenLoai')";
            mysqli_query($conn,$insert);
            mysqli_close($conn);
            header("location: ./index.php?insert=Successfully");
        }
    }
?>
<?php include '../includes/header.php'?>

<div class="container"> 
    <h2>Insert</h2>
    <form method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td><label class="form-label">Loại sản phẩm</label></td>
                <td>
                    <input type="text" class="form-control" id="TenLoai" placeholder="Tên Loại" name="TenLoai" value="<?php $TenLoai ?>"/>
                    <?php echo "<p class='text-danger'>$errTenLoai</p>" ?>
                </td>
            </tr>
        </table>
        <button type="submit" class="btn action-1">Thêm</button>
        <a href="./index.php" class="btn action-2">Huỷ</a>
    </form>
</div>

<?php include '../includes/footer.php' ?>