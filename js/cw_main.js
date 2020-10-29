var firstButton = document.getElementById("first_button");
var secondButton = document.getElementById("second_button");
var thirdButton = document.getElementById("third_button");
var forthButton = document.getElementById("fourth_button");

function openCompetitionsDropdown() {
    var compDropdown = document.getElementById("competition_dropdown");
    compDropdown.classList.toggle("closed");
}

function printPage() {
    window.print();
  }