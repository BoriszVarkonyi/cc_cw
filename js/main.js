/* navigatation */
status = "opened";

var cotext = document.getElementById("controls_text");
var ovtext = document.getElementById("overview_text");
var setext = document.getElementById("setup_text");
var navBar = document.getElementById("nav_bar");
var appName = document.getElementById("app_name");
var menuSection = document.getElementById("menu_button_section");
var menuButton = document.getElementById("menu_button");
var dtDrop = document.getElementById("dt_dropdown_icon");
var genDrop = document.getElementById("general_dropdown_icon");
var techDrop = document.getElementById("technical_dropdown_icon");

function toggle_nav_bar() {
    navBar.classList.toggle("closed");
    appName.classList.toggle("closed");
    menuSection.classList.toggle("closed");
    menuButton.classList.toggle("closed");
    dtDrop.classList.toggle("closed");
    genDrop.classList.toggle("closed");
    techDrop.classList.toggle("closed");

    if (status == "closed") {
        ovtext.innerHTML = "OVERVIEW";
        cotext.innerHTML = "CONTROLS";
        setext.innerHTML = "SETUP";
        status = "opened";
    }

    else if (status == "opened"){
        ovtext.innerHTML = "O";
        cotext.innerHTML = "C";
        setext.innerHTML = "S";
        status = "closed";
    }
}

// Disables transition on Pageload

window.addEventListener('DOMContentLoaded', (event) => {
    document.body.classList.add("preload");
});

window.addEventListener('load', (event) => {
    document.body.classList.remove("preload");
});

// Toggle panels
// Getting panels by id

var lang_panel = document.getElementById("language_panel");
var color_panel = document.getElementById("colormode_panel");
var profile_panel = document.getElementById("profile_panel");

//Getting every panel
var elements = document.querySelectorAll(".overlay_panel");
var oldClickedelement;

//Toggle language panel

function toggle_language_panel() {
   /* //Making every panel hidden.
    for(i=0; i<elements.length; i++){
        elements[i].classList.add("hidden")
    }
    //Checking if the lang panel equals the oldClickedelement.
    if(lang_panel == oldClickedelement) {
        //If yes it removes the class.
        lang_panel.classList.remove("hidden");
    }
    //Toggles the class.
    lang_panel.classList.toggle("hidden");
    //Checking if the lang panel class contains hidden.
    if(lang_panel.classList.contains("hidden")) {
        //If yes it sets the oldClickedelement undifend.
        oldClickedelement = undefined;
    }
    else {
        //If not it sets the oldClickedelement to the lang panel.
        oldClickedelement = lang_panel;
    } */
    lang_panel.classList.toggle("hidden");
}


function toggle_colormode_panel() {
   /* //Making every panel hidden
    for(i=0; i<elements.length; i++){
        elements[i].classList.add("hidden")
    }

    if(color_panel == oldClickedelement) {
        color_panel.classList.remove("hidden");
    }

    color_panel.classList.toggle("hidden");

    if(color_panel.classList.contains("hidden")) {
        oldClickedelement = undefined;
    }
    else {
        oldClickedelement = color_panel;
    } */
    color_panel.classList.toggle("hidden");
}

function toggle_profile_panel() {
   /* //Making every panel hidden
    for(i=0; i<elements.length; i++){
        elements[i].classList.add("hidden")
    }

    if(profile_panel == oldClickedelement) {
        profile_panel.classList.remove("hidden");
    }

    profile_panel.classList.toggle("hidden");

    if(profile_panel.classList.contains("hidden")) {
        oldClickedelement = undefined;
    }
    else {
        oldClickedelement = profile_panel;
    } */
    profile_panel.classList.toggle("hidden");
}

/* Toggle Nav Dropdow  */

function toggle_dt_dropdown() {
    var dt_drop = document.getElementById("dt_dropdown_menu");
    var dt_drop_icon = document.getElementById("dt_dropdown_icon");
    dt_drop.classList.toggle("hidden");
    dt_drop_icon.classList.toggle("close");
}

function toggle_general_dropdown() {
    var dt_drop = document.getElementById("general_dropdown_menu");
    var dt_drop_icon = document.getElementById("general_dropdown_icon");
    dt_drop.classList.toggle("hidden");
    dt_drop_icon.classList.toggle("close");
}

function toggle_technical_dropdown() {
    var dt_drop = document.getElementById("technical_dropdown_menu");
    var dt_drop_icon = document.getElementById("technical_dropdown_icon");
    dt_drop.classList.toggle("hidden");
    dt_drop_icon.classList.toggle("close");
}

/*  Color changer */

window.addEventListener('DOMContentLoaded', (event) => {
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


var hasBackgroundIcon = document.querySelectorAll("input");
var icons = document.querySelectorAll('img[src$=".svg"]:not(.not_icon), input.backgroundImage');
var csWrapper = document.getElementById("color_mode_wrapper");
var colorModes = csWrapper.getElementsByTagName("input");
console.log(colorModes)

function setToLight() {
    document.documentElement.setAttribute('data-theme', '');
    localStorage.setItem('theme', '');
    colorModes[0].checked = true;

    for (var i = 0; i < icons.length; i++) {
        icons[i].style.filter = "contrast(71%)";
    }

    for (var i = 1; i < hasBackgroundIcon.length; i++) {
        hasBackgroundIcon[i].style.filter = "";
    }
}

function setToHighContrast() {
    document.documentElement.setAttribute('data-theme', 'highcontrast');
    localStorage.setItem('theme', 'highcontrast');
    colorModes[1].checked = true;

    for (var i = 0; i < icons.length; i++) {
        icons[i].style.filter = "invert(100%) grayscale(100%) brightness(150%) sepia(90%) hue-rotate(5deg) saturate(5000%) contrast(1)";
    }
    for (i = 1; i < hasBackgroundIcon.length; i++) {
        hasBackgroundIcon[i].style.filter = "invert(100%) grayscale(100%) brightness(150%) sepia(90%) hue-rotate(5deg) saturate(5000%) contrast(1)";
    }
}

function setToDark() {
    document.documentElement.setAttribute('data-theme', 'dark');
    localStorage.setItem('theme', 'dark');
    colorModes[2].checked = true;

    for (var i = 0; i < icons.length; i++) {
        icons[i].style.filter = "invert(100%)";
    }
    for (i = 1; i < hasBackgroundIcon.length; i++) {
        hasBackgroundIcon[i].style.filter = "invert(100%)";
    }
}

//If technician, Disable setup section

var suti = document.cookie;
var suti_list = suti.split("; ");

if(suti_list.includes("lastlogin=" + 2)){

var dds = document.getElementsByClassName("setup_dropdown");
console.log(dds);

for(i = 0; i < dds.length; i++){

    dds[i].classList.add("disabled");
    dds[i].onclick = "";

   }

  var set = document.getElementsByClassName("setup");
  console.log(set);

for(i = 0; i < set.length; i++){

    set[i].classList.add("disabled");
    set[i].href = "";

   }
var setuptext = document.getElementById("setup_text");
setuptext.classList.add("disabled");

}

/* Table Column resizer */

document.addEventListener("click", resizeTableColumn());

function resizeTableColumn() {
    var tableHeader = document.querySelector(".table_header");
    var tableHeaderText = document.querySelectorAll(".table_header_text");
    var tableRow = document.querySelectorAll(".table_row");
    var tableItem = document.querySelectorAll(".table_item");
    var amountOfColumns = tableHeaderText.length;
    var singeColumn = 1;
    var i;

    //console.log(amountOfColumns);

    for(i = 1; i <= amountOfColumns; i++){

        //console.log("");
    }
}



// Overlay_panels

var overlayPanelAll = document.querySelectorAll(".overlay_panel");
var overlayPanelsOepened = [];
var somethingisOpened = false;

function overlayPanel() {
    var overlayPanelsHidden = [];
    //Push to appropriate array by class.
    for(i=0; i<overlayPanelAll.length; i++) {
        if(overlayPanelAll[i].classList.contains("hidden")) {
            overlayPanelsHidden.push(overlayPanelAll[i]);
        }
        else {
            overlayPanelsOepened.push(overlayPanelAll[i])
        }
    }
    //It updates the overlayPanelsOepened array.
    if(overlayPanelsOepened.length>1){
        for(i=0; i<overlayPanelsOepened.length; i++) {
            overlayPanelsOepened.pop()
        }
        overlayPanelsOepened[0].classList.add("hidden")
        overlayPanelsOepened.pop()
    }
    //Check if the first array element contains hidden.
    else {
        for(i=0; i<overlayPanelsOepened.length; i++) {
            //If yes it pops.
            if(overlayPanelsOepened[i].classList.contains("hidden")) {
                overlayPanelsOepened.pop()
            }
        }
    }
    if(overlayPanelsOepened.length == 1){
        somethingisOpened = true;
    }
    else{
        somethingisOpened = false;
    }
}
var somethingisOpened = false;

//Event listener to class change (overlay panels)
function callback(mutationsList, observer) {
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
            overlayPanel()
            formvariableDeclaration()
        }
    })
}
    
const mutationObserver = new MutationObserver(callback)
for(i=0; i<overlayPanelAll.length; i++){
mutationObserver.observe(overlayPanelAll[i], { attributes: true })
}

//Prevents typing invalid chars. to the number input
var invalidChars = ["-", "+", "e", "E"];
var numberInputs = document.querySelectorAll("input[type='number']")
numberInputs.forEach(item => { 
    item.addEventListener("keydown", function(e) {
        if (invalidChars.includes(e.key)) {
            e.preventDefault();
        }
        }
    );
})
//Search engine
var selectedElementIndex = 0;
var liCounter;
function searchEngine(x) {
    // Declare variables
    var input = x
    var filter = input.value.toUpperCase();
    var ul = input.nextElementSibling;
    var li = ul.getElementsByTagName('a');
    ul.classList.remove("empty")
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
      a = li[i];
      txtValue = a.textContent || a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }

    }
    var allDisplay = false;
    for (i = 0; i < li.length; i++) {
        if(li[i].style.display === "") {
            allDisplay = true
            break;
        }
    }
    if(!allDisplay) {
        ul.classList.add("empty")

    }
    //Search engine arrow system
    liCounter = 0;
    for(i=0; i<li.length; i++){
        if(li[i].style.display === "") {
            liCounter++
        }
    }
    //importOverlayClosed is a var. from importoverlay.js
    importOverlayClosed = true;
    input.onkeydown = (keyDownEvent) => {
        if(importOverlayClosed){
            if(keyDownEvent.key == "ArrowUp"){
                if(selectedElementIndex == 0) {
                    selectedElementIndex++
                }
                selectedElementIndex--
                li[selectedElementIndex + 1].classList.remove("selected")
                li[selectedElementIndex].classList.add("selected")
            }
            if(keyDownEvent.key == "ArrowDown"){
                if(selectedElementIndex == liCounter -1) {
                    selectedElementIndex--
                }
                selectedElementIndex++
                li[selectedElementIndex - 1].classList.remove("selected")
                li[selectedElementIndex].classList.add("selected")
            }
        }       
    }
    
}
function resultChecker(x){
    var input = x
    var ul = input.nextElementSibling;
    var li = ul.getElementsByTagName('a');
    var field = document.getElementById("inputs");
    x.value = ""
    liCounter = 0;
    for (i = 0; i < li.length; i++) {
        liCounter++
        li[i].style.display = "";
    }
    if(li.length == 0) {
        ul.classList.add("empty")
    }
    else {
        for(i=0; i<li.length; i++){
            li[i].classList.remove("selected")
        }
        selectedElementIndex = 0;
        li[selectedElementIndex].classList.add("selected")
    }
}

//Clears the search 
var clearButton = document.querySelectorAll(".clear_search_button")
clearButton.forEach(item => {
    item.addEventListener("click", function(event){
        var targetElement = event.target || event.srcElement;
        var searchBar = targetElement.parentNode.nextElementSibling;
        searchBar.value = ""
    });
})

//FORM VALIDATION

function formvariableDeclaration(overlayForm, inputs, saveButton) {
    if(overlayPanelsOepened.length == 1) {
     var formelement = overlayPanelsOepened[0].firstChild.nextElementSibling.nextElementSibling;
        if(formelement.classList.contains("overlay_panel_form")){
            return overlayForm = document.querySelector(".overlay_panel:not( .hidden) .overlay_panel_form"), 
            inputs = document.querySelectorAll(".overlay_panel:not( .hidden) .overlay_panel_form input"), 
            saveButton = document.querySelector(".overlay_panel:not( .hidden) .overlay_panel_form .panel_submit"),
            formValidation(overlayForm, inputs, saveButton);
        }
    }
}
var canAutoValidate = true;
function formValidation(overlayForm, inputs, saveButton){
    if(canAutoValidate){
        saveButton.disabled = true;
        //If the document values are changing, it runs the function.
        function validation(){
            //Checking every input.
            for(i=0; i<inputs.length; i++){
                if(inputs[i].value == ""){
                    //If it finds an empty input, then it disable the "Save" button.
                    saveButton.disabled = true;
                    break;      
                }
                else {
                    //If everything has a value then it enable the "Save" Button. The user can save.
                    saveButton.disabled = false;       
                }
            }   

        }
        validation();
        overlayForm.addEventListener("input", validation)
    }    

}
var stripeButtons = document.querySelectorAll(".stripe_button")
var canAddHoverClass = true;
//searchBarClosed is a var. from control.js
searchBarClosed = true;
document.addEventListener("keydown", function(e){
    //searchBarClosed is a var. from control.js
    if(searchBarClosed){
        if(e.shiftKey && canAddHoverClass) {
            for(i=0; i<stripeButtons.length; i++){
                stripeButtons[i].classList.add("hover")
            }
            canAddHoverClass = false;
        }
    }    
})
document.addEventListener("keyup", function(e){
    //searchBarClosed is a var. from control.js
    if(searchBarClosed){
        if(e.key == "Shift") {
            for(i=0; i<stripeButtons.length; i++){
                stripeButtons[i].classList.remove("hover")
            }
            canAddHoverClass = true;
        }
    }        
})

