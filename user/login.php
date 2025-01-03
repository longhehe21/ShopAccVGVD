<?php
session_start();
include("admin/database.php");
$db = new database;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dangnhap'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Kiểm tra thông tin đăng nhập
    $check_login_query = "SELECT * FROM tbl_users WHERE email = '$email'";
    $result = $db->select($check_login_query);
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Đăng nhập thành công, tạo phiên đăng nhập và chuyển hướng người dùng
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            if ($user['role'] == 1) {
                // Nếu là admin, chuyển hướng tới trang admin
                echo "<script>window.onload = function() { window.location.href = 'admin/productlist.php';  alert('Chào mừng admin');}</script>";

            } else {
                // Nếu không phải admin, chuyển hướng tới trang chính
                echo "<script>window.onload = function() { alert('Đăng nhập thành công'); window.location.href = 'index.php';}</script>";
               
            }
        } else {
            // kiếm tra xem mật khẩu và tài khoản có đúng không
            echo "<script>window.onload = function() { alert('Sai email hoặc mật khẩu.'); }</script>";
        }
    } else {
        echo "<script>window.onload = function() { alert('Email này chưa đăng ký tài khoản!!');}</script>";
    }
}
?>