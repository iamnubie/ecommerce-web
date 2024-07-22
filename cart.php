<!-- connect file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web thương mại - giỏ hàng.</title>
    <!-- boostrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
     <!-- font awesome link -->
     <link rel="stylesheet" 
     href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
     integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
     crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <style>
    .cart_img {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }
    </style>
</head>
<body>
    <!-- navbar -->
     <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <img src="./images/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Sản phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Đăng ký</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Liên hệ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-plus"></i><sup>
            <?php cart_item();?>
          </sup></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- calling cart function -->
 <?php
  cart();
 ?>

<!-- second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<ul class="navbar-nav me-auto">
<li class="nav-item">
          <a class="nav-link" href="#">Chào Mừng Bạn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Đăng Nhập</a>
        </li>
</ul>
</nav>

<!-- third chile -->
<div class="bg-light my-3">
    <h3 class="text-center">Mong Linh Store</h3>
    <p class="text-center">Lắng Nghe - Kiên Trì - Đổi Mới</p>
</div>

<!-- fourth child table -->
<div class="container">
    <div class="row">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Ảnh Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Tổng Tiền</th>
                    <th>Loại Bỏ</th>
                    <th colspan="2">Tương Tác</th>
                </tr>
            </thead>
            <tbody>
                <!-- code php show du lieu dong -->
                 <?php
                   global $con;
                   $get_ip_add = getIPAddress();
                   $total_price=0;
                   $cart_query="SELECT * FROM `cart_details` where ip_address='$get_ip_add'";
                   $result_query=mysqli_query($con,$cart_query);
                   while($row=mysqli_fetch_array($result_query)){
                     $product_id=$row['product_id'];
                     $select_products="SELECT * FROM `products` where product_id='$product_id'";
                     $result_products=mysqli_query($con,$select_products);
                     while($row_product_price=mysqli_fetch_array($result_products)){
                       $product_price=array($row_product_price['product_price']);
                       $price_table=number_format($row_product_price['product_price'], 0, ',', '.');
                       $product_title=$row_product_price['product_title'];
                       $product_image1=$row_product_price['product_image1'];
                       $product_values=array_sum($product_price);
                       $total_price+=$product_values;

                 ?>
                <tr>
                    <td><?php echo $product_title ?></td>
                    <td><img src="./admin_area/product_images/<?php echo $product_image1 ?>" 
                    alt="" class="cart_img"></td>
                    <td><input type="text" class="form-input w-50"></td>
                    <td><?php echo $price_table ?><sup>đ</sup>/-</td>
                    <td><input type="checkbox"></td>
                    <td>
                        <button class="bg-info px-3 py-2 border-0 mx-3">Cập Nhật</button>
                        <button class="bg-info px-3 py-2 border-0 mx-3">Xóa</button>
                    </td>
                </tr>

                <?php }} ?>
                   
            </tbody>
        </table>
        <!-- subtotal -->
        <div class="d-flex mb-4">
            <h4 class="px-3">Tổng Thu: <strong 
            class="text-info"><?php echo number_format($total_price, 0, ',', '.')?><sup>đ</sup>/-</strong></h4>
            <a href="index.php"><button 
            class="bg-info px-3 py-2 border-0 mx-3">Tiếp tục mua hàng</button></a>
            <a href="#"><button 
            class="bg-secondary p-3 py-2 border-0 text-light">Thanh toán</button></a>
        </div>
    </div>
</div>

<!-- last child -->
<!-- include footer -->
 <?php include("./includes/footer.php") ?>
     </div>

<!-- boostrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>
</body>
</html>