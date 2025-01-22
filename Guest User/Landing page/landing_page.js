let slideIndex = 1;
showSlides(slideIndex);


// Function to jump to a specific slide
function currentSlide(n) {
  showSlides(slideIndex = n);
}

// Main function to handle the slideshow
function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");

  // Wrap around slide index
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }

  // Hide all slides
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  // Deactivate all dots
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

  // Show the active slide and activate the corresponding dot
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
}

// Set interval to move to the next slide every 5 seconds
setInterval(() => {
  currentSlide(1);
}, 5000); // 5000ms = 5 seconds
