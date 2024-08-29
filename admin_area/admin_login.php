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
        <h2 class="text-center mb-5">Đăng Nhập Quản Trị</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/service-2.png" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-5">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Tên Đăng Nhập</label>
                        <input type="text" id="username" name="username" placeholder="Nhập tên" required="required"
                            class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu"
                            required="required" class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Đăng Nhập">
                        <p class="small fw-bold mt-2 pt-1">Bạn chưa có tài khoản ? <a href="admin_register.php"
                                class="link-danger">Đăng Ký</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
if(isset($_POST['admin_login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $select_query="SELECT * FROM `admin_table` where admin_name='$username'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);

    if($row_count>0){
        $_SESSION['admin_name']=$username;
        if(password_verify($password,$row_data['admin_password'])){
            echo "<script>window.open('index.php','_self')</script>";
        }else{
            echo "<script>alert('Thông tin đăng nhập không hợp lệ, vui lòng thử lại.')</script>";
        }
    }else{
        echo "<script>alert('Thông tin đăng nhập không hợp lệ, vui lòng thử lại.')</script>";
    }
}
?>