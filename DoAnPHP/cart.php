<?php
    require './config/connect.php'; 
?>
<!-- Header -->
<?php include './includes/header.php'?>
<?php 
    if(!empty($_SESSION['Id'])){
        $id=$_SESSION['Id'];
    }
    if(!empty($id)){
        $sql="select sanpham.*,Quantity,IdCart from sanpham,cart WHERE sanpham.MaSP=cart.MaSP and cart.IdUser=$id";
        $result= mysqli_query($conn,$sql);
        $total=0;
    }
?>
<link href="./content/css/GioHang.css" rel="stylesheet" />
<div class="container">
<div class="row">
    <h2>Giỏ Hàng</h2>
        <?php if(mysqli_num_rows($result)>0){?>

            <div class="col-lg-9 col-md-12 col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên SP</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Đơn Giá</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Xoá</th>
                        </tr>
                    </thead>
                    <?php foreach($result as $each){?>
                        <tbody>
                            <tr>
                                <?php 
                                    $sl=$each['Quantity'];
                                    $temp=$sl*$each['Gia'];
                                    $total+=$temp;
                                ?>
                                <td><img src="./content/images/product/<?php echo $each['Anh']?>" alt="Alternate Text" /></td>
                                <td><a href="./detail.php?id=<?php echo $each['MaSP']?>"><?php echo $each['TenSP']?></a></td>
                                <td>
                                    <form action="./handlers/update_quantity.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="ProId" value="<?php echo $each['MaSP']?>" />
                                        <input type="number" class="num" name="Quantity" value="<?php echo $each['Quantity']?>" min="1" />
                                        <button class="btn" class="update" type="submit"></button>
                                    </form>
                                </td>
                                <td><?php echo number_format($each['Gia'], 0, ".", ",")?> đ</td>
                                <td><?php echo number_format($temp, 0, ".", ",")?> đ</td>
                                <td>
                                    <form action="./handlers/delete_cart.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="IdCart" value="<?php echo $each['IdCart'] ?>">
                                        <button class="btn" type="submit"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    <?php }?>

                </table>
            </div>
            <div class="col-lg-3 col-md-12 col-12">
                <div class="row">
                    <div class="col-6">Tổng tiền</div>
                    <div class="col-6"><?php echo number_format($total, 0, ".", ",")?> đ</div>
                </div>
                <div class="row action-product">
                    <div class="col-6">
                        <a href="./products.php" class="btn action-1">TIẾP TỤC MUA</a>
                    </div>
                    <div class="col-6">
                        <form action="./handlers/buy_cart.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" id="MaUser" name="MaUser" value="@User.Identity.Name" />
                            
                            <button class="btn action-2" type="submit">THANH TOÁN</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php 
        } else {?>
        <div class="info-none-product">
            <img src="https://theme.hstatic.net/200000420363/1001121558/14/empty_cart.png?v=680" width="30%" />
            <h3>Không có sản phẩm nào trong giỏ hàng</h3>
            <a href="./products.php" class="btn">Quay trở lại trang sản phẩm</a>
        </div>
    <?php }?>
</div>

<!-- Footer -->
<?php include './includes/footer.php'?>