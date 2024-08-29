<h3 class="text-center text-success">TẤT CẢ THANH TOÁN</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
        // Truy vấn lấy thông tin từ bảng user_payments và customer_orders
        $get_payments = "
            SELECT payment_id, order_id, amount, invoice_number, payment_mode, date 
            FROM `user_payments`
            UNION
            SELECT order_id AS payment_id, order_id, total_price AS amount, invoice_number, 'Tiền mặt' AS payment_mode, order_date AS date 
            FROM `customer_orders`
            ORDER BY date DESC
        ";
        $result = mysqli_query($con, $get_payments);
        $row_count = mysqli_num_rows($result);

        if($row_count == 0){
            echo "<h2 class='text-danger text-center mt-5'>Chưa nhận thanh toán nào</h2>";
        } else {
            echo "
        <tr class='text-center'>
            <th>Thứ Tự</th>
            <th>Số Hóa Đơn</th>
            <th>Đơn Giá</th>
            <th>Hình Thức Thanh Toán</th>
            <th>Ngày Đặt</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody class='bg-secondary text-light'>";
            $number = 0;
            while($row_data = mysqli_fetch_assoc($result)) {
                $payment_id = $row_data['payment_id'];
                $invoice_number = $row_data['invoice_number'];
                $amount = $row_data['amount'];
                $payment_mode = $row_data['payment_mode'];
                $date = $row_data['date'];
                $number++;
                echo "
                <tr>
                <td class='text-center'>$number</td>
                <td>$invoice_number</td>
                <td>$amount</td>
                <td>$payment_mode</td>
                <td>$date</td>
                <td class='text-center'>
                <a href='index.php?delete_payments=$payment_id' class='text-light'>
        <i class='fa-solid fa-trash'></i>
        </a>
        </td>
        </tr>";
            }
        }
        ?>
        </tbody>
</table>