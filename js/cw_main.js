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
//selects the body
var body = document.querySelector("body");
//gets the classname of the body
var className = body.classList.value;
//selects all navigation buttons
var navigationButtons = document.querySelectorAll("#navigation > div");
//remove current class from every navigatiob button
for(i=0; i<navigationButtons.length; i++){
    navigationButtons[i].classList.remove("current")
}
//adds current class to the appropirate navigation button
switch(className){
    case "home" : navigationButtons[0].classList.add("current");
    break;
    case "competitions" : navigationButtons[1].classList.add("current");
    break;
    case "blog" : navigationButtons[2].classList.add("current");
    break;
    case "videos" : navigationButtons[3].classList.add("current");
    break;
    case "rankings" : navigationButtons[4].classList.add("current");
    break;
    case "saved_competitions" : navigationButtons[5].classList.add("current");
    break;
}
