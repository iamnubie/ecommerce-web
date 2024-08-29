<?php
$message = "";
$order_id = isset($_GET['delete_orders']) ? $_GET['delete_orders'] : null;

if($order_id){
    // Kiểm tra trạng thái đơn hàng
    $check_query = "SELECT order_status FROM `user_orders` WHERE order_id = $order_id";
    $check_result = mysqli_query($con, $check_query);
    $row = mysqli_fetch_assoc($check_result);
    
    if($row['order_status'] === 'pending'){
        // Nếu trạng thái là pending thì không xóa được
        $message = "Đơn hàng này đang ở trạng thái 'pending', không thể xóa";
    } elseif($row['order_status'] === 'Hoàn thành'){
        // Nếu trạng thái là hoàn thành, hiển thị modal để xác nhận xóa
        $message = "Đơn hàng này đã hoàn thành. Bạn có chắc chắn muốn xóa?";
    }
}
?>
<style>
/* CSS cho modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border-radius: 8px;
    /* Làm tròn các góc modal */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    /* Thêm bóng đổ cho modal */
    width: 80%;
    max-width: 500px;
    position: relative;
    font-family: 'Arial', sans-serif;
    /* Đặt font chữ cho modal */
    color: #333;
    /* Màu chữ mặc định */
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    color: #333;
    font-size: 24px;
    font-weight: bold;
    border: none;
    background: none;
    cursor: pointer;
    transition: color 0.3s ease;
    /* Thêm hiệu ứng chuyển màu */
}

.close:hover,
.close:focus {
    color: red;
    text-decoration: none;
}

#closeBtn {
    background-color: #007BFF;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-weight: bold;
    /* Chữ đậm cho nút Đóng */
    border-radius: 4px;
    /* Làm tròn góc nút Đóng */
    transition: background-color 0.3s ease;
    /* Thêm hiệu ứng chuyển màu */
}

#closeBtn:hover {
    background-color: #0056b3;
}

#confirmDelete {
    background-color: red;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-weight: bold;
    /* Chữ đậm cho nút Đóng */
    border-radius: 4px;
    /* Làm tròn góc nút Đóng */
    transition: background-color 0.3s ease;
    /* Thêm hiệu ứng chuyển màu */
}

#confirmDelete:hover {
    background-color: darkred;
}

.modal-footer {
    text-align: right;
    margin-top: 20px;
    /* Khoảng cách giữa footer và nội dung */
}

.modal-content p {
    font-size: 24px;
    /* Kích thước chữ của nội dung */
    font-weight: bold;
    /* Chữ đậm cho thông báo */
    text-align: center;
}
</style>
</head>

<body>
    <!-- Modal -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p><?php echo $message; ?></p>
            <div class="modal-footer">
                <?php if($row['order_status'] === 'Hoàn thành'): ?>
                <button id="confirmDelete" class="confirm-delete">Xóa</button>
                <?php endif; ?>
                <button id="closeBtn">Hủy</button>
            </div>
        </div>
    </div>

    <!-- Script để hiển thị modal -->
    <script>
    var modal = document.getElementById("messageModal");
    var closeBtn = document.getElementsByClassName("close")[0];
    var footerCloseBtn = document.getElementById("closeBtn");
    var confirmDeleteBtn = document.getElementById("confirmDelete");

    // Hiển thị modal nếu có message
    <?php if(!empty($message)): ?>
    modal.style.display = "block";
    <?php endif; ?>

    // Khi người dùng click vào dấu X hoặc nút Đóng, đóng modal
    closeBtn.onclick = footerCloseBtn.onclick = function() {
        modal.style.display = "none";
        window.location.href = './index.php?list_orders';
    }

    // Khi người dùng click vào nút Xóa, tiến hành xóa order
    confirmDeleteBtn.onclick = function() {
        window.location.href = './confirmed_delete_order.php?confirmed_delete_order=<?php echo $order_id; ?>';
    }

    // Khi người dùng click ra ngoài modal, đóng modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            window.location.href = './index.php?list_orders';
        }
    }
    </script>
</body>