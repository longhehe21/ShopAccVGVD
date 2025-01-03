
function Toast({
    tittle='',
    message='',
    type='succes',
    duration=3000
}){
    const main=document.getElementById('Toast');
    if(main){
        const Toast=document.createElement('div');
        const icons = {
            succes:'fa-solid fa-circle-check',
            warning:'fa-solid fa-circle-exclamation'
        };
        const delay = (duration/1000).toFixed(2);
        const autoRemove = setTimeout(function(){
            main.removeChild(Toast);
        },duration+1000);
        Toast.onclick = function(e){
            if(e.target.closest('.Toast__close')){
                main.removeChild(Toast);
                clearTimeout(autoRemove);
            }
        }
        Toast.style.animation=`toastin ease .3s , toastout linear 1s ${delay}s forwards`;
        const icon = icons[type];
        Toast.classList.add('Toast',`Toast--${type}`);
        Toast.innerHTML=`
            <div class="Toast__icon">
                <i class="${icon}"></i>
            </div>
            <div class=" Toast__body">            
                <H3 class="Toast__tittle">${tittle} </H3>
                <P class=" Toast__msg">${message}</P>
            </div>
            <div class="Toast__close">
                <i class="fa-solid fa-xmark"></i>
            </div>
        `;
        main.appendChild(Toast);
    }
}

function showSuccesToast(){
    Toast({
    tittle:'Thành Công',
    message:'Bạn đã đăng ký thành công',
    type:'succes',
    duration:3000
 });
}
function showWaringToast(){
    Toast({
    tittle:'Hủy Đăng Ký',
    message:'Bạn đã Hủy Đăng Ký',
    type:'warning',
    duration:3000
 });
}
function loginerrorToast(){
    Toast({
    tittle:'Đăng nhập thất bại',
    message:'Email hoặc mật khẩu không chính xác',
    type:'warning',
    duration:3000
 });
}
