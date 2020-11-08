/*
var slideIndex = 0;

slideShow();

function slideShow() {
    
    var i = 0;
    var slides = document.getElementsByClassName("slide");*/

//SLIDESHOW
var slides = document.querySelectorAll(".slide");
var slidesNumber;
for (i=0; i<slides.length; i++) {
  slides[i].classList.add("hidden") 
}

function showSlides() {
  slidesNumber++;

  slides[slidesNumber].classList.remove("hidden")

  setTimeout(showSlides, 2000); 
}





/*
const slides = document.querySelectorAll(".slide")
var slideNumber = 0;
var slideZ = 1;
var i;

const interval = setInterval(function() {

    slideZ++;
    slides[slideNumber].classList.remove("hidden");
    slides[slideNumber].style.zIndex = slideZ;

    slideNumber++;
    
    if (slideNumber == 4) {

      for (i = 0; i < slides.length; i++) {
        slides[i].classList.add("hidden");
      }

      slideNumber = 1;
    }

 }, 2000); 
*/
//SLIDESHOW END
