<?php
    include("header.php");
    include("slider.php");
    include("class/users_class.php");
?>
<?php
    $users = new user;
    $show_users = $users->show_users();
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory_list">
                    <h1>Danh Sách Người Dùng</h1>
                <table id="product_list">
                    <tr>
                        <th>Stt</th>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Tùy Biến</th>
                    </tr>
                    <?php
                    if($show_users){
                        $i=0;
                        while($result = $show_users->fetch_assoc()){
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $result["id"] ?></td>
                        <td><?php echo $result["email"] ?></td>
                        <td>
                            <a href="" >Chặn</a>
                            |
                            <a href="users_delete.php?id=<?php echo $result["id"] ?>">Xóa</a>
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