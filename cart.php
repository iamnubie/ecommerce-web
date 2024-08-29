<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();

// Cập nhật giỏ hàng
function update_cart() {
    global $con;
    $get_ip_add = getIPAddress();

    if (isset($_POST['update_cart'])) {
        foreach ($_POST['qty'] as $product_id => $quantity) {
            if ($quantity > 0) {
                $update_cart = "UPDATE `cart_details` SET quantity='$quantity' WHERE product_id='$product_id' AND ip_address='$get_ip_add'";
                mysqli_query($con, $update_cart);
            }
        }
        // echo "<script>alert('Giỏ hàng đã được cập nhật!');</script>";
        echo "<script>window.location='cart.php';</script>";
    }

    if (isset($_POST['removeitem'])) {
        foreach ($_POST['removeitem'] as $remove_id) {
            $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id AND ip_address='$get_ip_add'";
            mysqli_query($con, $delete_query);
        }
        // echo "<script>alert('Sản phẩm đã được xóa khỏi giỏ hàng!');</script>";
        echo "<script>window.location='cart.php';</script>";
    }

    // Điều hướng về trang index.php khi nhấn nút "Tiếp tục mua hàng"
    if (isset($_POST['continue_shopping'])) {
        echo "<script>window.location='index.php';</script>";
    }
}

update_cart();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web thương mại - giỏ hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
    }

    .navbar {
        background-color: #17a2b8;
        padding: 10px;
        display: flex;
        align-items: center;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
    }

    .navbar a {
        color: white;
        text-decoration: none;
        margin: 0 15px;
    }

    .navbar a:hover {
        color: yellow;
    }

    .container {
        margin: 130px auto 20px;
        /* Thêm khoảng cách trên để tránh việc bị navbar che khuất */
        max-width: 85%;
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }


    h3,
    p {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 10px;
        border: 1px solid #dee2e6;
        text-align: center;
    }

    th {
        background-color: #17a2b8;
        color: white;
    }

    .cart_img {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }

    .btn {

        background-color: #17a2b8;
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 17px;
        margin: 3px;
    }

    a:-webkit-any-link {
        cursor: pointer;
        text-decoration: none;
    }

    .btn:hover {
        background-color: darkblue;
        color: white;
    }

    .bg-danger {
        background-color: #dc3545;
    }

    .bg-danger:hover {
        background-color: #c82333;
    }

    .text-info {
        color: orangered;
    }

    h4 {
        font-size: 20px;
    }
    </style>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar">
        <img src="./images/ML.jpg" alt="Logo" class="logo" style="width: 7%;">
        <a href="index.php">Trang chủ</a>
        <a href="display_all.php">Sản phẩm</a>
        <a href="./users_area/user_register.php">Đăng ký</a>
        <a href="#">Liên hệ</a>
        <a href="cart.php"><i class="fa-solid fa-cart-plus"></i><sup><?php cart_item(); ?></sup></a>
        <?php if (!isset($_SESSION['username'])) { ?>
        <a href="./users_area/user_login.php">Đăng Nhập</a>
        <?php } else { ?>
        <a href="./users_area/logout.php">Đăng Xuất</a>
        <?php } ?>
    </nav>

    <div class="container">

        <!-- giỏ hàng -->
        <form action="" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        <th>Ảnh Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Đơn Giá</th>
                        <th>Cập Nhật</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_ip_add = getIPAddress();
                    $total_price = 0;
                    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
                    $result = mysqli_query($con, $cart_query);
                    $result_count = mysqli_num_rows($result);
                    
                    if ($result_count > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                            $result_products = mysqli_query($con, $select_products);
                            while ($row_product_price = mysqli_fetch_array($result_products)) {
                                $product_price = $row_product_price['product_price'];
                                $product_title = $row_product_price['product_title'];
                                $product_image1 = $row_product_price['product_image1'];
                                $quantity = $row['quantity'];
                                $subtotal = $product_price * $quantity;
                                $total_price += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo $product_title ?></td>
                        <td><img src="./admin_area/product_images/<?php echo $product_image1 ?>" alt=""
                                class="cart_img"></td>
                        <td><input type="number" name="qty[<?php echo $product_id; ?>]" class="form-input w-50"
                                value="<?php echo $quantity; ?>" min="1" step="1"></td>
                        <td><?php echo number_format($product_price, 0, ',', '.'); ?><sup>đ</sup></td>
                        <td>
                            <input type="submit" value="Cập Nhật" class="btn" name="update_cart">
                        </td>
                        <td>
                            <button type="submit" name="removeitem[]" value="<?php echo $product_id?>"
                                class="bg-danger btn">Xóa</button>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-danger'>Giỏ hàng của bạn đang trống.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- subtotal -->
            <div class="d-flex mb-4">
                <?php
                if ($result_count > 0) {
                    echo "<h4 class='px-3'>Tổng Thu: <strong class='text-info'>" . number_format($total_price, 0, ',', '.') . "<sup>đ</sup></strong></h4>
                          <input type='submit' value='Tiếp tục mua hàng' class='btn' name='continue_shopping'>
                          <a href='./users_area/checkout.php' class='btn'>Thanh toán</a>";
                } else {
                    echo "<input type='submit' value='Tiếp tục mua hàng' class='btn' name='continue_shopping'>";
                }
                ?>
            </div>
        </form>
    </div>
</body>

</html>