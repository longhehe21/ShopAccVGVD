<?php
    include("class/home_class.php");
    $home = new home;
    if(!isset($_GET["home_id"]) || $_GET["home_id"]==null ){
        echo"<script>window.location = 'home_list.php'</script>";
    }
    else{
        $home_id = $_GET["home_id"];
    }
    $delete_home = $home->delete_home($home_id);
    
?>