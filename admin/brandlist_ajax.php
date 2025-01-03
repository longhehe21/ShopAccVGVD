<?php
include("class/brand_class.php");

$brand = new Brand;

if(isset($_GET['cartegory_id'])) {
    $cartegory_id = $_GET['cartegory_id'];
    if ($cartegory_id == "#") {
        // Trường hợp chọn "--Tất Cả--", lấy tất cả các loại sản phẩm từ tất cả các danh mục
        $brands = $brand->show_brand();
    } else {
        // Trường hợp chọn danh mục cụ thể, lấy các loại sản phẩm thuộc danh mục được chọn
        $brands = $brand->show_brand_ajax($cartegory_id);
    }
    if($brands) {
        $output = '
        <tr>
            <th>Stt</th>
            <th>Id</th>
            <th>Danh Mục</th>
            <th>Loại Sản Phẩm</th>
            <th>Tùy Biến</th>
        </tr>
    ';
    echo $output;
        $i = 0;
        while($row = $brands->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $row["brand_id"] ?></td>
                <?php 
                    // Kiểm tra xem "cartegory_name" có tồn tại trong mảng $row không
                    if (array_key_exists('cartegory_name', $row)) {
                ?>
                <td><?php echo $row["cartegory_name"] ?></td>
                <?php } else { ?>
                <td>Không có danh mục</td>
                <?php } ?>
                <td><?php echo $row["brand_name"] ?></td>
                <td>
                    <a href="brandedit.php?brand_id=<?php echo $row["brand_id"] ?>">Sửa</a>
                    |
                    <a href="branddelete.php?brand_id=<?php echo $row["brand_id"] ?>">Xóa</a>
                </td>
            </tr>
            <?php
        }
       
    } else {
        echo "<tr><td colspan='5'>Không có loại sản phẩm nào được tìm thấy.</td></tr>";
    }
}
?>
