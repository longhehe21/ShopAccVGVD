<?php
    session_start();
    if (isset($_SESSION["email"])){
        unset( $_SESSION["email"] );
        unset( $_SESSION["role"] );
    }
    header("location:../index.php");
?>
