<?php 
    include '../../config/connect.php';
    $id=$_GET['id'];
    
    $sql="SELECT * FROM `brand` WHERE BrandId=$id";
    $result=mysqli_query($conn,$sql);
    $brand=mysqli_fetch_array($result);  
    if(empty($id) || empty($brand))
    {
        header('location: ../includes/404.php');
    }
    $errName="";
    $errLogo="";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(!empty($_POST['BrandId']))
        {
            $id=$_POST['BrandId'];
            $product="SELECT * FROM `sanpham` WHERE BrandId=$id";
            $result=mysqli_query($conn,$product);
            if(mysqli_num_rows($result)>0){
                header("location: ./index.php?delete=Error: brand included in the product");
            }
            $delete="DELETE FROM `brand` WHERE `BrandId`='$id'";
            mysqli_query($conn,$delete);
            mysqli_close($conn);
            header("location: ./index.php?delete=Successfully");
        }
    }  
?>
<?php require '../includes/header.php'?>

<div class="container">
    <h2>Chỉnh sửa sản phẩm</h2>
    <form method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <input type="hidden" name="BrandId" value="<?php echo $brand['BrandId']?>" />
            <tr>
                <td><label class="form-label">Tên thương hiệu</label></td>
                <td><?php echo $brand['BrandName']?></td>
            </tr>
            <tr>
                <td><label class="form-label">Logo thương hiệu</label></td>
                <td><img src="<?php echo $brand['BrandLogo']?>" alt="Alternate Text" /></td>
            </tr>
        </table>
        <button type="submit" class="btn action-1">Xóa</button>
        <a href="./index.php" class="btn action-2">Huỷ</a>
    </form>
</div>

<?php require '../includes/footer.php'?>