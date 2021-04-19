var table = document.querySelector(".table")
var oldClickedRow;
var hiddenInput = document.querySelector(".selected_list_item_input")
function selectRow(x){
    if(x == oldClickedRow){
        var selectedElements = table.querySelectorAll(".selected")
        //Removes selected class from all selected element
        for(i=0; i<selectedElements.length; i++){
            if(selectedElements.length > 0){
                selectedElements[i].classList.remove("selected")
            }
        }
        hiddenInput.value = "";
        oldClickedRow = undefined;
    }
    else{
        var tableRows = document.querySelectorAll(".table_row");
        var selectedElements = table.querySelectorAll(".selected")
        //Removes selected class from all selected element
        for(i=0; i<selectedElements.length; i++){
            if(selectedElements.length > 0){
                selectedElements[i].classList.remove("selected")
            }
        }
        //Adds selected class to the clicked row
        var selectedRow = x
        selectedRow.classList.add("selected")
        //Get the index of the selected row
        var selectIndex;
        for(i=0; i<tableRows.length; i++){
            if(tableRows[i].classList.contains("selected")){
                selectIndex = i;
                //Breaks it if it finds it
                break;
            }
        }
        //Gets the column
        var selectColumn= table.querySelectorAll('.table_row > div:nth-of-type(' + (selectIndex + 2) +')')
        //Adds selected class to the column
        for(i=0; i<selectColumn.length; i++){
            selectColumn[i].classList.add("selected")
        }
        hiddenInput.value = selectedRow.id
        oldClickedRow = x;
    }
}

var disqualfyPanel = document.getElementById("disqualify_panel")
var disqualifyButton = document.getElementById("disqualifyButton")
var submitPanel = document.querySelector(".panel_submit")

function toggleDisqualifyPanel(){
    disqualfyPanel.classList.toggle("hidden")
    var options = document.querySelectorAll(".option_container input")
    for(i=0; i<options.length; i++){
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

function buttonDisabler(){
    var selectedItem = document.querySelector(".pool_table_wrapper .selected")
    if (selectedItem !== null) {
        disqualifyButton.classList.remove("disabled")
        setName();
    }
    else {
        disqualifyButton.classList.add("disabled")
    }
}

function getName(){
    return selectedFencerName = document.querySelector(".pool_table_wrapper .selected .table_item:first-of-type p").innerHTML
}

function setName(){
    var disqPanelText = document.querySelector("#disqualify_panel .overlay_panel_controls p")
    var selectedFencerId = document.querySelector(".pool_table_wrapper .table_row.selected").id
    var hiddenInput = document.querySelector(".modal_footer_content input")
    hiddenInput.value = selectedFencerId
    disqPanelText.innerHTML = "Disqualify " + getName();
}

function disqFormValidation(){
    submitPanel.disabled = false;

    var selectedReason = document.querySelector(".option_container input:checked").nextElementSibling
    var modelText = document.querySelector(".modal_title")
    modelText.innerHTML = "Do you want to disqualify " + getName() + " for the follwing reason: " + selectedReason.innerHTML + "?" 

}   

disqualfyPanel.addEventListener("input", disqFormValidation)

