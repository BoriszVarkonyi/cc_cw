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