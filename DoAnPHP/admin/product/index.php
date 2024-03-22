<?php 
    require '../../config/connect.php';
    if(isset($_GET['search']))
        $search=$_GET['search'];
    if(empty($search))
    {
        $sql1= "SELECT sanpham.*,brand.BrandName,loaisp.TenLoai FROM `sanpham`,loaisp,brand WHERE sanpham.MaLoai=loaisp.MaLoai and sanpham.BrandId=brand.BrandId ";
    }
    else{
        $sql1= "SELECT sanpham.*,brand.BrandName,loaisp.TenLoai FROM `sanpham`,loaisp,brand WHERE sanpham.MaLoai=loaisp.MaLoai and sanpham.BrandId=brand.BrandId and TenSP LIKE '%$search%'";
    }
    $result= mysqli_query($conn,$sql1);
    $rowCount = mysqli_num_rows($result);
?>

<?php include '../includes/header.php' ?>
<link href="../../content/css/productIndex.css" rel="stylesheet" />
<div class="container">
    <div class="insBreadcrumbs">
        <ul>
            <li>
                <a href="../home">Trang chủ</a> /
            </li>
            <li>
                <a href="../product">Sản phẩm</a> /
            </li>
        </ul>
    </div>
    <!-- @if (ViewBag.Brand == 0)
    {
        <div class="row">
            <h2>Thương hiệu</h2>
            @foreach (var item in brands)
            {
                <div class="brand-item col">
                    <a href="/admin/product/index/@ViewBag.MaLoai?search=@ViewBag.Search&nameSort=Name&loaiSP=@ViewBag.LoaiSP&brand=@item.BrandId">
                        <img src="@item.BrandLogo" alt="Alternate Text" />
                    </a>
                </div>
            }
        </div>
    }

    @if (ViewBag.LoaiSP == 0)
    {
        <div class="row">
            <h2>Linh kiện</h2>
            <ul class="loai-item">
                @foreach (var item in loaiSPs)
                {
                    <li>
                        <a href="/admin/product/index/@ViewBag.MaLoai?search=@ViewBag.Search&nameSort=Name&loaiSP=@item.MaLoai&brand=@ViewBag.Brand">
                            <span>@item.TenLoai</span>
                        </a>
                    </li>
                }
            </ul>
        </div>
    } -->
    <a href="insert.php"><h2>Thêm sản phẩm</h2></a>
    <div class="row">
        <div class="col-6">
            <h2><?php echo $rowCount?> sản phẩm</h2>
        </div>
        <div class="col-6">
            <div class="dropdown">
                <a class="btn dropdown-toggle" href="/admin/product/index?search=@ViewBag.Search&nameSort=@ViewBag.NameSort&loaiSP=@ViewBag.LoaiSP&brand=@ViewBag.Brand" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sắp xếp theo tên
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/admin/product/index?search=@ViewBag.Search&nameSort=TenSP&loaiSP=@ViewBag.LoaiSP&brand=@ViewBag.Brand">Sắp xếp theo tên</a></li>
                    <li><a class="dropdown-item" href="/admin/product/index?search=@ViewBag.Search&nameSort=GiaTang&loaiSP=@ViewBag.LoaiSP&brand=@ViewBag.Brand">Sắp xếp theo giá tăng dần</a></li>
                    <li><a class="dropdown-item" href="/admin/product/index?search=@ViewBag.Search&nameSort=GiaGiam&loaiSP=@ViewBag.LoaiSP&brand=@ViewBag.Brand">Sắp xếp theo giá giảm dần</a></li>
                    <li><a class="dropdown-item" href="/admin/product/index?search=@ViewBag.Search&nameSort=Loai&loaiSP=@ViewBag.LoaiSP&brand=@ViewBag.Brand">Sắp xếp theo loại linh kiện</a></li>
                    <li><a class="dropdown-item" href="/admin/product/index?search=@ViewBag.Search&nameSort=Brand&loaiSP=@ViewBag.LoaiSP&brand=@ViewBag.Brand">Sắp xếp theo hãng</a></li>
                </ul>
            </div>
        </div>
        
        <table class="table table-bordered">
            <tr>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Hãng</th>
                <th>Loại</th>
                <th>Chỉnh sửa</th>
            </tr>
            <?php foreach($result as $product){?>
                <tr>
                    <td>
                        <img src="../../content/images/product/<?php echo $product['Anh']?>" style="height: 50px" class="card-img-top" alt="">
                    </td>
                    <td><a href="detail.php?id=<?php echo $product['MaSP']?>"><?php echo $product['TenSP']?></a></td>
                    <td><?php echo number_format($product['Gia'], 0, ".", ",")?> đ</td>
                    <td><?php echo $product['SoLuong']?></td>
                    <td><?php echo $product['BrandName']?></td>
                    <td><?php echo $product['TenLoai']?></td>
                    <td><a href="update.php?id=<?php echo $product['MaSP']?>">Sửa</a> | <a href="delete.php?id=<?php echo $product['MaSP']?>">Xóa</a></td>
                </tr>
            <?php } ?>
        </table>
        <!-- @{
            int PrevPage = ViewBag.Page - 1;
            if (PrevPage <= 0)
            {
                PrevPage = 1;
            }
            int NextPage = ViewBag.Page + 1;
            if (NextPage > ViewBag.NoOfPages)
            {
                NextPage = ViewBag.NoOfPages;
            }
        }
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="/admin/product/index?search=@ViewBag.Search&nameSort=@ViewBag.NameSort&page=@PrevPage&loaiSP=@ViewBag.LoaiSP&brand=@ViewBag.Brand">Pre</a>
            </li>
            @for (int i = 0; i < ViewBag.NoOfPages; i++)
            {
                <li class="page-item">
                    <a class="page-link" href="/admin/product/index?search=@ViewBag.Search&nameSort=@ViewBag.NameSort&page=@(i+1)&loaiSP=@ViewBag.LoaiSP&brand=@ViewBag.Brand">@(i+1)</a>
                </li>
            }
            <li class="page-item">
                <a class="page-link" href="/admin/product/index?search=@ViewBag.Search&nameSort=@ViewBag.NameSort&page=@NextPage&loaiSP=@ViewBag.LoaiSP&brand=@ViewBag.Brand">Next</a>
            </li>
        </ul> -->
    </div>
</div>

<?php include '../includes/footer.php' ?>