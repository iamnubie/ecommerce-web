<h3 class="text-center text-success">TẤT CẢ ĐƠN HÀNG</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
        // Truy vấn lấy thông tin từ cả hai bảng user_orders và customer_orders
        $get_orders = "
            SELECT order_id, amount_due AS total_price, invoice_number, total_products, order_date, order_status 
            FROM `user_orders`
            UNION
            SELECT order_id, total_price, invoice_number, total_products, order_date, order_status 
            FROM `customer_orders`
            ORDER BY order_date DESC
        ";
        $result = mysqli_query($con, $get_orders);
        $row_count = mysqli_num_rows($result);

        if($row_count == 0){
            echo "<h2 class='text-danger text-center mt-5'>Chưa có đơn hàng</h2>";
        }else{
            echo "
        <tr class='text-center'>
            <th>Thứ Tự</th>
            <th>Đơn Giá</th>
            <th>Số Hóa Đơn</th>
            <th>Tổng Sản Phẩm</th>
            <th>Ngày Đặt</th>
            <th>Trạng Thái</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody class='bg-secondary text-light'>";
            $number = 0;
            while($row_data = mysqli_fetch_assoc($result)){
                $order_id = $row_data['order_id'];
                $total_price = $row_data['total_price'];
                $invoice_number = $row_data['invoice_number'];
                $total_products = $row_data['total_products'];
                $order_date = $row_data['order_date'];
                $order_status = $row_data['order_status'];
                $number++;
                echo "
                <tr>
                <td class='text-center'>$number</td>
                <td>$total_price</td>
                <td>$invoice_number</td>
                <td class='text-center'>$total_products</td>
                <td>$order_date</td>
                <td>$order_status</td>
                <td class='text-center'>
                <a href='index.php?delete_orders=$order_id' class='text-light'>
        <i class='fa-solid fa-trash'></i>
        </a>
        </td>
        </tr>";
        }
        }
        ?>
        </tbody>
</table>