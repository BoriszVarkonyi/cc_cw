/* navigatation */
status = "opened";

var cotext = document.getElementById("controls_text");
var ovtext = document.getElementById("overview_text");
var setext = document.getElementById("setup_text");

function toggle_nav_bar() {

    var element = document.getElementById("nav_bar");
    element.classList.toggle("closed");
    var element = document.getElementById("app_name");
    element.classList.toggle("closed");
    var element = document.getElementById("menu_button_section");
    element.classList.toggle("closed");
    var element = document.getElementById("menu_button");
    element.classList.toggle("closed");
    var i;

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

    var element = document.getElementById("dt_dropdown_icon");
    element.classList.toggle("closed");
    var element = document.getElementById("general_dropdown_icon");
    element.classList.toggle("closed")
    var element = document.getElementById("technical_dropdown_icon");
    element.classList.toggle("closed")

}


window.addEventListener('load', (event) => {
    document.body.classList.remove("preload");
});

/*Toggle panels.*/
//Getting panels by id.
var lang_panel = document.getElementById("language_panel");
var color_panel = document.getElementById("colormode_panel");
var profile_panel = document.getElementById("profile_panel");
//Getting every panel.
var elements = document.querySelectorAll(".overlay_panel");
var oldClickedelement;

//Toggle language panel.
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


/* Toggle nav ropdpws  */

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



/*  Color changer    */

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

document.getElementById("cs_range").addEventListener("click", csChanger);

var hasBackgroundIcon = document.querySelectorAll("input");

var icons = document.querySelectorAll('img[src$=".svg"]:not(.not_icon), input.backgroundImage');
var i;
var disabledNavbarItems = document.querySelectorAll('.nav_bar_item.disabled');
var disabledStripeButtons = document.querySelectorAll(".stripe_button.disabled");

for (i = 0; i < disabledNavbarItems.length; i++) {
    disabledNavbarItems[i].style.filter = "contrast(50%)";
}

for (i = 0; i < disabledStripeButtons.length; i++) {
    disabledStripeButtons[i].style.filter = "contrast(30%)";
}

function csChanger() {
    
    var cs_range = document.getElementById("cs_range");
    var cs_option = cs_range.value;

    var light = 1;
    var highcontrast = 2;
    var dark = 3;


    if (cs_option == light) {
        setToLight();
    }

    if (cs_option == highcontrast) {
        setToHighContrast();
    }

    if (cs_option == dark) {
        setToDark();
    }
}

var cs_range = document.getElementById("cs_range");

function setToLight() {
    document.documentElement.setAttribute('data-theme', '');
    localStorage.setItem('theme', '');
    cs_range.value = "1";

    for (i = 0; i < icons.length; i++) {
        icons[i].style.filter = "contrast(71%)";
    }

    for (i = 1; i < hasBackgroundIcon.length; i++) {
        hasBackgroundIcon[i].style.filter = "";
    }
}

function setToHighContrast() {
    document.documentElement.setAttribute('data-theme', 'highcontrast');
    localStorage.setItem('theme', 'highcontrast');
    cs_range.value = "2";

    for (i = 0; i < icons.length; i++) {
        icons[i].style.filter = "invert(100%) grayscale(100%) brightness(150%) sepia(90%) hue-rotate(5deg) saturate(5000%) contrast(1)";
    }

    for (i = 1; i < hasBackgroundIcon.length; i++) {
        hasBackgroundIcon[i].style.filter = "invert(100%) grayscale(100%) brightness(150%) sepia(90%) hue-rotate(5deg) saturate(5000%) contrast(1)";
    }

}

function setToDark() {
    document.documentElement.setAttribute('data-theme', 'dark');
    localStorage.setItem('theme', 'dark');
    cs_range.value = "3";

    for (i = 0; i < icons.length; i++) {
        icons[i].style.filter = "invert(100%)";
    }

    for (i = 1; i < hasBackgroundIcon.length; i++) {
        hasBackgroundIcon[i].style.filter = "invert(100%)";
    }
}



//If technician, disable setup section

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

        console.log("");
    }
}



/* Overlay_panels*/

var overlayPanelAll = document.querySelectorAll(".overlay_panel");
var overlayPanelsOepened = [];

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
}

//Event listener to class change (overlay panels)
function callback(mutationsList, observer) {
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
            overlayPanel()
        }
    })
}
    
const mutationObserver = new MutationObserver(callback)
for(i=0; i<overlayPanelAll.length; i++){
mutationObserver.observe(overlayPanelAll[i], { attributes: true })
}



