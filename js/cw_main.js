var languagesPanel = document.getElementById("change_language_panel");
var currentLang;

function toggleLanguagesPanel(x) {
    var languagesButton = x;
    languagesButton.classList.toggle("opened");
    languagesButton.innerHTML = "Select Language";
    languagesPanel.classList.toggle("opened")
}

var mobileNavigation = document.getElementById("mobile_navigation");
function toggleMobileNavigation(x) {
    var mobileNavButton = x;
    mobileNavButton.classList.toggle("opened")
    mobileNavigation.classList.toggle("opened");
}

var compDropdown = document.getElementById("competitions_navigation");
function toggleCompetitionsPanel(x) {
    var competitionsNavButton = x;
    competitionsNavButton.classList.toggle("opened");
    compDropdown.classList.toggle("opened");
    console.log(compDropdown)
}

var bodyClass = document.querySelector("body");
var navigationButtons = document.querySelectorAll("#navigation > div")
var className = bodyClass.classList.value;
for(i=0; i<navigationButtons.length; i++){
    navigationButtons[i].classList.remove("current")
}
console.log(document.querySelectorAll("#navigation > div")[5])
switch(className){
    case "home" : document.querySelectorAll("#navigation > div")[0].classList.add("current")
    break;
    case "competitions" : document.querySelectorAll("#navigation > div")[1].classList.add("current")
    break;
    case "blog" : document.querySelectorAll("#navigation > div")[2].classList.add("current")
    break;
    case "videos" : document.querySelectorAll("#navigation > div")[3].classList.add("current")
    break;
    case "rankings" : document.querySelectorAll("#navigation > div")[4].classList.add("current")
    break;
    case "saved_competitions" : document.querySelectorAll("#navigation > div")[5].classList.add("current")
    break;

}
