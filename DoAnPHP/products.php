<?php
    require './config/connect.php';
    $search="";
    $MaLoai="";
    $brandId="";
    if(!empty($_GET['loaiSP'])){
        $MaLoai=$_GET['loaiSP'];
    }
    if(!empty($_GET['brand'])){
        $brandId=$_GET['brand'];
    }
    if(empty($_GET['search']))
    {
        $sql1= "SELECT * FROM `sanpham`";
        if(!empty($MaLoai) && !empty($brandId))
            $sql1= "SELECT * FROM `sanpham` WHERE MaLoai='$MaLoai' and BrandId='$brandId'";
        else if(!empty($MaLoai) && empty($brandId))
            $sql1= "SELECT * FROM `sanpham` WHERE MaLoai='$MaLoai'";
        else if(empty($MaLoai) && !empty($brandId))
            $sql1= "SELECT * FROM `sanpham` WHERE BrandId='$brandId'";    
    }
    else{
        $search=$_GET['search'];
        $sql1= "SELECT * FROM `sanpham` WHERE TenSP LIKE '%$search%'";
        if(!empty($MaLoai) && !empty($brandId))
            $sql1= "SELECT * FROM `sanpham` WHERE TenSP LIKE '%$search%' and MaLoai='$MaLoai' and BrandId='$brandId'";
        else if(!empty($MaLoai) && empty($brandId))
            $sql1= "SELECT * FROM `sanpham` WHERE TenSP LIKE '%$search%' and MaLoai='$MaLoai'";
        else if(empty($MaLoai) && !empty($brandId))
            $sql1= "SELECT * FROM `sanpham` WHERE TenSP LIKE '%$search%' and BrandId='$brandId'";    
    }
    
    echo $sql1;
    echo $brandId;
    echo $MaLoai;
    echo $search;
    $sql2= "SELECT * FROM `loaisp`";
    $sql3= "SELECT * FROM `brand`";
    $result= mysqli_query($conn,$sql1);
    $productType= mysqli_query($conn,$sql2);
    $brand= mysqli_query($conn,$sql3);

?>



<!-- Header -->
<?php include './includes/header.php'?>
<link href="./content/css/productIndex.css" rel="stylesheet" />
<div class="container">
    <div class="row">
        <div class="insBreadcrumbs">
            <ul>
                <li>
                    <a href="/home/index">Trang chủ</a> /
                </li>
                <li>
                    <a href="/product/index">Sản phẩm</a> /
                </li>
            </ul>
        </div>
        <img class="img-banner" src="https://file.hstatic.net/200000420363/collection/head-muc-freeship__3__c83c99ea41d643c5b847c293fd2e4794.jpg" alt="Alternate Text" />
    </div>

    <!-- Brand -->
    <div class="row">
        <h2>Thương hiệu</h2>
        <?php foreach($brand as $each){
            global $MaLoai;?>
            <div class="brand-item col">
                <a href="./products.php?search=<?php echo $search?>&loaiSP=<?php echo $MaLoai ?>&brand=<?php echo $each['BrandId']?>">
                    <img src="<?php echo $each['BrandLogo']?>" alt="Alternate Text" />
                </a>
            </div>
        <?php }?>
    </div>
    <div class="row">
        <h2>Linh kiện</h2>
        <ul class="loai-item">
        <?php foreach($productType as $each){
            global $brandId;?>
            <li>
                <a href="./products.php?search=<?php echo $search?>&loaiSP=<?php echo $each['MaLoai'] ?>&brand=<?php echo $brandId;?>">
                    <span><?php echo $each['TenLoai']?></span>
                </a>
            </li>
        <?php }?>
        </ul>
    </div>
    <div class="row">
        <h2> sản phẩm</h2>
        <?php foreach($result as $each){?>
            <div class="col-lg-2 col-md-4 col-4">
                <div class="card-product">
                    <div class="card">
                        <img src="./content/images/product/<?php echo $each['Anh']?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <a href="./detail.php?id=<?php echo $each['MaSP'];?>"><?php echo $each['TenSP'];?></a>
                            <div style="color: red;"><?php echo number_format($each['Gia'], 0, ".", ",")?> đ</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</div>

 
<!-- Footer --> 
<?php include './includes/footer.php'?>