<?php
    include("class/users_class.php");
    $users = new user;
        $user_id = $_GET["id"];
    $delete_user = $users->delete_users($id);
    
?>