function toggleImportPanel() {
    var element = document.getElementById("import_technician_panel");
    element.classList.toggle("hidden");
    //importOverlayClosed is a var. from importoverlay.js
    if (element.classList.contains("hidden")) {
        importOverlayClosed = true;
        canAutoValidate = true;
    }
    else {
        importOverlayClosed = false;
        canAutoValidate = false;
    }
}

function setNation(x) {
    var input = x.parentNode.previousElementSibling.previousElementSibling;
    input.value = x.innerHTML;
}

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

canAutoValidate = false


document.addEventListener("keyup", function (e) {
    //somethingisOpened is a var. from main.js
    //somethingIsFocused is a var. from main.js
    if (!somethingisOpened && !somethingIsFocused) {
        if (e.shiftKey && e.which == 65) {
            var addRfrButton = document.getElementById("addRfrBt")
            addRfrButton.click();
        }
        if (e.shiftKey && e.which == 80) {
            var printRfrsButton = document.getElementById("printRfrsBt")
            printRfrsButton.click();
        }
        if (e.shiftKey && e.which == 73) {
            var importRfrsButton = document.getElementById("importRfrsBt")
            importRfrsButton.click();
        }    
        if (e.shiftKey && e.which == 88) {
            var importRfrsXMLButton = document.getElementById("importRfrsXMLBt")
            importRfrsXMLButton.click();
        }      
        if (e.shiftKey && e.which == 67) {
            var printRfrCardButton = document.getElementById("printRfrCardBt")
            printRfrCardButton.click();
        }
        if(selectedItem !== null){
            if (e.shiftKey && e.which == 82) {
                var removeRefButton = document.getElementById("remove_technician_button")
                removeRefButton.click();
            }
        }
    }
})
