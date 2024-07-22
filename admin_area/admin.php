<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./css/admin.css">
</head>
<body>
    <div class="container">
        <div class="main">
            <aside class="sidebar">
                <img src="../images/LOGOthuonghieu.png" class="logoTH" alt="logo">
                    <a href="insert_product.php">Thêm Sản Phẩm</a>
                    <a href="#">Xem Sản Phẩm</a>
                    <a href="index.php?insert_category">Thêm Mục Hàng</a>
                    <a href="#">Xem Mục Hàng</a></li>
                    <a href="index.php?insert_brand">Thêm Thương Hiệu</a>
                    <a href="#">Xem Thương Hiệu</a>
                    <a href="#">Tất Cả Đơn Hàng</a>
                    <a href="#">Tất Cả Thanh Toán</a>
                    <a href="#">Danh Sách Users</a>
                    <a href="#">Đăng Xuất</a>
            </aside>
            <section class="content">
                <h2>Chào Mừng Bạn Đến Trang ADMIN !</h2>
                <img src="../images/giaodienAD.jpg" class="giaodienAD" alt="">
            </section>  
        </div>
        <div class="footer">
            <p>UTH-LapTrinhWEB-2024</p>
        </div>
    </div>
    <?php 
            if(isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            if(isset($_GET['insert_brand'])){
                include('insert_brands.php');
            }
            ?>
</body>
</html>
