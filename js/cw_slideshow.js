//SLIDESHOW
var slides = document.querySelectorAll(".slide");
var slidesNumber = 0;
var slidesButtons = document.querySelectorAll(".slideButtons");

function toggleButton(x) {
  var activeButton = x;
  var activeButtonNumber;
  for (i=0; i<slides.length; i++) {
    slides[i].classList.add("hidden") 
  }
  for(i=0; i<slidesButtons.length; i++) {
    slidesButtons[i].classList.remove("active");
  }
  activeButton.classList.add("active");
  for(i=0; i<slidesButtons.length; i++) {
    if(slidesButtons[i].classList.contains("active")) {
      activeButtonNumber = i;
    }
  }
  slidesNumber = activeButtonNumber;
  slides[slidesNumber].classList.remove("hidden");
}

//Buttons
for (i=0; i<slides.length; i++) {
  slides[i].classList.add("hidden") 
}
slides[slidesNumber].classList.remove("hidden");
function showSlides() {
  for (i=0; i<slides.length; i++) {
    slides[i].classList.add("hidden") 
  }

  slidesNumber++;
  if(slidesNumber == slides.length) {
    slidesNumber = 0;
  }
  slides[slidesNumber].classList.remove("hidden");
  for(i=0; i<slidesButtons.length; i++) {
    slidesButtons[i].classList.remove("active");
  }
  slidesButtons[slidesNumber].classList.add("active")
  slides[slidesNumber].classList.remove("hidden");
}
setInterval(showSlides, 3000); 
//END





