const slides = document.querySelectorAll('.mySlides'); 
let count = 0;

slides.forEach((slide, index) => {
    slide.style.left = `${index * 100}%`;
});

function slideImg() {
  slides.forEach((myslide) => {
    myslide.style.transform = `translateX(-${count * 100}%)`;
  });
}

setInterval(() => {
  count = (count + 1) % slides.length;
  slideImg();
}, 10000);

// Get buttons
const previousBtn = document.querySelector(".prebtn");
const nextBtn = document.querySelector(".nextbtn");


previousBtn.addEventListener("click", () => {
  count = count > 0 ? count - 1 : slides.length - 1; 
  slideImg();
});

nextBtn.addEventListener("click", () => {
  count = (count + 1) % slides.length; 
  slideImg();
});
