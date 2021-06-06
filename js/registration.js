var addFencerPanel = document.getElementById("add_fencer_panel");
var regInButton = document.getElementById("regIn")
var regOutButton = document.getElementById("regOut")

function toggleAddFencerPanel() {
    addFencerPanel.classList.remove("hidden");
}

function setClub(x) {
    var field = document.getElementById("set_club_input");
    field.value = x.innerHTML;
    formvariableDeclaration()
}

function setNation(x) {
    var field = document.getElementById("set_nation_input");
    field.value = x.innerHTML;
    formvariableDeclaration()
}

var tableRows = document.querySelectorAll("#page_content_panel_main table tr")
//Event listener to class change
function callback(mutationsList, observer) {
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
            buttonDisabler()
        }
    })
}

const mutationObserver3 = new MutationObserver(callback)
for (i = 0; i < tableRows.length; i++) {
    mutationObserver3.observe(tableRows[i], { attributes: true })
}

var registrationtable = document.querySelector("#page_content_panel_main table")
registrationtable.addEventListener("click", buttonDisabler)
var isselected = false;

function buttonDisabler() {
    var selectedItem = document.querySelector("#page_content_panel_main table .selected")
    if (selectedItem !== null) {
        regInButton.classList.remove("disabled");
        regOutButton.classList.remove("disabled");
        isselected = true;
    }
    else {
        regInButton.classList.add("disabled");
        regOutButton.classList.add("disabled");
        isselected = false;
    }
}

document.addEventListener("keyup", function (e) {
    //somethingisOpened is a var. from main.js
    //somethingIsFocused is a var. from main.js
    if (!somethingisOpened && !somethingIsFocused) {
        //Opens add registration to Shift+A
        if (e.shiftKey && e.which == 65) {
            var addfencer = document.getElementById("addFencer")
            addfencer.click()
        }
        if (isselected) {
            //Regist out to Shift+O
            if (e.shiftKey && e.which == 79) {
                regOutButton = document.getElementById("regOut")
                regOutButton.click()
            }
            //Regists in to Shift+I
            if (e.shiftKey && e.which == 73) {
                regInButton = document.getElementById("regIn")
                regInButton.click()
            }
        }
    }
})

//Add fencer overlay button and title system
var leftDivisionButton = document.getElementById("overlayPanelButtonLeft");
var rightDivisionButton = document.getElementById("overlayPanelButtonRight");
var currentTitle = document.querySelector(".overlay_panel_controls p");
var overlayPanelDivisions = document.querySelectorAll(".overlay_panel_division");
var controlsCounter = document.querySelector(".overlay_panel_controls_counter");
var maxNumber = overlayPanelDivisions.length;
var currentDivision = 0;

leftDivisionButton.disabled = true;
currentTitle.innerHTML = overlayPanelDivisions[currentDivision].getAttribute("overlay_division_title")
controlsCounter.innerHTML = maxNumber + " / " + (currentDivision + 1);

function leftButton(x) {
    currentDivision--
    overlayPanelDivisions[currentDivision + 1].classList.remove("visible")
    overlayPanelDivisions[currentDivision].classList.add("visible")
    currentTitle.innerHTML = overlayPanelDivisions[currentDivision].getAttribute("overlay_division_title")
    controlsCounter.innerHTML = maxNumber + " / " + (currentDivision + 1);
    divisionButtonDisabler();
}

function rightButton(x) {
    currentDivision++
    overlayPanelDivisions[currentDivision - 1].classList.remove("visible");
    overlayPanelDivisions[currentDivision].classList.add("visible");
    currentTitle.innerHTML = overlayPanelDivisions[currentDivision].getAttribute("overlay_division_title");
    controlsCounter.innerHTML = maxNumber + " / " + (currentDivision + 1);
    divisionButtonDisabler();
}

function divisionButtonDisabler() {
    if (currentDivision == 0) {
        leftDivisionButton.disabled = true;
    }
    else {
        leftDivisionButton.disabled = false;
    }

    if (currentDivision == maxNumber - 1) {
        rightDivisionButton.disabled = true;
    }
    else {
        rightDivisionButton.disabled = false;
    }
}

//Club Nation deleter
var clubAndNationInput = document.querySelectorAll("#set_nation_input")
clubAndNationInput.forEach(item => {
    item.addEventListener("keyup", function (e) {
        var ul = item.nextElementSibling.nextElementSibling;
        if (ul.classList.contains("empty")) {
            item.value = "";
            ul.classList.remove("empty")
            ul.classList.add("error")
        }
        else {
            ul.classList.remove("error")
        }
    })
})
