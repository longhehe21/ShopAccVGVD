<?php
    include("header.php");
    include("slider.php");
    include("class/product_class.php");
?>

<?php
    $product = new product;
    $insert_product = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem dữ liệu từ form đã được gửi đi hay không
    if(isset($_POST['product_price']) && isset($_POST['product_price_new'])) {
        $data = $_POST;
        $file_path = 'uploads/';
        $product_images = [];
        foreach ($_FILES['product_img_desc']['tmp_name'] as $key => $filetmp) {
            $fileUrl = $file_path . $_FILES['product_img_desc']['name'][$key];
            move_uploaded_file($filetmp, $fileUrl);
            array_push($product_images, $fileUrl);
        }
        $product_images_JSON = implode('#', $product_images);
        $product_image = $_FILES['product_img']['name'];

        // Kiểm tra giá sản phẩm và giá khuyến mãi chỉ chứa số
        if (!is_numeric($_POST['product_price']) ) {
            $insert_product2 = "Giá sản phẩm phải là số.";
        }elseif(!is_numeric($_POST['product_price_new'])) {
            $insert_product1 = "Giá sản phẩm khuyến mãi phải là số.";
        }
        else {
            $product->insert_product($data, $product_images_JSON, $product_image);
        }
    }
}
?>


<div class="admin-content-right">
<div class="admin-content-right-product_add">
                <h1>Thêm Sản Phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Nhập Tên Sản Phẩm <span style="color: red;">*</span></label>
                    <input name="product_name" required type="text">
                    <label for="">--Chọn Danh Mục-- <span style="color: red;">*</span></label>
                    <select name="cartegory_id" id="cartegory_id">
                        <option value="">--Tất Cả--</option>
                            <?php
                            $show_cartegory = $product -> show_cartegory();
                            if($show_cartegory){while($result= $show_cartegory->fetch_assoc()){
                            ?>
                        <option value="<?php echo $result['cartegory_id'] ?>">
                        <?php echo $result['cartegory_name'] ?>
                        </option>
                        <?php
                            }
                            }
                            ?>
                    </select>
                    <label for="">--Chọn Loại Sản Phẩm--<span style="color: red;">*</span></label>
                    <select name="brand_id" id="brand_id">
                        <option value="">
                            --Tất Cả--
                        </option>
                        
                    </select>
                    <label for="">--Giá Sản Phẩm--<span style="color: red;">*</span></label>
                    <span style="color:red" ><?php if(isset($insert_product2)){
                        echo ($insert_product2);
                    } ?></span>
                    <input name="product_price" required type="text">
                    <label for="">--Giá Khuyến Mãi--<span style="color: red;">*</span></label>
                    <span style="color:red" ><?php if(isset($insert_product1)){
                        echo ($insert_product1);
                    } ?></span>
                    <input name="product_price_new" required type="text">
                    <label for="">--Mô Tả Sản Phẩm--<span style="color: red;">*</span></label>
                    <textarea name="product_desc" id="editor" cols="30" rows="10"></textarea>
                    <label for="">--Ảnh Sản Phẩm--<span style="color: red;">*</span></label>
                    <span style="color:red" ><?php if(isset($insert_product)){
                        echo ($insert_product);
                    } ?></span>
                    <input required name="product_img" id="upload_file" type="file">
                    <label for="">--Ảnh Mô Tả Sản Phẩm--<span style="color: red;">*</span></label>
                    <input name="product_img_desc[]" required multiple type="file">
                    <button type="submit" >Thêm </button>
                </form>
            
            </div>
        </div>
    </section>
</body>

<script>
        
    ClassicEditor.create( document.querySelector( '#editor' ), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
            },
            toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
        } )
        .catch( error => {
            console.error( error );
        } );
    </script>

    <script>
        $(document).ready(function(){
            $('#cartegory_id').change(function(){
                // alert($(this).val())
                var x = $(this).val()
                $.get("productadd_ajax.php",{cartegory_id:x},function(data){
                    $('#brand_id').html(data)
                })
            })
        })
    </script>
</html>