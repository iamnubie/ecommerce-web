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
      <form action="" method="post">
        <table class="table table-bordered text-center">
            
                <!-- code php show du lieu dong -->
                 <?php
                   $get_ip_add = getIPAddress();
                   $total_price=0;
                   $cart_query="SELECT * FROM `cart_details` where ip_address='$get_ip_add'";
                   $result=mysqli_query($con,$cart_query);
                   $result_count=mysqli_num_rows($result);
                   if($result_count>0){
                    echo "<thead>
                              <tr>
                                  <th>Tên Sản Phẩm</th>
                                  <th>Ảnh Sản Phẩm</th>
                                  <th>Số Lượng</th>
                                  <th>Đơn Giá</th>
                                  <th>Loại Bỏ</th>
                                  <th colspan='2'>Tương Tác</th>
                              </tr>
                          </thead>
                          <tbody>";

                   while($row=mysqli_fetch_array($result)){
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
                    <td><input type="text" name="qty" class="form-input w-50"></td>
                    <?php
                      $get_ip_add = getIPAddress();
                      if(isset($_POST['update_cart'])){
                        $quantities=$_POST['qty'];
                        $update_cart="UPDATE `cart_details` SET quantity=$quantities where 
                        ip_address='$get_ip_add'";
                        $result_products_quantity=mysqli_query($con,$update_cart);
                        $total_price=$total_price*$quantities;
                      }

                    ?>
                    <td><?php echo $price_table ?><sup>đ</sup>/-</td>
                    <td><input type="checkbox" name="removeitem[]" 
                    value="<?php echo $product_id?>"></td>
                    <td>
                        <!-- <button class="bg-info px-3 py-2 border-0 mx-3">Cập Nhật</button> -->
                        <input type="submit" value="Cập Nhật" 
                        class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                        <!-- <button class="bg-info px-3 py-2 border-0 mx-3">Xóa</button> -->
                        <input type="submit" value="Xóa" 
                        class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">
                    </td>
                </tr>

                <?php }}}
                else{
                  echo "<h2 class='text-center text-danger'>Giỏ hàng của bạn đang trống.</h2>";
                }
                ?>
            </tbody>
        </table>
        <!-- subtotal -->
        <div class="d-flex mb-4">
          <?php
          $get_ip_add = getIPAddress();
          $cart_query="SELECT * FROM `cart_details` where ip_address='$get_ip_add'";
          $result=mysqli_query($con,$cart_query);
          $result_count=mysqli_num_rows($result);
          if($result_count>0){
            echo "            
            <h4 class='px-3'>Tổng Thu: <strong 
              class='text-info'>" . number_format($total_price, 0, ',', '.') . "
            <sup>đ</sup>/-</strong></h4>
            <input type='submit' value='Tiếp tục mua hàng' 
              class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
            <button class='bg-secondary p-3 py-2 border-0'>
              <a href='checkout.php' class='text-light text-decoration-none'>Thanh toán</a></button>";
          }else{
            echo " 
            <input type='submit' value='Tiếp tục mua hàng' 
              class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>";
          }
          if(isset($_POST['continue_shopping'])){
            echo "<script>window.open('index.php','_self')</script>";
          }
          ?>
        </div>
    </div>
</div>
</form>

<!-- function xoa san pham -->
 <?php
  function remove_cart_item(){
    global $con;
    if(isset($_POST['remove_cart'])){
      foreach($_POST['removeitem'] as $remove_id){
        echo $remove_id;
        $delete_query="DELETE FROM `cart_details` where product_id=$remove_id";
        $run_detele=mysqli_query($con,$delete_query);
        if($run_detele){
          echo "<script>window.open('cart.php','_self')</script>";
        }
      }
    }
  }
  echo $remove_item=remove_cart_item();
 ?>

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