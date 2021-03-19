/* navigatation */
status = "closed";

var cotext = document.getElementById("controls_text");
//var cmtext = document.getElementById("communications_text");
var ovtext = document.getElementById("overview_text");
var setext = document.getElementById("setup_text");
var navBar = document.getElementById("nav_bar");
var appName = document.getElementById("app_name");
var menuSection = document.getElementById("menu_button_section");
var menuButton = document.getElementById("menu_button");
var pin = document.getElementById("nav_bar_pin");

var dtDropIcon = document.getElementById("dt_dropdown_icon");
var gnDropIcon = document.getElementById("general_dropdown_icon");
var thDropIcon = document.getElementById("technical_dropdown_icon");

var dtDrop = document.getElementById("dt_dropdown_menu");
var gnDrop = document.getElementById("general_dropdown_menu");
var thDrop = document.getElementById("technical_dropdown_menu");

function toggle_nav_bar() {
    navBar.classList.toggle("closed");
    appName.classList.toggle("closed");
    menuSection.classList.toggle("closed");
    menuButton.classList.toggle("closed");
    dtDropIcon.classList.toggle("close");
    gnDropIcon.classList.toggle("close");
    thDropIcon.classList.toggle("close");

    if (status == "closed") {
        ovtext.innerHTML = "OVERVIEW";
        //cmtext.innerHTML = "COMMUNICATIONS";
        cotext.innerHTML = "CONTROLS";
        setext.innerHTML = "SETUP";
        status = "opened";
    }
    else if (status == "opened") {
        //cmtext.innerHTML = "C";
        ovtext.innerHTML = "O";
        cotext.innerHTML = "C";
        setext.innerHTML = "S";
        status = "closed";

        dtDrop.classList.add("hidden");
        dtDropIcon.classList.add("close");

        gnDrop.classList.add("hidden");
        gnDropIcon.classList.add("close");

        thDrop.classList.add("hidden");
        thDropIcon.classList.add("close");
    }
}
//Toggle pin
function togglePinButton(x) {
    x.classList.toggle("pinned");
    pinChecker();
}
//Checks if the pin has pinned class
function pinChecker() {
    if (pin.classList.contains("pinned")) {
        localStorage.setItem('navbar_status', 'pinned');
    }
    else {
        localStorage.setItem('navbar_status', 'notPinned');
    }
}
//Saves the status ofthe pin
const navbar_status = localStorage.getItem('navbar_status');
//Opens the navbar
function opened_nav_bar() {
    navBar.classList.remove("closed");
    appName.classList.remove("closed");
    menuSection.classList.remove("closed");
    menuButton.classList.remove("closed");
    dtDropIcon.classList.remove("close");
    gnDropIcon.classList.remove("close");
    thDropIcon.classList.remove("close");
    ovtext.innerHTML = "OVERVIEW";
    //cmtext.innerHTML = "COMMUNICATIONS";
    cotext.innerHTML = "CONTROLS";
    setext.innerHTML = "SETUP";
    status = "opened";
}
//Checks the saved pin status. If the status is "pinned" it calls the opened_nav_bar function.
if (navbar_status == "pinned" && navBar != null) {
    opened_nav_bar();
    pin.classList.add("pinned")
}

/* Toggle Nav Dropdow  */
function toggle_dtDropdown() {
    dtDrop.classList.toggle("hidden");
    dtDropIcon.classList.toggle("close");
}

function toggle_general_dropdown() {
    gnDrop.classList.toggle("hidden");
    gnDropIcon.classList.toggle("close");
}

function toggle_technical_dropdown() {
    thDrop.classList.toggle("hidden");
    thDropIcon.classList.toggle("close");
}

// Toggle panels
// Getting panels by id

var lang_panel = document.getElementById("language_panel");
var color_panel = document.getElementById("colormode_panel");
var profile_panel = document.getElementById("profile_panel");

//Getting every panel
var elements = document.querySelectorAll(".header_overlay_panel");
var oldClickedelement;

//Toggle language panel

function toggleLanguagePanel() {
    //Making every panel hidden.
    for (i = 0; i < elements.length; i++) {
        elements[i].classList.add("hidden")
    }
    //Checking if the lang panel equals the oldClickedelement.
    if (lang_panel == oldClickedelement) {
        //If yes it removes the class.
        lang_panel.classList.remove("hidden");
    }
    //Toggles the class.
    lang_panel.classList.toggle("hidden");
    //Checking if the lang panel class contains hidden.
    if (lang_panel.classList.contains("hidden")) {
        //If yes it sets the oldClickedelement undifend.
        oldClickedelement = undefined;
    }
    else {
        //If not it sets the oldClickedelement to the lang panel.
        oldClickedelement = lang_panel;
    }
    console.log(oldClickedelement)
    //lang_panel.classList.toggle("hidden");
}


function toggleColormodePanel() {
    //Making every panel hidden
    for (i = 0; i < elements.length; i++) {
        elements[i].classList.add("hidden")
    }

    if (color_panel == oldClickedelement) {
        color_panel.classList.remove("hidden");
    }

    color_panel.classList.toggle("hidden");

    if (color_panel.classList.contains("hidden")) {
        oldClickedelement = undefined;
    }
    else {
        oldClickedelement = color_panel;
    }
    //color_panel.classList.toggle("hidden");
}

function toggleProfilePanel() {
    //Making every panel hidden
    for (i = 0; i < elements.length; i++) {
        elements[i].classList.add("hidden")
    }

    if (profile_panel == oldClickedelement) {
        profile_panel.classList.remove("hidden");
    }

    profile_panel.classList.toggle("hidden");

    if (profile_panel.classList.contains("hidden")) {
        oldClickedelement = undefined;
    }
    else {
        oldClickedelement = profile_panel;
    }
    //profile_panel.classList.toggle("hidden");
}

// Disables transition on Pageload

window.addEventListener('DOMContentLoaded', (event) => {
    document.body.classList.add("preload");

    const current_cs = localStorage.getItem('theme');
    document.documentElement.setAttribute('data-theme', current_cs);
    if (current_cs == "") {
        setToLight();
    }
    if (current_cs == "highcontrast") {
        setToHighContrast();
    }
    if (current_cs == "dark") {
        setToDark();
    }
});

window.addEventListener('load', (event) => {
    document.body.classList.remove("preload");
});

/*  Color changer */

var hasBackgroundIcon = document.querySelectorAll("input");
var icons = document.querySelectorAll('img[src$=".svg"]:not(.not_icon)');
var csWrapper = document.getElementById("color_mode_wrapper");
var colorModes = csWrapper.getElementsByTagName("input");

function setToLight() {
    document.documentElement.setAttribute('data-theme', '');
    localStorage.setItem('theme', '');
    colorModes[0].checked = true;

    clrVariations.style.visibility = "visible";

    for (var i = 0; i < icons.length; i++) {
        //icons[i].style.filter = "contrast(71%)";
        //icons[i].style.filter = "invert()";
    }
    contentThemeSetter();

}

var clrVariations = document.querySelector(".color_variations")

function setToHighContrast() {
    document.documentElement.setAttribute('data-theme', 'highcontrast');
    localStorage.setItem('theme', 'highcontrast');
    colorModes[1].checked = true;

    clrVariations.style.visibility = "hidden";
    document.documentElement.removeAttribute('data-content-theme');
    /*
    for (var i = 0; i < icons.length; i++) {
        icons[i].style.filter = "invert(100%) grayscale(100%) brightness(150%) sepia(90%) hue-rotate(5deg) saturate(5000%) contrast(1)";
    }
    for (i = 1; i < hasBackgroundIcon.length; i++) {
        hasBackgroundIcon[i].style.filter = "invert(100%) grayscale(100%) brightness(150%) sepia(90%) hue-rotate(5deg) saturate(5000%) contrast(1)";
    }
    */
}

function setToDark() {
    document.documentElement.setAttribute('data-theme', 'dark');
    localStorage.setItem('theme', 'dark');
    colorModes[2].checked = true;

    clrVariations.style.visibility = "visible";

    contentThemeSetter();
}

//Page color changer
var colorButtons = document.querySelectorAll(".color_square")
//Removes selected class from the buttons
function classRemover() {
    for (i = 0; i < colorButtons.length; i++) {
        colorButtons[i].classList.remove("selected")
    }
}
//Sets the colormode to danube
function setToDanube(x) {
    var danubeColorButton = document.querySelector(".color_square.danube")
    classRemover();
    danubeColorButton.classList.add("selected")
    document.documentElement.setAttribute('data-content-theme', 'danube');
    //Saves the colormode
    localStorage.setItem('colorMode', 'danube');
    colorMode = localStorage.getItem('colorMode');
}
//Sets the colormode to vanilla
function setToVanilla(x) {
    var vanillaColorButton = document.querySelector(".color_square.vanilla")
    classRemover();
    vanillaColorButton.classList.add("selected")
    document.documentElement.setAttribute('data-content-theme', 'vanilla');
    //Saves the colormode
    localStorage.setItem('colorMode', 'vanilla');
    colorMode = localStorage.getItem('colorMode');
}

var colorMode = localStorage.getItem('colorMode');
//Sets the saved colormode
function contentThemeSetter() {
    if (colorMode == "danube") {
        setToDanube();
    }
    else {
        setToVanilla();
    }
}
contentThemeSetter();

//If technician, Disable setup section

var suti = document.cookie;
var suti_list = suti.split("; ");

if (suti_list.includes("lastlogin=" + 2)) {

    var dds = document.getElementsByClassName("setup_dropdown");
    console.log(dds);

    for (i = 0; i < dds.length; i++) {

        dds[i].classList.add("disabled");
        dds[i].onclick = "";

    }

    var set = document.getElementsByClassName("setup");
    console.log(set);

    for (i = 0; i < set.length; i++) {

        set[i].classList.add("disabled");
        set[i].href = "";

    }
    var setuptext = document.getElementById("setup_text");
    setuptext.classList.add("disabled");

}

//Prevents typing invalid chars. to the number input
var invalidChars = ["-", "+", "e", "E"];
var numberInputs = document.querySelectorAll("input[type='number']")
numberInputs.forEach(item => {
    item.addEventListener("keydown", function (e) {
        if (invalidChars.includes(e.key)) {
            e.preventDefault();
        }
    }
    );
})

var stripeButtons = document.querySelectorAll(".stripe_button")
var canAddHoverClass = true;
//searchBarClosed is a var. from search.js
searchBarClosed = true;
document.addEventListener("keydown", function (e) {
    if (searchBarClosed && !somethingIsFocused) {
        if (e.shiftKey && canAddHoverClass) {
            for (i = 0; i < stripeButtons.length; i++) {
                stripeButtons[i].classList.add("hover")
            }
            canAddHoverClass = false;
        }
    }
})

document.addEventListener("keyup", function (e) {
    //searchBarClosed is a var. from search.js
    if (searchBarClosed && !somethingIsFocused) {
        if (e.key == "Shift") {
            for (i = 0; i < stripeButtons.length; i++) {
                stripeButtons[i].classList.remove("hover")
            }
            canAddHoverClass = true;
        }
    }
})

var loadingBar = document.getElementById("loading_bar");
document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () { loadingBar.classList.add("load") }, 300);
    setTimeout(function () { loadingBar.classList.remove("load"); loadingBar.classList.add("loading") }, 500);

    if (document.readyState === "complete" || document.readyState === "loaded" || document.readyState === "interactive") {
        loadingBar.classList.remove("loading");
        loadingBar.classList.add("loaded");
        setTimeout(function () { loadingBar.classList.remove("loading"); loadingBar.classList.add("finished") }, 1000);
        setTimeout(function () { loadingBar.classList.remove("finished"); loadingBar.remove() }, 1250);
    }
})
/*
function toggleFullscreen(){
    var elem = document.querySelector("body");
    if(window.innerHeight == screen.height){
        if (document.exitFullscreen){
            document.exitFullscreen();
        }
        else if (document.webkitExitFullscreen){
            document.webkitExitFullscreen();
        }
        else if (document.msExitFullscreen){
            document.msExitFullscreen();
        }
        iconChanger();
    }
    else{
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        }
        else if (elem.webkitRequestFullscreen){
            elem.webkitRequestFullscreen();
        }
        else if (elem.msRequestFullscreen){
            elem.msRequestFullscreen();
        }
        iconChanger();
    }
}
function iconChanger(){
    var buttonIcon = document.querySelector("#colormode_button > img");
    if(window.innerHeight == screen.height){
        buttonIcon.src = "../assets/icons/close_fullscreen-black-18dp.svg"
    }
    else{
        buttonIcon.src = "../assets/icons/open_in_full-black-18dp.svg"
    }
}

window.addEventListener("resize", iconChanger);
*/

var compSelect = document.getElementById("competition_select")

function toggleCompSelect() {
    compSelect.classList.toggle("opened")
}

var somethingIsFocused = false;
var textAreas = document.querySelectorAll("input, textarea")
textAreas.forEach(item => {
    item.addEventListener("focus", function () {
        somethingIsFocused = true
    });
    item.addEventListener("blur", function () {
        somethingIsFocused = false
    });
})

