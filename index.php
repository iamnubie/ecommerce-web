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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa hàng nội thất Mong Linh</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    .header {
        padding: 0.1rem 3% !important;
    }
    </style>
</head>

<body>

    <!-- header -->

    <section class="header">
        <!-- <a href="index.php" class="logo"> <i class="fas fa-chair"></i> MongLinhStore</a> -->
        <a href="index.php" class="logo"> <img src="images/ML.jpg" alt="Logo" style="width: 100px;"></a>
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
            <a href="#contact">Liên Hệ</a>
        </nav>

        <div class="icons">
            <a href="cart.php"> 🛒<sup><?php cart_item();?></sup></a>
            <form class="search-form" action="search_product.php" method="get">
                <input type="search" placeholder="Tìm kiếm" aria-label="Search" name="search_data">
                <input type="submit" value="Tìm Kiếm" name="search_data_product">
            </form>
            <?php
    if(!isset($_SESSION['username'])){
        echo "<a class='nav-link' href='./users_area/user_login.php'><div id='account-btn' class='fas fa-user'></div></a>";
    } else {
        echo "<a class='nav-link' href='./users_area/logout.php' class='logout-icon'><i class='fa fa-sign-out-alt logout-icon'></i></a>";
    }
    ?>
        </div>


    </section>

    <!-- header -->
    <!-- -==================================================================================================== -->
    <!-- home -->

    <section class="home" id="home">

        <div class="swiper home-slider">
            <div class="swiper-wrapper">

                <div class="swiper-slide slide" style="background: url(images/home-slide1.jpg);">
                    <div class="content">
                        <h3>MongLinhStore</h3>
                        <span>Lắng Nghe - Kiên Trì - Đổi Mới</span>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <!-- home -->
    <!-- =============================================================================================================== -->
    <!-- product -->
    <!-- calling cart function -->
    <?php
        cart();
    ?>

    <section class="product" id="product">

        <h1 class="heading" id="heading"><span>Sản Phẩm</span></h1>

        <div class="box-container">
            <?php
    //calling function
    getproducts();
    get_unique_categories();
    get_unique_brands();
    ?>
        </div>

    </section>


    <!-- product -->
    <!-- ================================================================ -->
    <!-- contact -->

    <section class="contact" id="contact">

        <h1 class="heading"> <span>Liên Hệ</span> Chúng Tôi</h1>

        <div class="row">

            <div class="image">
                <img src="images/contact.png" alt="">
            </div>

            <form action="">
                <h3>Liên Hệ</h3>

                <span>Họ Và Tên</span>
                <input type="text" class="box">

                <span>Số Điện Thoại</span>
                <input type="number" class="box">

                <span>Email</span>
                <input type="email" class="box">

                <span>Nội Dung</span>
                <textarea class="box" cols="30" rows="10"></textarea>

                <input type="submit" value="Gửi" class="btn">

            </form>

        </div>

    </section>

    <!-- contact -->

    <!-- credit -->

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

    <!-- credit -->

    <!-- custom js -->
    <script src="script.js"></script>
</body>

</html>