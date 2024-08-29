<h3 class="text-center text-success">TẤT CẢ THƯƠNG HIỆU</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info text-center">
        <tr>
            <th>Thứ Tự</th>
            <th>Tên Thương Hiệu</th>
            <th>Chỉnh Sửa</th>
            <th>Xóa</th>

        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $select_cat="Select * from `brands`";
        $result=mysqli_query($con,$select_cat);
        $number=0;
        while($row=mysqli_fetch_assoc($result)){
            $brand_id=$row['brand_id'];
            $brand_title=$row['brand_title'];
            $number++;
        ?>
        <tr class="text-center">
            <td><?php echo $number; ?></td>
            <td><?php echo $brand_title; ?></td>
            <td>
                <a href='index.php?edit_brands=<?php echo $brand_id?>' class='text-light'>
                    <i class='fa-solid fa-pen-to-square'></i>
                </a>
            </td>
            <td>
                <a href='index.php?delete_brands=<?php echo $brand_id?>' class='text-light'>
                    <i class='fa-solid fa-trash'></i>
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>