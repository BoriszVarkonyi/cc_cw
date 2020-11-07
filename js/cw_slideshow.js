/*
var slideIndex = 0;

slideShow();

function slideShow() {
    
    var i = 0;
    var slides = document.getElementsByClassName("slide");*/

//SLIDESHOW
//var slides = document.querySelectorAll(".slide");
function showSlides() {
  var i;
  var slides = document.querySelectorAll(".slide");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].classList.add("hidden");  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); 
function slideAnimation () {
  slides.classlist.remove("hidden");
}
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
