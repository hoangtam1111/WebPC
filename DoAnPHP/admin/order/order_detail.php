<?php 
    require '../../config/connect.php';
    $id=$_GET['id'];
    $sql="SELECT sanpham.TenSP,sanpham.Gia,sanpham.Anh,ctdh.SoLuong,sanpham.Gia*ctdh.SoLuong as 'Tien' FROM `ctdh`,sanpham WHERE ctdh.MaSP=sanpham.MaSP";
    $result=mysqli_query($conn,$sql);

?>

<?php include '../includes/header.php'; ?>

<link href="../..//content/css/Users.css" rel="stylesheet" />
<link href="../..//content/css/productIndex.css" rel="stylesheet" />

<div class="container">
    <div class="insBreadcrumbs">
        <ul>
            <li>
                <a href="../home/">Trang chủ</a> /
            </li>
            <li>
                <a href="./index.php">Đơn hàng</a> /
            </li>
            <li>
                <a href="./order_detail.php?id=<?php echo $id?>">Chi tiết đơn hàng</a> /
            </li>
        </ul>
    </div>
    <table class="table table-bordered">
            <tr>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
            <?php foreach($result as $product){?>
                <tr>
                    <td>
                        <img src="../../content/images/product/<?php echo $product['Anh']?>" style="height: 50px" class="card-img-top" alt="">
                    </td>
                    <td><a href="detail.php?id=<?php echo $product['MaSP']?>"><?php echo $product['TenSP']?></a></td>
                    <td><?php echo number_format($product['Gia'], 0, ".", ",")?> đ</td>
                    <td><?php echo $product['SoLuong']?></td>
                    <td><?php echo number_format($product['Tien'], 0, ".", ",")?> đ</td>
                </tr>
            <?php } ?>
        </table>
</div>

<?php include '../includes/footer.php'; ?>