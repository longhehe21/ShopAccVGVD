var slideIndex = 0;
var slideInterval = 4000; // Thời gian chờ giữa các lượt chuyển slide (miligiây)
var slides = document.getElementsByClassName("mySlides");
var totalSlides = slides.length;
var timeoutId; // Biến để lưu ID của timeout
var startX = 0;
var startY = 0;

showSlides(); // Bắt đầu hiển thị slide tự động

function showSlides() {
    var currentSlide = slides[slideIndex];
    var nextSlideIndex = (slideIndex + 1) % totalSlides;
    var nextSlide = slides[nextSlideIndex];
    
    currentSlide.style.transition = "transform 1s"; 
    currentSlide.style.transform = "translateX(-100%)"; // Di chuyển slide hiện tại ra khỏi màn hình sang trái
    nextSlide.style.transition = "transform 1s";
    nextSlide.style.transform = "translateX(0)"; // Hiển thị slide tiếp theo từ bên phải

    slideIndex = nextSlideIndex; // Cập nhật slideIndex

    timeoutId = setTimeout(function() {
        resetSlides(); // Thiết lập lại trạng thái ban đầu của các phần tử slide
        showSlides(); // Gọi lại hàm showSlides()
    }, slideInterval);
}

// Hàm để thiết lập lại trạng thái ban đầu của các phần tử slide
function resetSlides() {
    for (var i = 0; i < totalSlides; i++) {
        slides[i].style.transition = "none"; // Tắt hiệu ứng chuyển động    
        slides[i].style.transform = "translateX(100%)"; // Ẩn tất cả các slide sang phải
    }
}

function startDrag(event) {
    if (event.type === 'mousedown') {
        startX = event.clientX;
    } else if (event.type === 'touchstart') {
        startX = event.touches[0].clientX;
    }

    document.addEventListener('mousemove', doDrag);
    document.addEventListener('mouseup', endDrag);
    document.addEventListener('touchmove', doDrag);
    document.addEventListener('touchend', endDrag);
}

function doDrag(event) {
    event.preventDefault();
    var endX = 0;
    if (event.type === 'mousemove') {
        endX = event.clientX;
    } else if (event.type === 'touchmove') {
        endX = event.touches[0].clientX;
    }

    if (startX - endX > 50) {
        plusSlides(1); // Di chuyển sang slide tiếp theo nếu kéo sang phải
        startX = endX;
    } else if (startX - endX < -50) {
        plusSlides(-1); // Di chuyển sang slide trước đó nếu kéo sang trái
        startX = endX;
    }
}

function endDrag() {
    document.removeEventListener('mousemove', doDrag);
    document.removeEventListener('mouseup', endDrag);
    document.removeEventListener('touchmove', doDrag);
    document.removeEventListener('touchend', endDrag);
}

function plusSlides(n) {
    var newIndex = (slideIndex + n + totalSlides) % totalSlides;
    slideIndex = newIndex;
    showSlides();
}
