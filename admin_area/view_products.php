<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 class="text-center text-success">Tất Cả Sản Phẩm</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr class="text-center">
                <th>Mã Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Ảnh Sản Phẩm</th>
                <th>Giá Sản Phẩm</th>
                <th>Đã Bán</th>
                <th>Trạng Thái</th>
                <th>Chỉnh Sửa</th>
                <th>Ẩn</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
    $get_products="SELECT * from `products`";
    $result=mysqli_query($con,$get_products);
    $number=0;
    while($row=mysqli_fetch_assoc($result)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $status=$row['status'];
        $number++;
    ?>
            <tr class='text-center'>
                <td><?php echo $number;?></td>
                <td><?php echo $product_title; ?></td>
                <td><img src='./product_images/<?php echo $product_image1;?>' class='product_img' /></td>
                <td><?php echo $product_price;?></td>
                <td><?php
            $get_count="Select * from `orders_pending` where product_id=$product_id";
            $result_count=mysqli_query($con,$get_count);
            $rows_count=mysqli_num_rows($result_count);
            echo $rows_count;
        ?></td>
                <td><?php echo $status;?></td>
                <td><a href='index.php?edit_products=<?php echo $product_id ?>' class='text-light'>
                        <i class='fa-solid fa-pen-to-square'></i>
                    </a>
                </td>
                <td>
                    <a href='index.php?hide_product=<?php echo $product_id ?>' class='text-light'>
                        <?php if($status == 'false'): ?>
                        <i class='fa-solid fa-eye-slash'></i>
                        <?php else: ?>
                        <i class='fa-solid fa-eye'></i>
                        <?php endif; ?>
                    </a>
                </td>
            </tr>
            <?php
    }
    ?>
        </tbody>

    </table>
</body>

</html>