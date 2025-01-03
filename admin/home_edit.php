<?php
    include("header.php");
    include("slider.php");
    include("class/home_class.php");
?>
<?php
    $home = new home;
    if(!isset($_GET["home_id"]) || $_GET["home_id"]==null ){
        echo"<script>window.location = 'home_list.php'</script>";
    }
    else{
        $home_id = $_GET["home_id"];
    }
    $get_home = $home->get_home($home_id);
    if($get_home){
        $result = $get_home -> fetch_assoc();
    }
?>
<?php
    $home = new home;
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $home_name = $_POST['home_name'];
        $update_home = $home ->update_home($home_name, $home_id);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory_add">
                <h1>Sửa Danh Mục</h1>
                <form action="" method="POST">
                    <input required name="home_name" type="text" placeholder="Nhập Tên Danh Mục" 
                    value ="<?php echo $result['home_name'] ?>">
                    <button type="submit" > Sửa </button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>