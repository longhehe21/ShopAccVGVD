<?php
    include("header.php");
    include("slider.php");
    include("class/cartegory_class.php");
?>
<?php
    $cartegory = new cartegory;
    if(!isset($_GET["cartegory_id"]) || $_GET["cartegory_id"]==null ){
        echo"<script>window.location = 'cartegorylist.php'</script>";
    }
    else{
        $cartegory_id = $_GET["cartegory_id"];
    }
    $get_cartegory = $cartegory->get_cartegory($cartegory_id);
    if($get_cartegory){
        $result = $get_cartegory -> fetch_assoc();
    }
?>
<?php
    $cartegory = new cartegory;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $cartgory_name = $_POST['cartgory_name'];
        $update_cartegory = $cartegory ->update_cartegory($cartgory_name, $cartegory_id);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory_add">
                <h1>Sửa Danh Mục</h1>
                <form action="" method="POST">
                    <input required name="cartgory_name" type="text" placeholder="Nhập Tên Danh Mục" 
                    value ="<?php echo $result['cartegory_name'] ?>">
                    <button type="submit" > Sửa </button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>