<?php
include("class/product_class.php");
$product = new product;

// Kiểm tra xem product_id có được truyền từ URL hay không
if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    
    // Gọi hàm get_product_description từ class product
    $get_product_description = $product->get_product_description($product_id);

    // Kiểm tra xem có dữ liệu trả về không
    if ($get_product_description->num_rows > 0) {
        // Xuất dữ liệu của mỗi hàng
        while($row = $get_product_description->fetch_assoc()) {
            echo $row["product_desc"];
        }
    } else {
        echo "Không tìm thấy sản phẩm";
    }
} else {
    echo "Không có mã sản phẩm được chỉ định";
}
?>
