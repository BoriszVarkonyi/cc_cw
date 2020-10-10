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
//END

window.addEventListener('load', (event) => {
    document.body.classList.remove("preload");

});


/* toggle panels */

function toggle_language_panel() {
    var lang_panel = document.getElementById("language_panel");
    var color_panel = document.getElementById("colormode_panel");

    if (color_panel.classList.contains("hidden")) {
        lang_panel.classList.toggle("hidden");
    } else {
        color_panel.classList.toggle("hidden");
        lang_panel.classList.toggle("hidden");
    }
}

function toggle_colormode_panel() {
    var lang_panel = document.getElementById("language_panel");
    var color_panel = document.getElementById("colormode_panel");

    if (lang_panel.classList.contains("hidden")) {
        color_panel.classList.toggle("hidden");

    } else {
        lang_panel.classList.toggle("hidden");
        color_panel.classList.toggle("hidden");
    }
}

function toggle_profile_panel() {
    var element = document.getElementById("profile_panel");
    element.classList.toggle("hidden");
}

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

//END

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
var disabledNavbarItems = document.querySelectorAll(".nav_bar_item.disabled");
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










//END

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




/* table column resizer */

document.addEventListener("click", resizeTableColumn());

function resizeTableColumn() {
    var tableHeader = document.querySelector(".table_header");
    var tableHeaderText = document.querySelectorAll(".table_header_text");
    var tableRow = document.querySelectorAll(".table_row");
    var tableItem = document.querySelectorAll(".table_item");
    var amountOfColumns = tableHeaderText.length;
    var singeColumn = 1;
    var i;

    console.log(amountOfColumns);

    for(i = 1; i <= amountOfColumns; i++){

        console.log("");
    }

    





}





//END

