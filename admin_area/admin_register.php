<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký Admin</title>
    <!-- boostrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    body {
        overflow-x: hidden;
    }
    </style>
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Đăng Ký Quản Trị</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/service-3.png" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-5">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Tên Đăng Nhập</label>
                        <input type="text" id="username" name="username" placeholder="Nhập tên" required="required"
                            class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Nhập email" required="required"
                            class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu"
                            required="required" class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Xác Nhận Mật Khẩu</label>
                        <input type="password" id="confirm_password" name="confirm_password"
                            placeholder="Nhập lại mật khẩu" required="required" class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_register" value="Đăng Ký">
                        <p class="small fw-bold mt-2 pt-1">Bạn đã có tài khoản ? <a href="admin_login.php"
                                class="link-danger">Đăng Nhập</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<!-- php code -->
<?php
if(isset($_POST['admin_register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirm_password'];

    // Select query to check if username or email already exists
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$username' OR admin_email='$email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('Tên Đăng Nhập hoặc Email đã tồn tại.')</script>";
    } else if ($password != $confirm_password) {
        echo "<script>alert('Mật khẩu không khớp!')</script>";
    } else {
        // Insert new user data into the database
        $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password) 
                         VALUES ('$username', '$email', '$hash_password')";
        $sql_execute = mysqli_query($con, $insert_query);

    }
}
?>