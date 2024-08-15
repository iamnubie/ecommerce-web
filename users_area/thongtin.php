<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Khách Hàng</title>
    <link rel="stylesheet" href="../css/thongtin.css">
    <style>
    body {
        background: white;
    }
    </style>
</head>

<body>
    <div class="container">
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
                <input type="tel" id="customer_phone" placeholder="Nhập số điện thoại của bạn" autocomplete="off"
                    required="required" name="customer_phone" />
            </div>

            <!-- Address field -->
            <div class="form-group">
                <label for="customer_address" class="form-label">Địa Chỉ</label>
                <input type="text" id="customer_address" placeholder="Nhập địa chỉ của bạn" autocomplete="off"
                    required="required" name="customer_address" />
            </div>

            <div class="form-group">
                <input type="submit" value="Xác Nhận Thông Tin" name="submit_customer_info">
            </div>
        </form>
    </div>
</body>

</html>

<?php
if(isset($_POST['submit_customer_info'])) {
    // Lấy thông tin từ form
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_phone = $_POST['customer_phone'];
    $customer_address = $_POST['customer_address'];

    // Giả định bạn đã có user_id từ session hoặc query string
    $user_id = $_GET['user_id']; // Hoặc lấy từ session nếu cần

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
    while($row_price = mysqli_fetch_array($result_cart_price)){
        $product_id = $row_price['product_id'];
        $select_product = "SELECT * FROM `products` WHERE product_id='$product_id'";
        $run_price = mysqli_query($con, $select_product);
        while($row_product_price = mysqli_fetch_array($run_price)){
            $product_price = array($row_product_price['product_price']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }

    // Lấy số lượng sản phẩm từ giỏ hàng
    $get_cart = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
    $run_cart = mysqli_query($con, $get_cart);
    $quantity = 0;

    while($row_cart = mysqli_fetch_array($run_cart)){
        $quantity += $row_cart['quantity']; // Tính tổng số lượng sản phẩm
    }

    // Thêm đơn hàng vào bảng customer_order
    $insert_orders = "INSERT INTO `customer_order` (user_id, customer_name, customer_email, customer_phone, customer_address, amount_due, invoice_number, total_products, order_date, order_status) 
                      VALUES ('$user_id', '$customer_name', '$customer_email', '$customer_phone', '$customer_address', '$total_price', '$invoice_number', '$quantity', NOW(), '$status')";
    $result_query = mysqli_query($con, $insert_orders);

    if ($result_query) {
        // Thêm chi tiết đơn hàng vào bảng orders_pending
        while($row_cart = mysqli_fetch_array($result_cart_price)){
            $product_id = $row_cart['product_id'];
            $quantity = $row_cart['quantity'];

            $insert_pending_orders = "INSERT INTO `orders_pending` (user_id, invoice_number, product_id, quantity, order_status) 
                                       VALUES ('$user_id', '$invoice_number', '$product_id', '$quantity', '$status')";
            mysqli_query($con, $insert_pending_orders);
        }

        // Xóa sản phẩm khỏi giỏ hàng
        $empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
        mysqli_query($con, $empty_cart);

        echo "<script>alert('Đơn hàng đã được xử lý.')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    } else {
        echo "<script>alert('Đã có lỗi xảy ra trong quá trình xử lý đơn hàng.')</script>";
    }
}
?>