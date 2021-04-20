var table = document.querySelector(".table")
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
        var tableRows = document.querySelectorAll(".table_row");
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
        selectedElementIndexPr = selectIndex - 1
        //Gets the column
        var selectColumn = table.querySelectorAll('.table_row > div:nth-of-type(' + (selectIndex + 2) + ')')
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
    var tableRows = document.querySelectorAll(".table .table_row:not( .hidden)");
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

function toggleDisqualifyPanel() {
    disqualfyPanel.classList.toggle("hidden")
    var options = document.querySelectorAll(".option_container input")
    for (i = 0; i < options.length; i++) {
        options[i].checked = false;
    }
    submitPanel.disabled = true;

}

var tableRows = document.querySelectorAll(".table_row")

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
    var selectedItem = document.querySelector(".pool_table_wrapper .selected")
    if (selectedItem !== null) {
        disqualifyButton.classList.remove("disabled")
        setName();
    }
    else {
        disqualifyButton.classList.add("disabled")
    }
}

function getName() {
    return selectedFencerName = document.querySelector(".pool_table_wrapper .selected .table_item:first-of-type p").innerHTML
}

function setName() {
    var disqPanelText = document.querySelector("#disqualify_panel .overlay_panel_controls p")
    var selectedFencerId = document.querySelector(".pool_table_wrapper .table_row.selected").id
    var hiddenInput = document.querySelector(".modal_footer_content input")
    hiddenInput.value = selectedFencerId
    disqPanelText.innerHTML = "Disqualify " + getName();
}

function disqFormValidation() {
    submitPanel.disabled = false;

    var selectedReason = document.querySelector(".option_container input:checked").nextElementSibling
    var modelText = document.querySelector(".modal_title")
    modelText.innerHTML = "Do you want to disqualify " + getName() + " for the follwing reason: " + selectedReason.innerHTML + "?"

}

disqualfyPanel.addEventListener("input", disqFormValidation)

