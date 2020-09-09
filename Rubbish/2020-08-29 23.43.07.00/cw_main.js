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

var slides = document.querySelectorAll(".slide");

document.addEventListener("load", slideShow());

function slideShow() {

    slides[1].style.add

    var i;
    for (i = 0; i < slides.length; i++) {
      slides[i].style.border = "10px solid red";
    }
}