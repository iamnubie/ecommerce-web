<?php
session_start();
session_unset(); 
session_destroy(); 

// Chuyển hướng về trang đăng nhập
header("Location: admin_login.php");
exit();
?>