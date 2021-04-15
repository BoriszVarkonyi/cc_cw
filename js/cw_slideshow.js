/*
//SLIDESHOW
var slides = document.querySelectorAll(".slide");
var slidesNumber = 0;
var slidesButtons = document.querySelectorAll(".slideButtons");
//Showing slide by the clicked button
function toggleButton(x) {
  //Clears the slideshow automatic timer
  clearInterval(myTimer)
  var activeButton = x;
  var activeButtonNumber;
  //Hide all slides.
  for (i = 0; i < slides.length; i++) {
    slides[i].classList.add("hidden")
  }
  //Removes active class from all buttom
  for (i = 0; i < slidesButtons.length; i++) {
    slidesButtons[i].classList.remove("active");
  }
  //Adds active class to current button.
  activeButton.classList.add("active");
  //Finds the activebutton index +1
  for (i = 0; i < slidesButtons.length; i++) {
    if (slidesButtons[i].classList.contains("active")) {
      activeButtonNumber = i;
    }
  }
  slidesNumber = activeButtonNumber;
  //Shows the current slide.
  slides[slidesNumber].classList.remove("hidden");
  //Resets the slideshow automatic timer
  myTimer = setInterval(showSlides, 5000)
  //Disables the slide buttons for 1 sec (Prevent spamming)
  for (i = 0; i < slidesButtons.length; i++) {
    slidesButtons[i].disabled = true;

  }
  setTimeout(function () {
    for (i = 0; i < slidesButtons.length; i++) {
      slidesButtons[i].disabled = false;

    }
  }, 1000)

}

//Showslide automatic

//Hide all slides.
for (i = 0; i < slides.length; i++) {
  slides[i].classList.add("hidden")
}

//Shows the current slide.
slides[slidesNumber].classList.remove("hidden");

function showSlides() {
  //Hide all slides.
  for (i = 0; i < slides.length; i++) {
    slides[i].classList.add("hidden")
  }

  slidesNumber++;
  if (slidesNumber == slides.length) {
    slidesNumber = 0;
  }
  //Removes active class from all buttom
  for (i = 0; i < slidesButtons.length; i++) {
    slidesButtons[i].classList.remove("active");
  }
  //Adds active class to current button.
  slidesButtons[slidesNumber].classList.add("active")
  //Shows the current slide.
  slides[slidesNumber].classList.remove("hidden");
}
//Slideshow automatic timer
var myTimer = setInterval(showSlides, 5000)
*/

//SLIDESHOW 2.0 (R.I.P 1.0 :c)
var slides = document.querySelectorAll(".slide");
var slideButtons = document.querySelectorAll("#slide_indicator button")
var slideNumber = 0;

function autoSlide() {
  var previusSlide = slides[slideNumber]
  var previousButton = slideButtons[slideNumber]
  previusSlide.classList.add("blurred")
  if (slideNumber + 1 == slides.length) {
    slideNumber = 0;
  }
  else {
    slideNumber++
  }
  setTimeout(function () {
    slides[slideNumber].classList.remove("hidden")
    previousButton.classList.remove("current")
  }, 250)
  setTimeout(function () {
    slideButtons[slideNumber].classList.add("current")
    previusSlide.classList.add("hidden")
  }, 500)  
  setTimeout(function () {
    previusSlide.classList.remove("blurred")
  }, 750)
}
var myTimer = setInterval(autoSlide, 3000)

function slideToRight() {
  clearInterval(myTimer)
  var previusSlide = slides[slideNumber]
  slideButtons[slideNumber].classList.remove("current")
  if (slideNumber + 1 == slides.length) {
    slideNumber = 0;
    previusSlide.classList.add("hidden")
    slides[slideNumber].classList.remove("hidden")
  }
  else {
    slideNumber++
    slides[slideNumber].classList.remove("hidden")
    setTimeout(function () {
      previusSlide.classList.add("hidden")
    }, 250)
  }
  slideButtons[slideNumber].classList.add("current")
  myTimer = setInterval(autoSlide, 3000)
}

function slideToLeft() {
  clearInterval(myTimer)
  var previusSlide = slides[slideNumber]
  slideButtons[slideNumber].classList.remove("current")
  if (slideNumber == 0) {
    slideNumber = slides.length - 1;
    slides[slideNumber].classList.remove("hidden")
    setTimeout(function () {
      previusSlide.classList.add("hidden")
    }, 250)
  }
  else {
    slideNumber--
    slides[slideNumber].classList.remove("hidden")    
    setTimeout(function () {
      previusSlide.classList.add("hidden")
    }, 250)
  }
  slideButtons[slideNumber].classList.add("current")
  myTimer = setInterval(autoSlide, 3000)
}

function jumpToSlide(jumpToSlideNumber){
  clearInterval(myTimer)
  slideButtons[slideNumber].classList.remove("current")
  slides[slideNumber].classList.add("hidden")
  slideNumber = jumpToSlideNumber-1
  slides[slideNumber].classList.remove("hidden")
  slideButtons[slideNumber].classList.add("current")
  myTimer = setInterval(autoSlide, 3000)
}


