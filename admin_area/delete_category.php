<?php
$message = "";
if(isset($_GET['delete_category'])){
    $delete_category = $_GET['delete_category'];
    
    // Kiểm tra xem mục hàng có sản phẩm nào không
    $check_query = "SELECT COUNT(*) as product_count FROM `products` WHERE category_id = $delete_category";
    $check_result = mysqli_query($con, $check_query);
    $row = mysqli_fetch_assoc($check_result);
    
    if($row['product_count'] > 0){
        // Nếu có sản phẩm thì không xóa được
        $message = "Mục hàng này đang có sản phẩm, không thể xóa";
    } else {
        // Nếu không có sản phẩm thì tiến hành xóa mục hàng
        $delete_query = "DELETE FROM `categories` WHERE category_id = $delete_category";
        $result = mysqli_query($con, $delete_query);
        if($result){
            $message = "Đã xóa thành công mục hàng";
        }
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

<body>
    <!-- Modal -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <button class="close">&times;</button>
            <p><?php echo $message; ?></p>
            <div class="modal-footer">
                <button id="closeBtn">Đóng</button>
            </div>
        </div>
    </div>


    <!-- Script để hiển thị modal -->
    <script>
    var modal = document.getElementById("messageModal");
    var closeBtn = document.getElementsByClassName("close")[0];
    var footerCloseBtn = document.getElementById("closeBtn");

    // Hiển thị modal nếu có message
    <?php if(!empty($message)): ?>
    modal.style.display = "block";
    <?php endif; ?>

    // Khi người dùng click vào dấu X, đóng modal
    closeBtn.onclick = function() {
        modal.style.display = "none";
        window.location.href = './index.php?view_categories';
    }

    // Khi người dùng click vào nút Đóng trong footer, đóng modal
    footerCloseBtn.onclick = function() {
        modal.style.display = "none";
        window.location.href = './index.php?view_categories';
    }

    // Khi người dùng click ra ngoài modal, đóng modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            window.location.href = './index.php?view_categories';
        }
    }
    </script>
</body>