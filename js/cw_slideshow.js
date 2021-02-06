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
  for (i=0; i<slides.length; i++) {
    slides[i].classList.add("hidden")
  }
  //Removes active class from all buttom
  for(i=0; i<slidesButtons.length; i++) {
    slidesButtons[i].classList.remove("active");
  }
  //Adds active class to current button.
  activeButton.classList.add("active");
  //Finds the activebutton index +1
  for(i=0; i<slidesButtons.length; i++) {
    if(slidesButtons[i].classList.contains("active")) {
      activeButtonNumber = i;
    }
  }
  slidesNumber = activeButtonNumber;
  //Shows the current slide.
  slides[slidesNumber].classList.remove("hidden");
  //Resets the slideshow automatic timer
  myTimer = setInterval(showSlides, 5000)
  //Disables the slide buttons for 1 sec (Prevent spamming)
  for(i=0; i<slidesButtons.length; i++){
    slidesButtons[i].disabled = true;

  }
  setTimeout(function(){
    for(i=0; i<slidesButtons.length; i++){
      slidesButtons[i].disabled = false;

    }
  }, 1000)

}

//Showslide automatic

//Hide all slides.
for (i=0; i<slides.length; i++) {
  slides[i].classList.add("hidden")
}

//Shows the current slide.
slides[slidesNumber].classList.remove("hidden");

function showSlides() {
  //Hide all slides.
  for (i=0; i<slides.length; i++) {
    slides[i].classList.add("hidden")
  }

  slidesNumber++;
  if(slidesNumber == slides.length) {
    slidesNumber = 0;
  }
  //Removes active class from all buttom
  for(i=0; i<slidesButtons.length; i++) {
    slidesButtons[i].classList.remove("active");
  }
  //Adds active class to current button.
  slidesButtons[slidesNumber].classList.add("active")
  //Shows the current slide.
  slides[slidesNumber].classList.remove("hidden");
}
//Slideshow automatic timer
var myTimer = setInterval(showSlides, 5000)





