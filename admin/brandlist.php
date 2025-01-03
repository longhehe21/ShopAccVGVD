<?php
    include("header.php");
    include("slider.php");
    include("class/brand_class.php");
?>
<?php
    $brand = new brand;
    $show_brand = $brand->show_brand();
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory_list">
                 <form action="" method="POST" enctype="multipart/form-data">
                    <h1>Danh Sách Loại Sản Phẩm</h1>
                        <select class="admin-content-right-select" name="cartegory_id" id="cartegory_id">
                            <option value="#">--Tất Cả--</option>
                                <?php
                                $show_cartegory = $brand -> show_cartegory();
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
                </form>
                <table id="product_list">
                    <tr>
                        <th>Stt</th>
                        <th>Id</th>
                        <th>Danh Mục</th>
                        <th>Loại Sản Phẩm</th>
                        <th>Tùy Biến</th>
                    </tr>
                    <?php
                    if($show_brand){
                        $i=0;
                        while($result = $show_brand->fetch_assoc()){
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $result["brand_id"] ?></td>
                        <td><?php echo $result["cartegory_name"] ?></td>
                        <td><?php echo $result["brand_name"] ?></td>
                        <td>
                            <a href="brandedit.php?brand_id=<?php echo $result["brand_id"] ?>">Sửa</a>
                            |
                            <a href="branddelete.php?brand_id=<?php echo $result["brand_id"] ?>">Xóa</a>
                        </td>
                    </tr>
                    <?php
                    }
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>

<script>
    $(document).ready(function(){
        $('#cartegory_id').change(function(){
            var cartegory_id = $(this).val();
            $.get("brandlist_ajax.php", { cartegory_id: cartegory_id }, function(data){
                $('#product_list').html(data); // Thay thế #brand_id thành #product_list
            });
        });
    });
</script>



</html>