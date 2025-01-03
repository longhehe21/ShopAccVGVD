<?php
include("header.php");
include("slider.php");
include("class/product_class.php");

$product = new product;

// Kiểm tra xem người dùng đã thực hiện tìm kiếm chưa
if(isset($_POST['search_product_id'])) {
    
    // Lấy mã sản phẩm cần tìm kiếm từ form
    $search_product_id = $_POST['search_product_id'];
    // Tìm kiếm thông tin sản phẩm theo mã sản phẩm
    $search_result = $product->get_product($search_product_id);
} else {
    // Nếu không có tìm kiếm, hiển thị tất cả sản phẩm
    if(isset($_POST['category_id']) && $_POST['category_id'] !== "") {
        // Nếu danh mục được chọn, lọc sản phẩm theo danh mục được chọn
        $category_id = $_POST['category_id'];
        $search_result = $product->select_product_by_category($category_id);
    }else {
        // Nếu không có danh mục được chọn, hiển thị tất cả sản phẩm
        $search_result = $product->select_product_All();
    }
}

// Lấy danh mục sản phẩm từ cơ sở dữ liệu
$categories = $product->show_cartegory();
$brands = $product->show_brand()
?>

<div class="admin-content-right">
    <div class="admin-content-right-product_list">
        <h1 class="product_list-app-title" >Danh Sách sản phẩm</h1>
        <div class="product_list-app">
            <!-- Form để nhập mã sản phẩm cần tìm kiếm -->
        <form class="product_list-app-search" method="post" action="">
            <label class="product_list-app-search-title" for="search_product_id">Nhập mã sản phẩm:</label>
            <input class="product_list-app-search-input" type="text" id="search_product_id" name="search_product_id" placeholder="Nhập mã sản phẩm...">
            <input class="product_list-app-search-btn" type="submit" name="search" value="Tìm kiếm">
        </form>
        <form method="post" class="product_list-app-filter" action="">
            <label class="product_list-app-filter-title" for="category_id">Lọc sản phẩm theo danh mục:</label>
            <select class="product_list-app-filter-select" id="category_id" name="category_id">
                <option class="product_list-app-filter-option" value="">--Tất cả--</option>
                <?php while($category = $categories->fetch_assoc()): ?>
                    <?php if(isset($_POST['category_id']) && $_POST['category_id'] == $category['cartegory_id']): ?>
                        <option value="<?php echo $category['cartegory_id']; ?>" selected><?php echo $category['cartegory_name']; ?></option>
                    <?php else: ?>
                        <option value="<?php echo $category['cartegory_id']; ?>"><?php echo $category['cartegory_name']; ?></option>
                    <?php endif; ?>
                <?php endwhile; ?>
            </select>
            <!-- <label for="brand_id">Chọn loại sản phẩm:</label>
            <select id="brand_id" name="brand_id">
                <option value="">Chọn loại sản phẩm</option> -->
            <input class="product_list-app-filter-btn" type="submit" name="search_category" value="Lọc">
        </form>
    </div>
    
<!-- Kết thúc form -->


        <?php
        // Kiểm tra xem có kết quả tìm kiếm hay không
        if($search_result) {
            ?>
            <table>
                <tr>
                    <th>Stt</th>
                    <th>Mã Sản Phẩm</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Danh Mục</th>
                    <th>Loại Sản Phẩm</th>
                    <th>Giá Sản Phẩm</th>
                    <th>Giá Sản Phẩm Sale</th>
                    <th>Ảnh Đại Diện</th>
                    <th>Ảnh Sản Phẩm</th>
                    <th>Mô Tả</th>
                    <th>Tùy Chọn</th>
                </tr>
                <?php
                $i = 0;
                while($result = $search_result -> fetch_assoc()) {
                    $i++;
                    ?>
                    <!-- Phần layout ảnh lớn hơn -->
                    <div id="largeImageContainer" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; z-index:9999;">
                        <!-- Div trong suốt bên ngoài layout -->
                        <div style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);" onclick="hideLargeImage()"></div>
                        <div id="largeImageContent" style="position:absolute; width: 1000px;top:50%; left:50%; transform:translate(-50%,-50%); text-align:center;">
                            <!-- Ảnh hiện tại -->
                            <img id="currentLargeImage" src="" style="max-width:90%; max-height:90%; margin-bottom:10px;">
                            <!-- Nút điều hướng -->
                            <button onclick="prevImage()" class="product-images-prev product-images-button">
                            <i class="product-images-icon fas fa-chevron-right"></i>
                            </button>
                            <button onclick="nextImage()" class="product-images-next product-images-button">
                            <i class="product-images-icon fas fa-chevron-left "></i>
                            </button>
                        </div>
                    </div>
                    <tr>
                        <td><?php echo $i?></td>
                        <td style="width:40px"><?php echo $result["product_id"] ?></td>
                        <td><?php echo $result["product_name"] ?></td>
                        <td><?php echo isset($result["cartegory_name"]) ? $result["cartegory_name"] : "Sản phẩm không tồn tại" ?></td>
                        <td><?php echo isset($result["brand_name"]) ? $result["brand_name"] : "Sản phẩm không tồn tại" ?></td>
                        <td><?php echo number_format($result["product_price"]) ?> <sup>đ</sup></td>
                        <td style="width:110px"><?php echo number_format($result["product_price_new"])?> <sup>đ</sup></td>
                        <td>
                            <!-- ảnh sản phẩm -->
                            <img class="product-image" style="width: 100px; cursor: pointer;" src="./uploads/<?php echo $result['product_img'] ?>" alt="">
                        </td>
                        <!-- ảnh mô tả sản phẩm -->
                        <td style="width:230px;" >
                            <?php $product_images = explode('#',$result['product_images']) ?>
                            <!-- Chỉ hiển thị ảnh đầu tiên của sản phẩm và thêm sự kiện click -->
                            <img class="product-description-image" style="width:100px; cursor:pointer;" src="<?php echo $product_images[0]; ?>" onclick="showLargeImage(<?php echo htmlentities(json_encode($product_images)); ?>)" alt="">
                        </td>
                        <!-- mô tả sản phẩm -->
                        <td class="product-desc" style="max-width:250px" data-product-id="
                        <?php echo $result["product_id"]; ?>">
                        <?php 
                        $product_desc = $result["product_desc"];
                            if (strlen($product_desc) > 200) {
                                $product_desc = substr($product_desc, 0, 200) . "...";
                            }
                            echo $product_desc;
                        ?>
                        </td>
                        <!-- sửa xóa -->
                        <td style="width:80px">
                            <a href="productdedit.php?product_id=<?php echo $result["product_id"] ?>">Sửa</a>
                            |
                            <a href="productdelete.php?product_id=<?php echo $result["product_id"] ?>">Xóa</a>
                        </td>
                        <!-- Modal mô tả sản phẩm -->
                    <div id="product-desc-Modal" class="modal">
                        <div class="product-desc-modal-content">
                            <span class="product-desc-close" onclick="product_desc_closeModal()">&times;</span>
                            <!-- Nội dung của sản phẩm -->
                            <div class="product_desc_modalContent" id="product_desc_modalContent"></div>
                            <!-- Thêm nội dung khác của sản phẩm nếu cần -->
                        </div>
                    </div>
                        <!-- Modal ảnh mô tả sản phẩm -->
                        <div id="productModal" class="modal">
                        <span class="close">&times;</span>
                           <img class="modal-content" style="margin-top: 6%; min-width:500px" id="modalImage">
                        </div>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        } else {
            // Hiển thị thông báo nếu không tìm thấy sản phẩm
            ?>
            <div class="alert alert-warning" role="alert">
                <strong>Xin lỗi!</strong> Không tìm thấy sản phẩm phù hợp hoặc danh mục này không có sản phẩm!!.
            </div>
            <?php
        }
        ?>
    </div>
</div>
<!-- <script>
    $(document).ready(function(){
        $(document).ready(function(){
        $('#category_id').change(function(){
            var category_id = $(this).val();
            $.get("productlist_ajax.php",{category_id: category_id},function(data){
                $('#brand_id').html(data);
            });
        });
    });
       
    });
</script> -->
<!-- JavaScript để xử lý sự kiện click và hiển thị ảnh sản phẩm lớn -->
<script>
    var currentImageIndex = 0;
    var imagesArray;

    function showLargeImage(images) {
        document.getElementById("largeImageContainer").style.display = 'block';
        imagesArray = images;
        displayCurrentImage();
    }

    function displayCurrentImage() {
        var currentImage = document.getElementById("currentLargeImage");
        currentImage.src = imagesArray[currentImageIndex];
    }

    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % imagesArray.length;
        displayCurrentImage();
    }

    function prevImage() {
        currentImageIndex = (currentImageIndex - 1 + imagesArray.length) % imagesArray.length;
        displayCurrentImage();
    }

    function hideLargeImage() {
        document.getElementById("largeImageContainer").style.display = 'none';
    }
</script>

<script>
            // Lấy modal ảnh mô tả sản phẩm
        var modal = document.getElementById("productModal");

        // Lấy ảnh trong modal
        var modalImg = document.getElementById("modalImage");

        // Lấy tất cả các ảnh sản phẩm
        var productImages = document.getElementsByClassName("product-image");

        // Lấy nút đóng modal
        var span = document.getElementsByClassName("close")[0];

        // Xử lý sự kiện click trên ảnh sản phẩm
        Array.from(productImages).forEach(function(img) {
        img.onclick = function() {
            modal.style.display = "block"; // Hiển thị modal
            modalImg.src = this.src; // Đặt ảnh trong modal là ảnh của sản phẩm được click
        }
        });

        // Xử lý sự kiện click trên nút đóng modal
        span.onclick = function() {
        modal.style.display = "none"; // Ẩn modal khi click vào nút đóng
        }

        // Xử lý sự kiện click bên ngoài ảnh trong modal để đóng modal
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none"; // Ẩn modal khi click bên ngoài ảnh
        }
        }
</script>

<script>
    // Hiển thị modal và lấy dữ liệu mô tả sản phẩm từ cơ sở dữ liệu
    function showModal(product_id) {
        var modal = document.getElementById("product-desc-Modal");
        var product_desc_modalContent = document.getElementById("product_desc_modalContent");

        // Gửi yêu cầu AJAX để lấy dữ liệu mô tả sản phẩm từ cơ sở dữ liệu
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                product_desc_modalContent.innerHTML = this.responseText;
                modal.style.display = "block";
            }
        };
        xhr.open("GET", "get_product_description.php?product_id=" + product_id, true);
        xhr.send();
    }

    // Đóng modal
    function product_desc_closeModal() {
        var modal = document.getElementById("product-desc-Modal");
        modal.style.display = "none";
    }

    // Xử lý sự kiện click vào phần mô tả sản phẩm
    document.querySelectorAll(".product-desc").forEach(function(element) {
        element.addEventListener("click", function() {
            var product_id = this.getAttribute("data-product-id");
            showModal(product_id);
        });
    });
</script>

</section>
</body>
</html>
