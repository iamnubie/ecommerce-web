<!-- connect file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce website using PHP and MySQL.</title>

    <!-- css file -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    /* Main layout */
    .main-content {
        display: flex;
        padding: 15px;
    }

    /* Products Section */
    .products-section {
        width: 75%;
        padding-right: 10px;
    }

    .products-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .products-grid>div {
        flex: 1 1 calc(33.33% - 20px);
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    /* Sidebar */
    .sidebar {
        width: 25%;
        background-color: #f8f9fa;
        padding: 20px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    /* Sidebar Headers */
    .sidebar-header {
        color: white;
        padding: 15px;
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
        border-radius: 5px;
        text-transform: uppercase;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        font-size: 25px;
    }

    /* Sidebar Items */
    .categories li,
    .brands li {
        background-color: #6c757d;
        color: white;
        padding: 10px;
        margin-bottom: 10px;
        text-align: center;
        border-radius: 5px;
        transition: background-color 0.3s ease, font-size 0.3s ease;
        cursor: pointer;
        font-size: 15px;
        /* Set initial font size */
    }

    .categories li:hover,
    .brands li:hover {
        background-color: #495057;
        font-size: 15px;
        /* Increase font size on hover */
    }

    .categories li a,
    .brands li a {
        color: white;
        text-decoration: none;
        display: block;
        width: 100%;
        height: 100%;
        font-size: inherit;
        /* Inherit the font size from li */
    }

    .categories li a:hover,
    .brands li a:hover {
        color: white;
        text-decoration: none;
    }

    .categories li a,
    .brands li a {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }

    /* Make the entire li clickable */
    .categories li,
    .brands li {
        position: relative;
    }

    .sidebar-header {
        background-color: #ce962e !important;
    }

    .sidebar-header:hover {
        background-color: #CC6600 !important;
    }

    /* .header {
        padding: 0.1rem 3% !important;
    } */
    </style>
</head>

<body>
    <!-- header -->

    <section class="header">
        <a href="index.php" class="logo"> MongLinhStore</a>
        <!-- <a href="index.php" class="logo"> <img src="images/ML.jpg" alt="Logo" style="width: 100px;"></a> -->
        <nav class="navbar">
            <a href="index.php">Trang Chủ</a>
            <a href="display_all.php">Sản Phẩm</a>
            <?php
if(isset($_SESSION['username'])){
  echo "<a class='nav-link' href='./users_area/profile.php'>Tài Khoản</a>";
}else{
  echo "<a class='nav-link' href='./users_area/user_register.php'>Đăng ký</a>";
}
        ?>
            <a href="index.php#contact">Liên Hệ</a>
        </nav>

        <div class="icons">
            <a href="cart.php"> 🛒<sup><?php cart_item();?></sup></a>
            <form class="search-form" action="search_product.php" method="get">
                <input type="search" placeholder="Tìm kiếm" aria-label="Search" name="search_data">
                <input type="submit" value="Tìm Kiếm" name="search_data_product">
            </form>
            <a>
                <?php
            if(!isset($_SESSION['username'])){
                echo "<a class='nav-link' href='./users_area/user_login.php'><div id='account-btn' class='fas fa-user'></div></a>";
            }else{
                echo "<a class='nav-link' href='./users_area/logout.php'><i class='fa fa-sign-out-alt logout-icon'></i></a>";
            }
        ?>
            </a>
        </div>

    </section>

    <!-- header -->

    <!-- second child -->
    <div class="main-content">
        <div class="products-section">
            <div class="products-grid">
                <?php
                // calling functions
                get_all_products();
                get_unique_categories();
                get_unique_brands();
            ?>
            </div>
        </div>
        <div class="sidebar">
            <ul class="categories">
                <li class="sidebar-header">Mục Hàng</li>
                <?php getcategories(); ?>
            </ul>
            <ul class="brands">
                <li class="sidebar-header">Thương Hiệu</li>
                <?php getbrands(); ?>
            </ul>
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
        </div>
    </section>
</body>

</html>