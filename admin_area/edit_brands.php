<?php
if(isset($_GET['edit_brands'] )){
    $edit_brand=$_GET['edit_brands'];
    $get_brands="SELECT * from `brands` where brand_id=$edit_brand";
    $result=mysqli_query($con,$get_brands);
    $row=mysqli_fetch_assoc($result);
    $brand_title=$row['brand_title'];
}

if(isset($_POST['edit_brand'])){
    $brand_title=$_POST['brand_title'];
    
    $update_query="UPDATE `brands` set brand_title='$brand_title' where
    brand_id=$edit_brand";
    $result_brand=mysqli_query($con,$update_query);
    if($result_brand){
        echo "<script>alert('Thương hiệu đã được cập nhật thành công')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
    }
}
?>

<div class="container mt-3">
    <h1 class="text-center">CHỈNH SỬA THƯƠNG HIỆU</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label">Tên Thương Hiệu</label>
            <input type="text" name="brand_title" value="<?php echo $brand_title; ?>" id="brand_title"
                class="form-control" required="required">
        </div>
        <input type="submit" value="Update Brand" class="btn btn-info px-3 mb-3" name="edit_brand">
    </form>
</div>