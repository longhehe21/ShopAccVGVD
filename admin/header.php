<?php
    session_start();
    if(!isset($_SESSION["email"]) && !isset($_SESSION["role"]) || $_SESSION["role"] == 0){
        header("location:../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin_assets/admin3.css">
    <script src="./admin_assets/admin.js"></script>
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="ckeditor5-build-classic/ckeditor.js"></script>
    <script src="ckfinder/ckfinder.js"></script>
    <title>Danh Mục Sản Phẩm</title>
</head>
<body>
    <header>
        <h1>TOP</h1>
        <a href="../user/logout.php">
            <button >Đăng Xuất</button>
        </a>
    </header>