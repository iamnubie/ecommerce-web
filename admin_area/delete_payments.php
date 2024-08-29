<?php
$message = "";
$delete_payment_id = 0;

if(isset($_GET['delete_payments'])){
    $delete_payment_id = $_GET['delete_payments'];
    
    // Kiểm tra nếu có yêu cầu xác nhận xóa
    if(isset($_POST['confirm_delete'])){
        $delete_query = "DELETE FROM `user_payments` WHERE payment_id = $delete_payment_id";
        $result = mysqli_query($con, $delete_query);
        if($result){
            $message = "Đã xóa thành công khoản thanh toán";
        } else {
            $message = "Có lỗi xảy ra, không thể xóa";
        }
    } else {
        // Hiển thị modal xác nhận xóa
        $message = "Bạn có chắc chắn muốn xóa khoản thanh toán này không?";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận xóa thanh toán</title>
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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        width: 80%;
        max-width: 500px;
        position: relative;
        font-family: 'Arial', sans-serif;
        color: #333;
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
        border-radius: 4px;
        transition: background-color 0.3s ease;
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
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    #confirmDelete:hover {
        background-color: darkred;
    }

    .modal-footer {
        text-align: right;
        margin-top: 20px;
    }

    .modal-content p {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
    }
    </style>
</head>

<body>
    <!-- Modal -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p><?php echo $message; ?></p>
            <?php if($message === "Bạn có chắc chắn muốn xóa khoản thanh toán này không?"): ?>
            <div class="modal-footer">
                <form method="POST" action="">
                    <button type="submit" id="confirmDelete" name="confirm_delete">Xóa</button>
                    <button type="button" id="closeBtn">Hủy</button>
                </form>
            </div>
            <?php else: ?>
            <div class="modal-footer">
                <button id="closeBtn">Đóng</button>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Script để hiển thị modal -->
    <script>
    var modal = document.getElementById("confirmationModal");
    var closeBtn = document.getElementsByClassName("close")[0];
    var footerCloseBtn = document.getElementById("closeBtn");

    // Hiển thị modal nếu có message
    <?php if(!empty($message)): ?>
    modal.style.display = "block";
    <?php endif; ?>

    // Khi người dùng click vào dấu X hoặc nút Đóng, đóng modal
    closeBtn.onclick = function() {
        modal.style.display = "none";
        window.location.href = './index.php?list_payments';
    }

    footerCloseBtn.onclick = function() {
        modal.style.display = "none";
        window.location.href = './index.php?list_payments';
    }
    </script>
</body>

</html>