<?php
include("header2.php");
include("class/product_class.php")
?>

<?php
// Kiểm tra xem 'cartegory_id' đã được truyền qua URL hay chưa
if(isset($_GET['cartegory_id'])) {
    // Lấy giá trị của 'cartegory_id' từ URL
    $cartegory_id = $_GET['cartegory_id'];

    // Sử dụng giá trị 'cartegory_id' tại đây để thực hiện bất kỳ hành động nào bạn cần
    echo "Cartegory ID: " . $cartegory_id;
} else {
    echo "Không có cartegory_id được truyền qua URL.";
}
?>
<?php
    $product = new product;
    $show_product = $product -> show_product($cartegory_id);
    $show_product_all = $product -> select_product_All($cartegory_id)
?>
<div class="app_container">
        <div class="grid wide">
            <div class="row">
                <div class="col l-2">
                    <nav class="category">
                        <h3 class="category__heading">
                            <i class="category__heading-icon fa-solid fa-list-ul"></i>
                            Bộ Lọc
                        </h3>
                        <ul class="category-list">
                        <li class="category-item category-item--active">
                                <a href="#" class="category-item__link">
                                    Tất Cả
                                </a>
                            </li>
                            <?php
                            if($show_product_all){
                                $i=0;
                                while($result = $show_product_all->fetch_assoc()){
                                    $i++;
                            ?>  
                            <li class="category-item">
                                <a href="#" class="category-item__link">
                                    <?php echo $result["brand_name"] ?>
                                </a>
                            </li>
                            <?php
                                }
                                }
                            ?>
                        </ul>
                    </nav>
                </div>
                <div class="col l-9">
                    <div class="home-filter">
                        <span class="home-filter-label">
                            Sắp xếp theo
                        </span> 
                        <div class="select-input">
                            <span class="select-input__lable">
                                Giá
                                <i class="select-input-icon fa-solid fa-chevron-down"></i>
                            </span>
                            <ul class="select-input-list">
                                <!-- select-input-list-item-link--active -->
                                <li class="select-input-list-item ">
                                    <a href="" class="select-input-list-item-link">
                                        Giá Thấp đến cao
                                    </a>
                                </li>
                                <li class="select-input-list-item">
                                    <a href="" class="select-input-list-item-link">
                                        Giá Cao đến thấp
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="home-product">
                        <!-- Grid -> Row -> Column -->
                        <div class="row ">
                            <!-- Product item -->
                            <?php
                    if($show_product){
                        $i=0;
                        while($result = $show_product->fetch_assoc()){
                            $i++;
                    ?>  
                            <div class="col l-3">
                                <a class="home-product-item" href="product-wechat.php">
                                    <div class="home-product-item__img" style="background-image: url(./admin/uploads/<?php echo $result["product_img"] ?>);"></div>
                                    <h4 class="home-product-item__name">
                                        <?php echo $result["product_name"] ?>
                                    </h4>
                                    <!-- <div class="home-product-item__detail">
                                        <p>Ngày Lập: 6/1/24</p>
                                        <p>Lượt quét: 0</p>
                                    </div>
                                    <div class="home-product-item__detail">
                                        <p>Số Tháng: 1</p>
                                        <p>Số Năm: 0</p>
                                    </div> -->
                                    <div class="home-product-item-price">
                                        <span class="home-product-item__price-old">
                                        <?php echo $result["product_price"] ?> <sup>đ</sup>
                                        </span>
                                        <span style="font-size: 20px;" class="home-product-item__price-current">
                                         <?php echo $result["product_price_new"] ?><sup>đ</sup>  
                                        </span>
                                    </div>
        
                                    <div class="home-product-item__origin">
                                        <span class="home-product-item__origin-name">
                                            DaDaShop.vn
                                        </span>
                                        <span class="home-product-item__origin__detail">
                                            Xem Thêm
                                        </span>
                                    </div>
                                    
                                    <div class="home-product-item__favourite">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Yêu thích</span>
                                    </div>
                                    <div class="home-product-item__sell-off">
                                        <span class="home-product-item__sell-off__percent">10%</span>
                                        <span class="home-product-item__sell-off__lable">GIẢM</span>
                                    </div>
                                </a>
                            </div>
                            <?php
                    }
                    }
                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include("footer.php");
?>