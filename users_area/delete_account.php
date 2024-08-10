<h3 class="text-danger mb-4">Xóa Tài Khoản</h3>
<form action="" method="post" class="mt-5">
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="delete" value="Xóa tài khoản">
    </div>
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="dont_delete" value="Không xóa tài khoản">
    </div>
</form>

<?php
$username_session=$_SESSION['username'];
if(isset($_POST['delete'])){
    $delete_query="DELETE from `user_table` where username='$username_session'";
    $result=mysqli_query($con,$delete_query);
    if($result){
        session_destroy();
        echo "<script>alert('Đã xóa tài khoản thành công.')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}

if(isset($_POST['dont_delete'])){
    echo "<script>window.open('profile.php','_self')</script>";
}
?>