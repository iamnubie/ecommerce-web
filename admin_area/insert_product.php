<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])){
    $product_title=$_POST['product_title'];
    $description=$_POST['description'];
    $product_keywords=$_POST['product_keywords'];
    $product_category=$_POST['product_category'];
    $product_brands=$_POST['product_brands'];
    $product_price=$_POST['product_price'];
    $product_status='true';

    //accessing image
    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];

    //accessing image tmp name
    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];

    //checking emty condition
    if($product_title=='' or $description=='' or $product_keywords=='' or 
    $product_category=='' or $product_brands=='' or $product_price=='' or
    $product_image1=='' or $product_image2==''){
        echo "<script>alert('Vui lòng nhập đủ thông tin!')</script>";
        exit();
    }else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        move_uploaded_file($temp_image2,"./product_images/$product_image2");

        //insert query
        $insert_products="insert into `products` (product_title,product_description,
        product_keywords,category_id,brand_id,product_image1,product_image2,
        product_price,date,status) values ('$product_title','$description','$product_keywords',
        '$product_category','$product_brands','$product_image1','$product_image2','$product_price',
        NOW(),'$product_status')";
        $result_query=mysqli_query($con,$insert_products);
        if($result_query){
            echo "<script>alert('Đã thêm sản phẩm thành công!')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="../admin_area/css/insert_product.css">
</head>
<body>
    <div class="container">
        <h1>Thêm Sản Phẩm</h1>
        <form action="insert_product.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product-name">Tên sản phẩm</label>
                <input type="text" id="product-name" name="product-name" placeholder="Nhập tên sản phẩm">
            </div>
            <div class="form-group">
                <label for="product-desc">Mô tả sản phẩm</label>
                <input type="text" id="product-desc" name="product-desc" placeholder="Nhập mô tả sản phẩm">
            </div>
            <div class="form-group">
                <label for="product-keywords">Từ khóa sản phẩm</label>
                <input type="text" id="product-keywords" name="product-keywords" placeholder="Nhập từ khóa sản phẩm">
            </div>
            <div class="form-group">
                <label for="product-category">Chọn mục hàng</label>
                <select id="product-category" name="product-category">
                    <option value="">Chọn mục hàng</option>
                    <!-- Các mục hàng khác -->
                    <?php
                    $select_query = "SELECT * FROM `categories`";
                    $result_query = mysqli_query($con, $select_query);
                    while($row = mysqli_fetch_assoc($result_query)){
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="product-brand">Chọn thương hiệu</label>
                <select id="product-brand" name="product-brand">
                    <option value="">Chọn thương hiệu</option>
                    <!-- Các thương hiệu khác -->
                    <?php
                    $select_query = "SELECT * FROM `brands`";
                    $result_query = mysqli_query($con, $select_query);
                    while($row = mysqli_fetch_assoc($result_query)){
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="product-image1">Ảnh 1 sản phẩm</label>
                <input type="file" id="product-image1" name="product-image1">
            </div>
            <div class="form-group">
                <label for="product-image2">Ảnh 2 sản phẩm</label>
                <input type="file" id="product-image2" name="product-image2">
            </div>
            <div class="form-group">
                <label for="product-price">Giá sản phẩm</label>
                <input type="text" id="product-price" name="product-price" placeholder="Nhập giá sản phẩm">
            </div>
            <div class="form-group">
                <button type="submit">Thêm sản phẩm</button>
            </div>
        </form>
    </div>
</body>
</html>
