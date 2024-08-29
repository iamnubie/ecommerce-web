<?php
if(isset($_GET['hide_product'])){
    $product_id = $_GET['hide_product'];

    // Lấy trạng thái hiện tại của sản phẩm
    $get_status = "SELECT status FROM `products` WHERE product_id = $product_id";
    $result_status = mysqli_query($con, $get_status);
    $row = mysqli_fetch_assoc($result_status);
    $current_status = $row['status'];

    // Đổi trạng thái
    if($current_status == 'false'){
        $new_status = 'true';
    } else {
        $new_status = 'false';
    }

    // Cập nhật trạng thái của sản phẩm
    $update_product = "UPDATE `products` SET status = '$new_status' WHERE product_id = $product_id";
    $result_product = mysqli_query($con, $update_product);
    if($result_product){
        echo "<script>alert('Trạng thái sản phẩm đã được cập nhật')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    }
}
?>