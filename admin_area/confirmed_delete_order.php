<?php
include('../includes/connect.php');

if(isset($_GET['confirmed_delete_order'])){
    $order_id = $_GET['confirmed_delete_order'];
    
    // Xóa đơn hàng
    $delete_query = "DELETE FROM `user_orders` WHERE order_id = $order_id";
    $result = mysqli_query($con, $delete_query);
    if($result){
        echo "<script>window.open('./index.php?list_orders','_self')</script>";
    }
}
?>