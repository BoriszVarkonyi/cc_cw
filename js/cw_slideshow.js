//SLIDESHOW
var slides = document.querySelectorAll(".slide");
var slidesNumber = 0;
var OldSlides;
//Buttons

for (i=0; i<slides.length; i++) {
  slides[i].classList.add("hidden") 
}
slides[slidesNumber].classList.remove("hidden");
function showSlides() {
  oldSlides = slides[slidesNumber]
  oldSlides.classList.add("hidden")
  slidesNumber++;
  if(slidesNumber == slides.length) {
    slidesNumber = 0;
  }
  slides[slidesNumber].classList.remove("hidden");

}
setInterval(showSlides, 5000); 
//END





