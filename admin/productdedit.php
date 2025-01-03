<?php
    include("header.php");
    include("slider.php");
    include("class/product_class.php");
?>

<?php
    $product = new Product();
    $product_id = $_GET["product_id"];
    $get_product = $product->get_product_for_edit($product_id);
    
    if ($get_product) {
        $resultA = $get_product;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
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
        $update_product = $product->update_product($data, $product_images_JSON, $product_image,$product_id);
    }
?>


<div class="admin-content-right">
<div class="admin-content-right-product_add">
                <h1>Thêm Sản Phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Nhập Tên Sản Phẩm <span style="color: red;">*</span></label>
                    <input  name="product_name" required type="text" value = "<?php echo $resultA['product_name'] ?>">
                    <label for="">--Chọn Danh Mục-- <span style="color: red;">*</span></label>
                    <select name="cartegory_id" id="cartegory_id">
                        <option>--Chọn---</option>
                            <?php
                            $show_cartegory = $product -> show_cartegory();
                            if($show_cartegory){while($rusult= $show_cartegory->fetch_assoc()){
                            ?>
                        <option <?php if($resultA["cartegory_id"]==$rusult["cartegory_id"]){echo " SELECTED ";
                        } 
                        ?> 
                        value="<?php echo $rusult['cartegory_id'] ?>" > 
                        <?php echo $rusult['cartegory_name'] ?>
                        </option>
                        <?php
                        }
                        }
                        ?>
                        
                    </select>
                    <label for="">--Chọn Loại Sản Phẩm--<span style="color: red;">*</span></label>
                    <select name="brand_id" id="brand_id">
                        <option value="">
                            --Chọn--
                        </option>
                        <?php
                            $show_brand = $product -> show_brand();
                            if($show_brand){while($rusult2= $show_brand->fetch_assoc()){
                            ?>
                        <option <?php if($resultA["brand_id"]==$rusult2["brand_id"]){echo " SELECTED ";
                        } 
                        ?> 
                        value="<?php echo $rusult2['brand_id'] ?>" > 

                        <?php echo $rusult2['brand_name'] ?>

                        </option>
                        <?php
                        }
                        }
                        ?>
                        
                    </select>
                    
                    <label for="">--Giá Sản Phẩm--<span style="color: red;">*</span></label>
                    <input name="product_price" required type="text" value = "<?php echo $resultA['product_price'] ?>" >
                    <label for="">--Giá Khuyến Mãi--<span style="color: red;">*</span></label>
                    <input name="product_price_new" required type="text" value = "<?php echo $resultA['product_price_new'] ?>">
                    <label for="">--Mô Tả Sản Phẩm--<span style="color: red;">*</span></label>
                    <textarea name="product_desc" id="editor" cols="30" rows="10"> <?php echo $resultA['product_desc']; ?></textarea>
                    <label for="">--Ảnh Sản Phẩm--<span style="color: red;" >*</span></label>
                    <span style="color:red" ><?php if(isset($insert_product)){
                        echo ($insert_product);
                    } ?></span>
                    <input required name="product_img" id="upload_file" type="file">
                    <label for="">--Ảnh Mô Tả Sản Phẩm--<span style="color: red;">*</span></label>
                    <input name="product_img_desc[]" required multiple type="file">
                    <button name="submit" type="submit" >Sửa </button>
                </form>
            </div>
        </div>
    </section>
</body>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
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