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

var slideIndex = 0;
slideShow();

function slideShow() {
    
    var i;
    var slides = document.getElementsByClassName("slide");

    for (i = 0; i < slides.length; i++) {
     // slides[i].style.display = "none";  
    }
    
    slideIndex++;

    if (slideIndex > slides.length) {slideIndex = 1}    

    slides[slideIndex-1].style.display = "flex";   

    setTimeout(slideShow, 5000);
}