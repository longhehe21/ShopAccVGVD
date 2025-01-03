const bigImg = document.querySelector(".product-content-left-big-img img")
const smalImg = document.querySelectorAll(".product-content-left-small-img img")

smalImg.forEach(function(imgItem){
    imgItem.addEventListener("click",function(){
        bigImg.src = imgItem.src
    })
})
// --------------dang ký đăng nhập----------------
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("#header__navbar-login").addEventListener("click", function(event) {
        document.querySelector("#registerForm").style.display = "none";
        document.querySelector("#loginForm").style.display = "block";
        document.querySelector("#modal").style.display = "block";
    });
    document.querySelector("#header__navbar-register").addEventListener("click", function(event) {
    document.querySelector("#loginForm").style.display = "none";
    document.querySelector("#registerForm").style.display = "block";
    document.querySelector("#modal").style.display = "block";
    });
    // Bắt sự kiện khi người dùng click ra bên ngoài form để đóng form
    document.querySelector(".modal__overlay").addEventListener("click", function(event) {
        // Ẩn cả hai form khi người dùng click ra phần mờ đục
        document.querySelector("#modal").style.display = "none";
    });
    document.querySelectorAll(".authen-form__controls--btn__back").forEach(function(btn) {btn.addEventListener("click", function() {
        document.querySelector("#modal").style.display = "none";

    });
});
    
    // Bắt sự kiện khi người dùng click vào nút "Đăng Ký"
    document.querySelectorAll(".authen-form__header__switch-btn").forEach(function(btn) {
        btn.addEventListener("click", function() {
            // Ẩn form đăng nhập và hiện form đăng ký hoặc ngược lại
            if (this.textContent === "Đăng Ký") {
                document.querySelector("#loginForm").style.display = "none";
                document.querySelector("#registerForm").style.display = "block";
            } else {
                document.querySelector("#loginForm").style.display = "block";
                document.querySelector("#registerForm").style.display = "none";
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var currentUrl = window.location.href;
    var navLinks = document.querySelectorAll('.header__navbar_list-item-link');

    for (var i = 0; i < navLinks.length; i++) {
        var href = navLinks[i].getAttribute('href');
        // Kiểm tra nếu địa chỉ URL chính xác hoặc là một phần của href
        if (currentUrl === href || currentUrl.indexOf(href) !== -1) {
            navLinks[i].classList.add('active');
        }
    }
});

document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("#header__navbar_user-option-edit__pw").addEventListener("click", function(event) {
        document.querySelector("#modal-editpw").style.display = "block";
    });
    document.querySelector(".modal__overlay-editpw").addEventListener("click", function(event) {
        document.querySelector("#modal-editpw").style.display = "none";
    });
    document.querySelector(".modal__overlay-editpw").addEventListener("click", function(event) {
        document.querySelector("#authen-form__controls--btn__back").style.display = "none";
    });
});


// --------------------------------------------------------------
function validator(options){
    var selectorRules = {};
    function validate(inputElement,rule){
        var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
        var errorMessage = rule.test(inputElement.value);
        var rules = selectorRules[rule.selector]
        for(var i=0;i<rules.length;++i){
            errorMessage= rules[i](inputElement.value)
            if(errorMessage) break;
        }
        if(errorMessage){
            errorElement.innerText = errorMessage;
            inputElement.parentElement.classList.add('invalid')
        }else{
            errorElement.innerText= '';
            inputElement.parentElement.classList.remove('invalid')

        }
        return !errorMessage;
    }
    var formElement = document.querySelector(options.form);
    if(formElement){
        formElement.onsubmit = function(e){
            var isFormValid = true;
        options.rules.forEach(function (rule) {
            // lặp qua từng rule và validate
            var inputElement = formElement.querySelector(rule.selector);
            var isValid = validate(inputElement, rule);
            if (!isValid) {
                isFormValid = false;
            }
        });
        if (!isFormValid) {
            e.preventDefault();
        }
        }
        options.rules.forEach(function(rule) {
            if(Array.isArray(selectorRules[rule.selector])){
                selectorRules[rule.selector].push(rule.test)
            }else{
                selectorRules[rule.selector]= [rule.test]
            }
            var inputElement = formElement.querySelector(rule.selector);
            if(inputElement){
                inputElement.onblur = function(){
                    validate(inputElement,rule);
                }
                inputElement.oninput = function(){
                    var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
                    errorElement.innerText= '';
                    inputElement.parentElement.classList.remove('invalid')
                }
            }
        });
    }
}

validator.isEmail = function(selector,message){
    return{
        selector:selector,
        test:function(value){
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined: message ||'Trường này phải là email'
        }
    }
}
validator.isRequired = function(selector,message){
    return{
        selector:selector,
        test:function(value){
            return value.trim() ? undefined: message ||'Vui lòng nhập trường này'
        }
    }
}
validator.minLength = function(selector,min,message){
    return{
        selector:selector,
        test:function(value){
            return value.length>= min ? undefined: message || `Mật khẩu tối thiểu ${min} ký tự`
        }
    }
}
validator.isConfirmed = function(selector,getCofirmValue,message){
    return{
        selector:selector,
        test:function(value){
            return value === getCofirmValue()? undefined : message || 'Mật khẩu không trùng khớp'
        }
    }
}
