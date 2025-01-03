<?php
include("../admin/database.php");
$db = new database;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dangky'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if (strpos($email, '@gmail.com') === false) {
        echo "<script>window.onload = function() { alert('Địa chỉ email không hợp lệ'); }</script>";
    } 
    // Kiểm tra xem mật khẩu và mật khẩu xác nhận có khớp nhau không
    elseif ($password !== $confirm_password) {
        echo "<script>window.onload = function() { alert('Mật khẩu không trùng khớp');}</script>";

    } else {
        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
        $check_email_query = "SELECT * FROM tbl_users WHERE email = '$email'";
        $result = $db->insert($check_email_query);
        if ($result->num_rows > 0) {
            echo "<script>window.onload = function() { alert('Email này đã được đăng ký');window.location.href = '../index.php'; }</script>";
        } else {
            // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Thêm thông tin người dùng vào cơ sở dữ liệu
            $insert_user_query = "INSERT INTO tbl_users (email, password, role) VALUES ('$email', '$hashed_password', 0)";
            if ($db->insert($insert_user_query) === TRUE) {
                echo "<script>window.onload = function() { alert('Đăng ký thành công'); window.location.href = '../index.php';}</script>";
            } 
        }
    }
}
?>
