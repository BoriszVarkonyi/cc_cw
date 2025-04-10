var table = document.querySelector("#page_content_panel_main table")
var oldClickedRow;
var hiddenInput = document.querySelector(".selected_list_item_input")
function selectRow(x) {
    if (x == oldClickedRow) {
        var selectedElements = table.querySelectorAll(".selected")
        //Removes selected class from all selected element
        for (i = 0; i < selectedElements.length; i++) {
            if (selectedElements.length > 0) {
                selectedElements[i].classList.remove("selected")
            }
        }
        hiddenInput.value = "";
        oldClickedRow = undefined;
    }
    else {
        var tableRows = document.querySelectorAll("#page_content_panel_main tbody tr");
        var selectedElements = table.querySelectorAll(".selected")
        //Removes selected class from all selected element
        for (i = 0; i < selectedElements.length; i++) {
            if (selectedElements.length > 0) {
                selectedElements[i].classList.remove("selected")
            }
        }
        //Adds selected class to the clicked row
        var selectedRow = x
        selectedRow.classList.add("selected")
        //Get the index of the selected row
        var selectIndex;
        for (i = 0; i < tableRows.length; i++) {
            if (tableRows[i].classList.contains("selected")) {
                selectIndex = i;
                //Breaks it if it finds it
                break;
            }
        }
        selectedElementIndexPr = selectIndex
        //Gets the column
        var selectColumn = table.querySelectorAll('#page_content_panel_main tbody tr > td:nth-of-type(' + (selectIndex + 3) + ')')
        //Adds selected class to the column
        for (i = 0; i < selectColumn.length; i++) {
            selectColumn[i].classList.add("selected")
        }
        hiddenInput.value = selectedRow.id
        oldClickedRow = x;
    }
}

//This var. used in other files.
var selectedElementIndexPr = 0;
document.onkeydown = (keyDownEvent) => {
    //Arrow system
    var tableRows = document.querySelectorAll("#page_content_panel_main tbody tr:not( .hidden)");
    if (keyDownEvent.key == "ArrowUp" && tableRows.length > 0) {
        if (selectedElementIndexPr > 0) {
            selectedElementIndexPr--
            selectRow(tableRows[selectedElementIndexPr])
        }
    }
    if (keyDownEvent.key == "ArrowDown" && tableRows.length > 0) {
        if (selectedElementIndexPr < tableRows.length - 1) {
            var hasSelected = false;
            for (i = 0; i < tableRows.length; i++) {
                if (tableRows[i].classList.contains("selected")) {
                    hasSelected = true;
                    break;
                }
            }
            if (hasSelected) {
                selectedElementIndexPr++
                selectRow(tableRows[selectedElementIndexPr])
            }
            else {
                selectRow(tableRows[selectedElementIndexPr])
            }
        }
    }
    if (keyDownEvent.key == "Home" && tableRows.length > 0) {
        selectedElementIndexPr = 0;
        selectRow(tableRows[selectedElementIndexPr])
    }
    if (keyDownEvent.key == "End" && tableRows.length > 0) {
        selectedElementIndexPr = tableRows.length - 1;
        selectRow(tableRows[selectedElementIndexPr])
    }
}

var disqualfyPanel = document.getElementById("disqualify_panel")
var disqualifyButton = document.getElementById("disqualifyButton")
var submitPanel = document.querySelector(".panel_submit")
var msgFencerButton = document.getElementById("msg_fencer")

function toggleDisqualifyPanel() {
    disqualfyPanel.classList.toggle("hidden")
    var options = document.querySelectorAll(".option_container input")
    for (i = 0; i < options.length; i++) {
        options[i].checked = false;
    }
    submitPanel.disabled = true;

}

var tableRows = document.querySelectorAll("#page_content_panel_main tbody tr")

//Event listener to class change
function callback(mutationsList, observer) {
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
            buttonDisabler();
        }
    })
}

const mutationObserver4 = new MutationObserver(callback)
for (i = 0; i < tableRows.length; i++) {
    mutationObserver4.observe(tableRows[i], { attributes: true })
}

function buttonDisabler() {
    var selectedItem = document.querySelector("#page_content_panel_main tbody tr.selected")
    if (selectedItem !== null && !selectedItem.classList.contains("disqualified")) {
        disqualifyButton.classList.remove("disabled")
        msgFencerButton.classList.remove("disabled")
        setName();
    }
    else {
        disqualifyButton.classList.add("disabled")
        msgFencerButton.classList.add("disabled")
    }
}
//Gets the name
function getName() {
    return selectedFencerName = document.querySelector("#page_content_panel_main tbody .selected td:first-of-type p").innerHTML
}
//Sets the name
function setName() {
    var disqPanelText = document.querySelector("#disqualify_panel .overlay_panel_controls p")
    var selectedFencerId = document.querySelector("#page_content_panel_main tbody tr.selected").id
    var hiddenInput = document.querySelector(".modal_footer_content input[type=text]")
    hiddenInput.value = selectedFencerId
    disqPanelText.innerHTML = "Disqualify " + getName();
}
//Form validation
function disqFormValidation() {
    submitPanel.disabled = false;
    //Makes the modell
    var selectedReason = document.querySelector(".option_container input:checked").nextElementSibling;
    var modelText = document.querySelector(".modal_title");
    modelText.innerHTML = "Do you want to disqualify " + getName() + " for the following reason: " + selectedReason.innerHTML + "?";
    var reasonInput = document.getElementById(selectedReason.innerHTML.toLowerCase());
    reasonInput.checked = true;

}

disqualfyPanel.addEventListener("input", disqFormValidation)

var maxValue = parseInt(document.getElementById("maxValueInput").value)

var matches = document.querySelectorAll(".match")
//Set to every input an eventlistener
matches.forEach(item => {
    //Gets the input
    var inputs = item.querySelectorAll("input[type=text]")
    //Gets the radio inputs
    var radioInputs = item.querySelectorAll("input[type=radio]")

    //Checks if theeres a tie
    if (inputs[0].value == inputs[1].value && inputs[0].value != "" && inputs[1].value != "") {
        //Display the radio inputs
        for (i = 0; i < radioInputs.length; i++) {
            radioInputs[i].nextElementSibling.classList.remove("collapsed")
            radioInputs[i].disabled = false;
        }
    }

    item.addEventListener("input", function () {
        //Check if theres any forbidden points, and corrects it
        for (i = 0; i < inputs.length; i++) {
            if (isNaN(inputs[i].value) || inputs[i].value[inputs[i].value.length - 1] == ".") {
                inputs[i].value = inputs[i].value.slice(0, -1);
            }
            if (inputs[i].value > maxValue) {
                inputs[i].value = maxValue;
            }
            else if (inputs[i].value.length > 1 && inputs[i].value[0] == "0") {
                inputs[i].value = "0";
            }
        }
        //Checks if theeres a tie
        if (inputs[0].value == inputs[1].value && inputs[0].value != "" && inputs[1].value != "") {
            //Display the radio inputs
            for (i = 0; i < radioInputs.length; i++) {
                radioInputs[i].nextElementSibling.classList.remove("collapsed")
                radioInputs[i].disabled = false;
            }
        }
        else {
            //Hides the radio inputs
            for (i = 0; i < radioInputs.length; i++) {
                radioInputs[i].nextElementSibling.classList.add("collapsed")
                radioInputs[i].disabled = true;
                radioInputs[i].checked = false;
            }
        }
    })
})


var pointInputs = document.querySelectorAll(".pool_results_column input[type=text]")

pointInputs.forEach(item => {
    item.addEventListener("focus", function () {
        this.value = ""
    })
})

var entry = document.querySelector(".pool_results_column")
var poolMatches = document.getElementById("pool_matches")
var viewButtons = document.querySelectorAll("#column_view_controls button")

function hideAllViewButton() {
    for (i = 0; i < viewButtons.length; i++) {
        viewButtons[i].classList.add("hidden")
    }
}

function viewAllButton(x) {
    viewButtons[2].classList.remove("hidden")
    viewButtons[1].classList.remove("hidden")
    viewButtons[0].classList.add("hidden")
    poolMatches.classList.remove("collapsed")
    entry.classList.remove("collapsed")
    document.cookie = "view = 010;" + setExpireDay(365);
}

function viewEntryButton(x) {
    hideAllViewButton();
    viewButtons[2].classList.remove("hidden")
    viewButtons[0].classList.remove("hidden")
    poolMatches.classList.add("collapsed")
    entry.classList.remove("collapsed")
    document.cookie = "view = 100;" + setExpireDay(365);
}

function viewMatchesButton(x) {
    hideAllViewButton();
    viewButtons[1].classList.remove("hidden")
    viewButtons[0].classList.remove("hidden")
    poolMatches.classList.remove("collapsed")
    entry.classList.add("collapsed")
    document.cookie = "view = 001;" + setExpireDay(365);
}

var view = cookieFinder("view", "010", false, 365)

switch (view) {
    case "001":
        viewMatchesButton()
        break;
    case "100":
        viewEntryButton();
        break;
    case "010":
        viewAllButton();
        break;
}

