var firstButton = document.getElementById("first_button");
var secondButton = document.getElementById("second_button");
var thirdButton = document.getElementById("third_button");
var forthButton = document.getElementById("fourth_button");

function toggleFirst() {
    
}

function openCompetitionsDropdown() {
    var compDropdown = document.getElementById("competition_dropdown");

    compDropdown.classList.toggle("closed");
}
/*
var slideIndex = 0;

slideShow();

function slideShow() {
    
    var i = 0;
    var slides = document.getElementsByClassName("slide");*/

//SLIDESHOW

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

      /*for (i = 0; i < slides.length; i++) {
        slides[i].classList.add("hidden");
      }*/

      slideNumber = 1;
    }



 }, 2000);




//SLIDESHOW END
