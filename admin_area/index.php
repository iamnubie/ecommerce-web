<!-- connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- boostrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <style>
    .admin_image {
        width: 100px;
        object-fit: contain;
    }

    .footer {
        position: absolute;
        bottom: 0;
    }

    body {
        overflow-x: hidden;
    }

    .product_img {
        width: 100px;
        object-fit: contain;
    }

    .third-child {
        position: sticky;
        top: 0;
        width: 100%;
        z-index: 1000;
    }

    .container-fluid {
        width: 101% !important;
    }
    </style>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/ML.jpg" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php 
                        if(isset($_SESSION['admin_name'])){
                            echo '<a href="" class="nav-link">Chào Mừng ' . $_SESSION['admin_name'] . '</a>';
                        } else {
                            echo '<a href="" class="nav-link">Chào Mừng bạn</a>';
                        }
                        ?> </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- second child -->
        <div class="bg-light">
            <h3 class="text-center p-2">Thông Tin Quản Lý</h3>
        </div>

        <!-- third child -->
        <div class="row third-child">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <a href="#"><img src="../images/logo-uth.jpg" alt="" class="admin_image"></a>
                    <p class="text-light text-center"><?php 
    if(isset($_SESSION['admin_name'])){
        echo $_SESSION['admin_name'];
    } else {
        echo 'Tên Quản Trị';
    }
    ?>
                    </p>
                </div>
                <!-- button*10>a.nav-link.text-light.bg-info.my-1 -->
                <div class="button text-center">
                    <button class="my-1"><a href="index.php?insert_product"
                            class="nav-link text-light bg-info my-1">Thêm Sản
                            Phẩm</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light bg-info my-1">Xem Sản
                            Phẩm</a></button>
                    <button><a href="index.php?insert_category" class="nav-link text-light bg-info my-1">Thêm Mục
                            Hàng</a></button>
                    <button><a href="index.php?view_categories" class="nav-link text-light bg-info my-1">Xem Mục
                            Hàng</a></button>
                    <button><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1">Thêm Thương
                            Hiệu</a></button>
                    <button><a href="index.php?view_brands" class="nav-link text-light bg-info my-1">Xem Thương
                            Hiệu</a></button>
                    <button><a href="index.php?list_orders" class="nav-link text-light bg-info my-1">Tất Cả Đơn
                            Hàng</a></button>
                    <button class="my-1">
                        <a href="index.php?list_payments" class="nav-link text-light bg-info my-1">Tất Cả Thanh Toán</a>
                    </button>
                    <button><a href="index.php?list_users" class="nav-link text-light bg-info my-1">Danh Sách
                            Users</a></button>
                    <button><a href="logout.php" class="nav-link text-light bg-info my-1">Đăng Xuất</a></button>
                </div>
            </div>
        </div>

        <!-- fourth child -->
        <div class="container my-3">
            <?php 
            if(isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            if(isset($_GET['insert_product'])){
                include('insert_product.php');
            }
            if(isset($_GET['insert_brand'])){
                include('insert_brands.php');
            }
            if(isset($_GET['view_products'])){
                include('view_products.php');
            }
            if(isset($_GET['edit_products'])){
                include('edit_products.php');
            }
            if(isset($_GET['hide_product'])){
                include('hide_product.php');
            }
            if(isset($_GET['view_categories'])){
                include('view_categories.php');
            }
            if(isset($_GET['view_brands'])){
                include('view_brands.php');
            }
            if(isset($_GET['edit_category'])){
                include('edit_category.php');
            }
            if(isset($_GET['edit_brands'])){
                include('edit_brands.php');
            }
            if(isset($_GET['delete_category'])){
                include('delete_category.php');
            }
            if(isset($_GET['delete_brands'])){
                include('delete_brands.php');
            }
            if(isset($_GET['list_orders'])){
                include('list_orders.php');
            }
            if(isset($_GET['delete_orders'])){
                include('delete_orders.php');
            }
            if(isset($_GET['list_payments'])){
                include('list_payments.php');
            }
            if(isset($_GET['delete_payments'])){
                include('delete_payments.php');
            }
            if(isset($_GET['list_users'])){
                include('list_users.php');
            }
            ?>
        </div>

        <!-- last child -->
        <!-- <div class="bg-info p-3 text-center footer">
            <p>All rights reserved © Designed by Group-2 2024</p>
        </div> -->
        <?php include("../includes/footer.php") ?>
    </div>


    <!-- boostrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>