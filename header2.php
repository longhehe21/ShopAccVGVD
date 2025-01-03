<?php
    include("user/login.php");
    $currentUrl = $_SERVER['PHP_SELF'];
    include "class/header2_class.php"
?>

<?php
    $cartegory = new cartegory;
    $show_cartegory = $cartegory->show_cartegory();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dada Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" integrity="sha512-oHDEc8Xed4hiW6CxD7qjbnI+B07vDdX7hEPTvn9pSZO1bcRqHp8mj9pyr+8RVC2GmtEfI2Bi9Ke9Ass0as+zpg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main8.css">
    <link rel="stylesheet" href="./assets/css/slider3.css">
    <link rel="stylesheet" href="./assets/css/gird.css">
    <script src="./assets/js/main7.js" ></script>
    <link rel="stylesheet" href="./assets/css/product-main2.css">
    <link rel="stylesheet" href="./assets/css/sanpham.css">
    <link rel="stylesheet" href="./assets/css/product2.css">
    <link rel="stylesheet" href="./assets/css/category.css">
    <link rel="stylesheet" href="./assets/css/cart.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./assets/css/home-filter.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app">
        <header class="header">
            <div class="grid wide">
                <div class="header__navbar">
                    <a href="index.php" class="header__navbar_logo">
                        <img  src="./assets/logo/Logo-DaDaShop-1.png" alt="" class="header__navbar_logo-img">
                    </a>
                           
                    <ul class="header__navbar_list">
                            <a href="index.php" class="header__navbar_list-item-link ">
                                <li class="header__navbar_list-item">
                                    Trang Chủ
                                </li>
                            </a>
                            </ul>
                        <?php
                    if($show_cartegory){
                        $i=0;
                        while($result = $show_cartegory->fetch_assoc()){
                            $i++;
                    ?>  
                       <ul class="header__navbar_list">
                            <a href="./accwechat.php?cartegory_id=<?php echo $result["cartegory_id"]?>" class="header__navbar_list-item-link ">
                                <li class="header__navbar_list-item">
                                    <?php echo $result["cartegory_name"] ?>
                                </li>
                            </a>
                            </ul>
                            <?php
                    }
                    }
                    ?>
                            <a href="cart.php" class="header__navbar_list-item-link">
                                <i  class="header__navbar_list-item-link-icon-cart fa-solid fa-cart-shopping"></i>
                            </a>
                            <?php if(isset($_SESSION["email"])): ?>
                            <!-- Hiển thị khi đã đăng nhập -->
                            <div class="header__navbar_user">
                                <img class="header__navbar_user__avatar" src="./user/avatar_user/avatar.jpg" alt="">
                                <span class="header__navbar_user__name"><?php echo $_SESSION["email"]; ?></span>
                                <ul class="header__navbar_user-option">
                                    <li id="header__navbar_user-option-edit__pw" class="header__navbar_user-option-item noselect" >Đổi mật khẩu</li>
                                    <li class="header__navbar_user-option-item noselect">
                                        <a href="./user/logout.php" class="header__navbar_user-option-logout ">Đăng xuất</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- form đổi mật khẩu -->
                            <div class="modal-editpw" id="modal-editpw">
                                <div class="modal__overlay-editpw"></div>
                                <div class="modal-body-editpw">
                                    <form id="authen-form-editpw" class="authen-form authen-form-editpw" method="POST">
                                    <div class="authen-form__container">
                                        <div class="authen-form__header">
                                            <h3 class="authen-form__header__heading">Đổi mật khẩu</h3>
                                        </div>
                                        <div class="authen-form__body">
                                            <div class="authen-form__body__group">
                                                <input type="password" id="passwor_dold" name="passwor_dold" class="authen-form__body__group__input" placeholder="Nhập mật khẩu cũ của bạn">
                                                <span class="authen-form__body__group__message" ></span>
                                            </div>
                                            <div class="authen-form__body__group">
                                                <input type="password" id="password" name="password_new" class="authen-form__body__group__input" placeholder="Nhập mật khẩu mới của bạn">
                                                <span class="authen-form__body__group__message" ></span>
                                            </div>
                                            <div class="authen-form__body__group">
                                                <input type="password"id="confirm_password_new" name="confirm_password_new" class="authen-form__body__group__input" placeholder="Nhập lại mật khẩu mới của bạn">
                                                <span class="authen-form__body__group__message" ></span>
                                            </div>
                                        </div>
                                        <div class="authen-form__controls authen-form__controls-editpw">
                                            <button class="btn btn--normal authen-form__controls--btn__back">TRỞ LẠI</button>
                                            <button type="submit" name="doimatkhau" class="btn btn--primary">Đổi Mật Khẩu</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                             <?php else: ?>
                                <!-- Hiển thị khi chưa đăng nhập -->
                                <div id="header__navbar-login" class="header__navbar_list-item-link header__navbar_list-item-link-btn">
                                    <span class="header__navbar_list-btn header__navbar_list-btn-login">Đăng Nhập</span>
                                </div>
                                <div id="header__navbar-register" class="header__navbar_list-item-link header__navbar_list-item-link-btn">
                                    <span class="header__navbar_list-btn header__navbar_list-btn-signup">Đăng Ký</span>
                                </div>
                            <?php endif; ?>
                        </ul>
                            
                </div>
            </div>
        </header>
        <!-- modal__layout -->
    <div id="modal" class="modal">
        <div class="modal__overlay"></div>
        <div class="modal__body">
            
                    <!-- aithen form Đăng ký -->
            <form id="registerForm" class="authen-form" method="POST" action="./user/register.php">
                <div class="authen-form__container">
                    <div class="authen-form__header">
                        <h3 class="authen-form__header__heading">Đăng ký</h3>
                        <span class="authen-form__header__switch-btn">Đăng Nhập</span>
                    </div>
                    <div class="authen-form__body">
                        <div class="authen-form__body__group">
                            <input type="text" name="email" id="email" class="authen-form__body__group__input" placeholder="Nhập email của bạn">
                            <span class="authen-form__body__group__message" ></span>
                        </div>
                        <div class="authen-form__body__group">
                            <input type="password" name="password" id="password" class="authen-form__body__group__input" placeholder="Nhập mật khẩu của bạn">
                            <span class="authen-form__body__group__message" ></span>
                        </div>
                        <div class="authen-form__body__group">
                            <input type="password" name="confirm_password" id="confirm_password" class="authen-form__body__group__input" placeholder="Nhập lại mật khẩu của bạn">
                            <span class="authen-form__body__group__message" ></span>
                        </div>
                    </div>
                    <div class="authen-form__aside">
                        <p class="authen-form__aside__policy_text">
                            Bằng việc đăng kí, bạn đã đồng ý với Dada Shop về
                            <a href="" class="authen-form__aside__policy_text_link">Điều khoản dịch vụ</a>
                            &
                            <a href="" class="authen-form__aside__policy_text_link">Chính sách bảo mật</a>
                        </p>
                    </div>
                    <div class="authen-form__controls">
                        <button class="btn btn--normal authen-form__controls--btn__back">TRỞ LẠI</button>
                        <button type="submit" name="dangky" class="btn btn--primary">ĐĂNG KÝ</button>
                    </div>
                </div>

                <div class="authen-form__socials">
                    <a href="" class="btn authen-form__socials--fb btn--size-s btn--with__icon">
                        <i class="btn--with__icon--icon fa-brands fa-square-facebook"></i>
                        <span class="authen-form__socials__btn__text">
                            Kết nối với Facebook
                        </span>
                    </a>
                    <a href="" class="btn authen-form__socials--gg btn--size-s btn--with__icon">
                        <i class="btn--with__icon--icon fa-brands fa-google"></i>
                        <span class="authen-form__socials__btn__text">
                            Kết nối với Google
                        </span>
                    </a>
                </div>
            </form>
                  <!-- aithen form Đăng Nhập -->
            <form id="loginForm" class="authen-form" method="POST" >
                <div class="authen-form__container">
                    <div class="authen-form__header">
                        <h3 class="authen-form__header__heading">Đăng Nhập</h3>
                        <span class="authen-form__header__switch-btn">Đăng Ký</span>
                    </div>
                    <div class="authen-form__body">
                        <div class="authen-form__body__group">
                            <input name="email" id="email" type="text" class="authen-form__body__group__input" placeholder="Nhập email của bạn">
                            <span class="authen-form__body__group__message" ></span>
                        </div>
                        <div class="authen-form__body__group">
                            <input name="password" id="password" type="password" class="authen-form__body__group__input" placeholder="Nhập mật khẩu của bạn">
                            <span class="authen-form__body__group__message" ></span>
                        </div>
                    </div>
                    <div class="authen-form__aside">
                        <div class="authen-form__aside__help">
                            <a href="" class="authen-form__aside__help__link">Quên mật khẩu</a>
                            <span class="authen-form__aside__help__link__separate"></span>
                            <a href="" class="authen-form__aside__help__link">Cần trợ giúp?</a>
                        </div>
                    </div>
                    <div class="authen-form__controls">
                        <button class="btn btn--normal authen-form__controls--btn__back">TRỞ LẠI</button>
                        <button type="submit" name="dangnhap" class="btn btn--primary"> Đăng Nhập</button>
                    </div>
                </div>

                <div class="authen-form__socials">
                    <a href="" class="btn authen-form__socials--fb btn--size-s btn--with__icon">
                        <i class="btn--with__icon--icon fa-brands fa-square-facebook"></i>
                        <span class="authen-form__socials__btn__text">
                            Kết nối với Facebook
                        </span>
                    </a>
                    <a href="" class="btn authen-form__socials--gg btn--size-s btn--with__icon">
                        <i class="btn--with__icon--icon fa-brands fa-google"></i>
                        <span class="authen-form__socials__btn__text">
                            Kết nối với Google
                        </span>
                    </a>
                </div>
            </form>
        </div>
    </div>   
    <script>
        validator({
            form:'#registerForm',
            errorSelector:'.authen-form__body__group__message',
            rules:[
                validator.isRequired('#email'),
                validator.isEmail('#email'),
                validator.isRequired('#password'),
                validator.isRequired('#confirm_password'),
                validator.minLength('#password',6),
                validator.isConfirmed('#confirm_password',function(){
                return document.querySelector('#registerForm #password').value;
            })
          ]
        });
        validator({
            form:'#loginForm',
            errorSelector:'.authen-form__body__group__message',
            rules:[
                validator.isRequired('#email'),
                validator.isEmail('#email'),
                validator.isRequired('#password'),
                validator.minLength('#password',6)
            ]
        });
    </script>