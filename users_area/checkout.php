<?php
include('../includes/connect.php');
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    include('user_login.php');
    // Dừng việc thực hiện mã tiếp theo để chỉ hiển thị trang đăng nhập
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Thanh Toán.</title>
    <link rel="stylesheet" href="../css/index.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .checkout-section {
        padding-top: 80px;
        margin: 20px auto;
        max-width: 1200px;
    }

    .checkout-section .col-md-12 {
        background-color: white;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .checkout-section .col-md-12 .row {
        font-size: 55px;
    }

    a {
        text-decoration: none !important;
    }
    </style>
</head>

<body>
    <!-- header -->

    <section class="header">
        <a href="#" class="logo"> <i class="fas fa-chair"></i> MongLinhStore</a>

        <nav class="navbar">
            <a href="../index.php">Trang Chủ</a>
            <a href="../display_all.php">Sản Phẩm</a>
            <a href="#contact">Liên Hệ</a>
        </nav>

        <div class="icons">
            <a>
                <?php
                echo "<a class='nav-link' href='logout.php'>Đăng Xuất</a>";
                ?>
            </a>
            <form class="search-form" action="../search_product.php" method="get">
                <input type="search" placeholder="Tìm kiếm" aria-label="Search" name="search_data">
                <input type="submit" value="Tìm Kiếm" name="search_data_product">
            </form>
        </div>

    </section>

    <!-- second child -->
    <div class="checkout-section">
        <div class="col-md-12">
            <!-- products -->
            <div class="row">
                <?php
                include('payment.php');
                ?>
                <!-- row end -->
            </div>
            <!-- col end -->
        </div>
    </div>

    <!-- last child -->
    <!-- include footer -->
    <section class="credit">
        <div class="credit-left">
            <h3>Thông Tin Liên Hệ</h3>
            <p>Email: 2251120428@ut.edu.vn (Minh)</p>
            <p>Email: 2251120305@ut.edu.vn (Long)</p>
        </div>
        <div class="credit-right">
            <h3>Copyright</h3>
            <p>&copy; 2024 MongLingStore. All Rights Reserved.</p>
            <p>Địa chỉ: 70 Tô Ký, Phường Tân Chánh Hiệp, quận 12, TP.HCM</p>
        </div>
    </section>
    </div>

</body>

</html>