<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Người Dùng</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
        height: 150vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        background-color: #fff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    .container h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ddd;
        outline: none;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        border-color: #9b59b6;
    }

    .form-group input[type="submit"] {
        background-color: #9b59b6;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .form-group input[type="submit"]:hover {
        background-color: #8e44ad;
    }

    .small-text {
        font-size: 12px;
        margin-top: 15px;
        color: #666;
    }

    .small-text a {
        color: #9b59b6;
        text-decoration: none;
        font-weight: 500;
    }

    .small-text a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Đăng Ký Tài Khoản</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="user_username">Tên Người Dùng</label>
                <input type="text" id="user_username" name="user_username" placeholder="Nhập tên của bạn" required>
            </div>
            <div class="form-group">
                <label for="user_email">Email</label>
                <input type="email" id="user_email" name="user_email" placeholder="Nhập email của bạn" required>
            </div>
            <div class="form-group">
                <label for="user_image">Ảnh Người Dùng</label>
                <input type="file" id="user_image" name="user_image" required>
            </div>
            <div class="form-group">
                <label for="user_password">Mật Khẩu</label>
                <input type="password" id="user_password" name="user_password" placeholder="Nhập mật khẩu của bạn"
                    required>
            </div>
            <div class="form-group">
                <label for="conf_user_password">Xác Nhận Lại Mật Khẩu</label>
                <input type="password" id="conf_user_password" name="conf_user_password"
                    placeholder="Nhập lại mật khẩu của bạn" required>
            </div>
            <div class="form-group">
                <label for="user_address">Địa Chỉ Người Dùng</label>
                <input type="text" id="user_address" name="user_address" placeholder="Nhập địa chỉ của bạn" required>
            </div>
            <div class="form-group">
                <label for="user_contact">Điện Thoại</label>
                <input type="text" id="user_contact" name="user_contact" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Đăng Ký" name="user_register">
            </div>
            <div class="small-text">
                <p>Đã có tài khoản? <a href="user_login.php">Đăng Nhập</a></p>
            </div>
        </form>
    </div>
</body>

</html>

<!-- php code -->
<?php
if(isset($_POST['user_register'])){
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    // Select query to check if username or email already exists
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('Tên Đăng Nhập hoặc Email đã tồn tại.')</script>";
    } else if ($user_password != $conf_user_password) {
        echo "<script>alert('Mật khẩu không khớp!')</script>";
    } else {
        // Insert new user data into the database
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) 
                         VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
        $sql_execute = mysqli_query($con, $insert_query);

        // Check for items in the cart associated with the user's IP
        $select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
        $result_cart = mysqli_query($con, $select_cart_items);
        $rows_count_cart = mysqli_num_rows($result_cart);

        if ($rows_count_cart > 0) {
            $_SESSION['username'] = $user_username;
            echo "<script>alert('Bạn đang có sản phẩm trong giỏ.')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        } else {
            echo "<script>window.open('../index.php','_self')</script>";
        }
    }
}
?>