/* navigatation */
status = "opened";

var cotext = document.getElementById("controls_text");
var ovtext = document.getElementById("overview_text");
var setext = document.getElementById("setup_text");
var navBar = document.querySelector("nav");
var appName = document.getElementById("app_name");
var menuSection = document.getElementById("header_left");
var menuButton = document.getElementById("menu_button")
var pin = document.getElementById("navigation_pin");

var navbarItems = document.querySelectorAll("button.navigation_item");
var dropDownIcons = document.querySelectorAll(".dropdown_icon");

function toggle_navigation() {
    navBar.classList.toggle("closed");
    appName.classList.toggle("closed");
    menuSection.classList.toggle("closed");
    menuButton.classList.toggle("closed");

    if (status == "closed") {
        ovtext.innerHTML = "OVERVIEW";
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

        for (i = 0; i < navbarItems.length; i++) {
            navbarItems[i].nextElementSibling.classList.add("hidden");
            dropDownIcons[i].classList.remove("closed");
        }
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
        document.cookie = "navbar_status = pinned;" + setExpireDay(365);
    }
    else {
        document.cookie = "navbar_status = notPinned;" + setExpireDay(365);
    }
}
//Saves the status of the pin
var navbar_status = cookieFinder('navbar_status', 'pinned', false, 365)

//Opens the navbar
function closed_navigation() {
    navBar.classList.add("closed");
    appName.classList.add("closed");
    menuSection.classList.add("closed");
    ovtext.innerHTML = "O";
    cotext.innerHTML = "C";
    setext.innerHTML = "S";
    status = "closed";

    for (i = 0; i < navbarItems.length; i++) {
        navbarItems[i].nextElementSibling.classList.add("hidden");
        dropDownIcons[i].classList.remove("closed");
    }
}
//Checks the saved pin status. If the status is "pinned" it calls the opened_navigation function.
if (navbar_status == "notPinned" && navBar != null) {
    closed_navigation();
    pin.classList.remove("pinned")
}

/* Toggle Nav Dropdow  */
function toggleDropdown(x) {
    //Gets the right index
    var index = Array.from(navbarItems).indexOf(x);
    navbarItems[index].nextElementSibling.classList.toggle("hidden");
    dropDownIcons[index].classList.toggle("closed");
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
    togglePanel(lang_panel);
}


function toggleColormodePanel() {
    togglePanel(color_panel);
}

function toggleProfilePanel() {
    togglePanel(profile_panel);
}

function togglePanel(currentPanel) {
    //Making every panel hidden.
    for (i = 0; i < elements.length; i++) {
        elements[i].classList.add("hidden")
    }
    //Checking if the current panel equals the oldClickedelement.
    if (currentPanel == oldClickedelement) {
        //If yes it removes the class.
        currentPanel.classList.remove("hidden");
    }
    //Toggles the class.
    currentPanel.classList.toggle("hidden");
    //Checking if the current panel class contains hidden.
    if (currentPanel.classList.contains("hidden")) {
        //If yes it sets the oldClickedelement undifend.
        oldClickedelement = undefined;
    }
    else {
        //If not it sets the oldClickedelement to the current panel.
        oldClickedelement = currentPanel;
    }
    //currentPanel.classList.toggle("hidden");
}

// Disables transition on Pageload
window.addEventListener('DOMContentLoaded', (event) => {
    document.body.classList.add("preload");

    var current_cs = cookieFinder("theme", "", false, 365);
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
var colorModes = csWrapper.querySelectorAll(".color_mode");

function setToLight() {
    document.documentElement.setAttribute('data-theme', '');
    document.cookie = "theme = ;" + setExpireDay(365)
    //colorModes[0].checked = true;
    colorModeClassRemover();
    colorModes[0].classList.add("selected")
    clrVariations.style.visibility = "visible";
    contentThemeSetter();
}

var clrVariations = document.querySelector(".color_variations")

function setToHighContrast() {
    document.documentElement.setAttribute('data-theme', 'highcontrast');
    document.cookie = "theme = highcontrast;" + setExpireDay(365);
    //colorModes[1].checked = true;
    colorModeClassRemover();
    colorModes[1].classList.add("selected")
    clrVariations.style.visibility = "hidden";
    document.documentElement.removeAttribute('data-content-theme');
}

function setToDark() {
    document.documentElement.setAttribute('data-theme', 'dark');
    document.cookie = "theme = dark;" + setExpireDay(365);
    //colorModes[2].checked = true;
    colorModeClassRemover()
    colorModes[2].classList.add("selected")
    clrVariations.style.visibility = "visible";
    contentThemeSetter();
}

function colorModeClassRemover() {
    for (i = 0; i < colorModes.length; i++) {
        colorModes[i].classList.remove("selected")
    }
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
function setToDanube() {
    var danubeColorButton = document.querySelector(".color_square.danube")
    setColor(danubeColorButton, "danube")
}

//Sets the colormode to vanilla
function setToVanilla() {
    var vanillaColorButton = document.querySelector(".color_square.vanilla")
    setColor(vanillaColorButton, "vanilla");
}

function setColor(colorVar, colorToSet) {
    classRemover();
    colorVar.classList.add("selected")
    document.documentElement.setAttribute('data-content-theme', colorToSet);
    //Saves the colormode
    document.cookie = "colorMode = " + colorToSet + ";" + setExpireDay(365);
    colorMode = cookieFinder("colorMode", colorToSet, false, 365);
}

var colorMode = cookieFinder("colorMode", "vanilla", false, 365);
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

/*
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
*/


//Prevents typing invalid chars. to the number input
var numberInputs = document.querySelectorAll("input[type='number']")
numberInputs.forEach(item => {
    item.addEventListener("input", function (e) {
        item.value = item.value.match("[0-9]*$")
    })

})



var stripeButtons = document.querySelectorAll(".stripe_button")
var barCodeForm = document.getElementById("barcode_form")
var canAddHoverClass = true;
//searchBarClosed is a var. from search.js
searchBarClosed = true;
document.addEventListener("keydown", function (e) {
    if (searchBarClosed && !somethingIsFocused) {
        if (e.shiftKey && canAddHoverClass) {
            for (i = 0; i < stripeButtons.length; i++) {
                stripeButtons[i].classList.add("hover")
            }
            if (barCodeForm != undefined) {
                barCodeForm.classList.add("hover")
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
            if (barCodeForm != undefined) {
                barCodeForm.classList.remove("hover")
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

var compSelect = document.getElementById("competition_select")

function toggleCompSelect() {
    compSelect.classList.toggle("opened")
}

//Disables hot keys when a text or input is focused
var somethingIsFocused = false;
var somethingisOpened = false;
var textAreas = document.querySelectorAll("input, textarea")
textAreas.forEach(item => {
    item.addEventListener("focus", function () {
        somethingIsFocused = true
    });
    item.addEventListener("blur", function () {
        somethingIsFocused = false
    });
})

function inputValueLimiter(x, maxValue, minValue) {
    if (x.value > maxValue) {
        x.value = maxValue
    }
    else if (x.value.length > 1 && x.value[0] == "0") {
        x.value = "0"
    }
    else if (x.value < minValue) {
        x.value = minValue
    }
}

function toggleBarCodeInput(x) {
    var button = x.previousElementSibling;
    button.classList.toggle("active");
}


function closeAside() {
    /* Variables declared inside so pages without aside dont store unused nd undefined variables */
    /* Decalred with varibles so it doesn't rely on html nesting relations */
    var aside = document.querySelector("aside");
    var asideButton = document.querySelector(".aside_button");
    aside.classList.toggle("closed");
    asideButton.classList.toggle("closed");
}
