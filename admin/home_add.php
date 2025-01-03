<?php
    include("header.php");
    include("slider.php");
    include("class/home_class.php");
?>
<?php
    $home = new home;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $home_name = $_POST['home_name'];
        $insert_home = $home ->insert_home($home_name);
    }
?>
<div class="admin-content-right">
<div class="admin-content-right-product_add">
        <h1>Thêm Mục Trang Chủ</h1>
                <form action="" method="POST">
                    <input required name="home_name" type="text" placeholder="Nhập Tên Mục Trang Chủ">
                    <button type="submit"> Thêm </button>
                </form>
</div>
</div>
</section>
</body>
</html>