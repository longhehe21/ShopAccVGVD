<?php
    include("header.php");
    include("slider.php");
    include("class/home_class.php");
?>
<?php
    $home = new home;
    
    $show_home = $home->show_home();
?>
<div class="admin-content-right">
<div class="admin-content-right-cartegory_list">
                <h1>Danh Sách Danh Mục</h1>
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>Id</th>
                        <th>Tên Danh Mục</th>
                        <th>Tùy Biến</th>
                    </tr>
                    <?php
                    if($show_home){
                        $i=0;
                        while($result = $show_home->fetch_assoc()){
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result["home_id"] ?></td>
                        <td><?php echo $result["home_name"] ?></td>
                        <td>
                            <a href="home_edit.php?home_id=<?php echo $result["home_id"] ?>">Sửa</a>
                            |
                            <a href="home_delete.php?home_id=<?php echo $result["home_id"] ?>">Xóa</a>
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
</html>