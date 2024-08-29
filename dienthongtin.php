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
    <link rel="stylesheet" href="css/dienthongtin.css">
    <style>
    /* CSS cho phần xác nhận đơn hàng */
    .order-confirmation {
        background-color: #f9f9f9;
        /* Màu nền sáng */
        border: 1px solid #ccc;
        /* Đường viền mờ */
        border-radius: 8px;
        /* Bo góc */
        padding: 20px;
        /* Khoảng cách bên trong */
        margin: 20px auto;
        /* Khoảng cách bên ngoài */
        max-width: 500px;
        /* Chiều rộng tối đa */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        /* Bóng đổ nhẹ */

    }

    .order-confirmation h2 {
        text-align: center;
        /* Căn giữa tiêu đề */
        color: #333;
        /* Màu chữ tiêu đề */
    }

    .order-confirmation p {
        font-size: 16px;
        /* Kích thước chữ */
        line-height: 1.6;
        /* Khoảng cách giữa các dòng */
        margin: 10px 0;
        /* Khoảng cách giữa các đoạn */
        text-align: left !important;
        /* Căn trái nội dung */
    }

    .order-confirmation strong {
        color: #007bff;
        /* Màu chữ nổi bật */
    }

    span {
        width: 40%;
        float: left;
        /* padding-right: 40px; */
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

    .container {
        margin: 130px auto 20px;
        /* Thêm khoảng cách trên để tránh việc bị navbar che khuất */
        max-width: 85%;
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .container2 {
        margin: 30px auto 20px;
        max-width: 85%;
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    <div class="container2">
        <div class="box">
            <div class="header">
                <h2>Điền Thông Tin Khách Hàng</h2>
            </div>
            <form action="" method="post">
                <!-- Name field -->
                <div class="form-group">
                    <label for="customer_name" class="form-label">Họ Tên</label>
                    <input type="text" id="customer_name" placeholder="Nhập họ tên của bạn" autocomplete="off"
                        required="required" name="customer_name" />
                </div>

                <!-- Email field -->
                <div class="form-group">
                    <label for="customer_email" class="form-label">Email</label>
                    <input type="email" id="customer_email" placeholder="Nhập email của bạn" autocomplete="off"
                        required="required" name="customer_email" />
                </div>

                <!-- Phone Number field -->
                <div class="form-group">
                    <label for="customer_phone" class="form-label">Số Điện Thoại</label>
                    <input type="number" id="customer_phone" placeholder="Nhập số điện thoại của bạn" autocomplete="off"
                        required="required" name="customer_phone" pattern="^0[0-9]{9,}$"
                        title="Số điện thoại phải bắt đầu bằng 0 và có ít nhất 10 chữ số." />
                </div>

                <!-- Address field -->
                <!-- Address field -->
                <div class="form-group">
                    <label for="customer_address" class="form-label">Địa Chỉ</label>
                    <input type="text" id="customer_address" placeholder="Nhập địa chỉ của bạn" autocomplete="off"
                        required="required" name="customer_address" minlength="5"
                        title="Địa chỉ phải có ít nhất 5 ký tự." />
                </div>


                <div class="form-group">
                    <input type="submit" value="Xác Nhận Thông Tin" name="submit_customer_info">
                </div>
            </form>
        </div>
    </div>
    <div class="container2">
        <?php
        if (isset($_POST['submit_customer_info'])) {
            // Lấy thông tin từ form
            $customer_name = $_POST['customer_name'];
            $customer_email = $_POST['customer_email'];
            $customer_phone = $_POST['customer_phone'];
            $customer_address = $_POST['customer_address'];

            // Lấy địa chỉ IP
            $get_ip_address = getIPAddress();
            $total_price = 0;

            // Lấy thông tin giỏ hàng
            $cart_query_price = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
            $result_cart_price = mysqli_query($con, $cart_query_price);
            $invoice_number = mt_rand(); // Số hóa đơn ngẫu nhiên
            $status = 'pending'; // Trạng thái đơn hàng
            $count_products = mysqli_num_rows($result_cart_price);

            // Tính tổng giá trị sản phẩm trong giỏ hàng
            while ($row_price = mysqli_fetch_array($result_cart_price)) {
                $product_id = $row_price['product_id'];
                $select_product = "SELECT * FROM `products` WHERE product_id='$product_id'";
                $run_price = mysqli_query($con, $select_product);

                while ($row_product_price = mysqli_fetch_array($run_price)) {
                    $product_price = array($row_product_price['product_price']);
                    $product_values = array_sum($product_price);
                    $total_price += $product_values * $row_price['quantity'];
                }
            }

            // Insert thông tin vào customer_orders
            $insert_orders = "INSERT INTO `customer_orders` (customer_name, customer_email, customer_phone, customer_address, total_products, invoice_number, order_date, total_price, order_status) 
                      VALUES ('$customer_name', '$customer_email', '$customer_phone', '$customer_address', $count_products, $invoice_number, NOW(), $total_price, '$status')";

            $result_query = mysqli_query($con, $insert_orders);
            $order_id = mysqli_insert_id($con); // Lấy ID của đơn hàng vừa tạo

            // Thêm vào orders_pending từng sản phẩm một
            foreach ($result_cart_price as $cart_item) {
                $product_id = $cart_item['product_id'];
                $quantity = $cart_item['quantity'];
                $insert_pending_orders = "INSERT INTO `orders_pending` (order_id, product_id, quantity, invoice_number, order_status)
                                  VALUES ($order_id, $product_id, $quantity, $invoice_number, '$status')";
                mysqli_query($con, $insert_pending_orders);
            }

            // Xóa sản phẩm khỏi giỏ hàng
            $empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
            mysqli_query($con, $empty_cart);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            // In ra thông tin đơn hàng
            echo "<div class='order-confirmation'>
                    <h2>Xác nhận thông tin đơn hàng</h2>
                    <p><span>Họ tên: </span><strong>$customer_name</strong></p>
                    <p><span>Email: </span><strong>$customer_email</strong></p>
                    <p><span>Số điện thoại: </span><strong>$customer_phone</strong></p>
                    <p><span>Địa chỉ: </span><strong>$customer_address</strong></p>
                    <p><span>Số hóa đơn: </span><strong>$invoice_number</strong></p>
                    <p><span>Ngày đặt hàng: </span><strong>" . date('d-m-Y H:i:s') . "</strong></p>
                    <p><span>Tổng giá trị đơn hàng: </span><strong>" . number_format($total_price, 0, ',', '.') . "<sup>đ</sup></strong></p>
                  </div>";
        }
        ?>
    </div>
</body>

</html>