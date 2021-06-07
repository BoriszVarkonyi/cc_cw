
//Add entry button.
var addEntryPanel = document.getElementById("add_entry")
var addingEntryPanel = document.getElementById("add_announcement_panel");
var textArea = addingEntryPanel.querySelector(".overlay_panel_form input")

//Toggles the classes.
function hideNshow() {
    addEntryPanel.classList.toggle("hidden");
    addingEntryPanel.classList.toggle("hidden");
    textArea.focus()
}

var addInformationInput = addingEntryPanel.querySelector("input")
var addInformationButton = addingEntryPanel.querySelector(".panel_submit")

addInformationButton.classList.add("disabled")

addingEntryPanel.addEventListener("input", entryformvalidation)
//Entry form validation
function entryformvalidation() {
    if (addInformationInput.value == "") {
        addInformationButton.classList.add("disabled")
    }
    else {
        addInformationButton.classList.remove("disabled")
    }
}

var oldentry;
function toggleEntry(x) {
    var tableRow = x;
    var entry = tableRow;
    var entryPanel = tableRow.nextElementSibling;
    var entrys = document.querySelectorAll(".entry");

    
    //Making every entry collapsed.
    for (i = 0; i < entrys.length; i++) {
        entrys[i].classList.add("collapsed")
        entrys[i].parentNode.classList.remove("opened")
        if (entrys[i] == entry) {
            selectedElementIndexAnn = i;
        }

    }
    
    //Checking if the oldentry var. equals the entry.
    if (entry == oldentry) {
        //If yes then it adds opened, and remove collapsed.
        entryPanel.classList.remove("collapsed");
        entry.classList.add("opened");
        selectedElementIndexAnn = 0;
    }
    
    entry.classList.toggle("opened");
    entryPanel.classList.toggle("collapsed");
    
    //Checking if we clicked the same entry.
    if (entry.classList.contains("opened")) {
        //If yes it saves the entry.
        oldentry = entry
    }
    else {
        //If no it sets the oldentry var. undifened
        oldentry = undefined
    } 
}

document.onkeyup = function (e) {
    if (addingEntryPanel.classList.contains("hidden") && IsNotFocused) {
        if (e.shiftKey && e.which == 78) {
            addEntryPanel.click()
            textArea.focus()
        }
    }
}
var IsNotFocused = true;
var openedForm = document.querySelectorAll(".db_panel_main .entry textarea")
openedForm.forEach(item => {
    item.addEventListener("focus", function () {
        IsNotFocused = false;
    })
    item.addEventListener("blur", function () {
        IsNotFocused = true;
    })
})






