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
    var myIndex = 0;
carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("slide");
        for (i = 0; i < x.length; i++) {
          x[i].style.zIndex = "0";
        }

        myIndex++;

        if (myIndex > x.length) 
        {
          myIndex = 1;
        }

        x[myIndex-1].style.display = "flex"; // Has to be flex if it needs to be displayed
        x[myIndex-1].style.zIndex = "1";

        setTimeout(carousel, 2000); // Change image every 5 seconds
      }

function printPage() {
    window.print();
}
//SLIDESHOW END
