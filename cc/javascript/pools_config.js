function useAllReferees() {
    var selectReferees = document.getElementById("select_referees_panel");
    selectReferees.classList.add("disabled");
}

function selectReferees() {
    var selectReferees = document.getElementById("select_referees_panel");
    selectReferees.classList.remove("disabled");
}

function useAllPistes() {
    var selectPistes = document.getElementById("select_pistes_panel");
    selectPistes.classList.add("disabled");
}

function selectPistes() {
    var selectPistes = document.getElementById("select_pistes_panel");
    selectPistes.classList.remove("disabled");
}

var refPanel = document.getElementById("ref_panel");
var timePistPanel = document.getElementById("pist_time_panel");

function toggleRefPanel() {
    refPanel.classList.toggle("hidden");
    rfrsValidation();
}

function togglePistTimePanel() {
    timePistPanel.classList.toggle("hidden");
    pNtValidation();
}

function poolConfigToggle(x) {
    var clickedButton = x;
    var pool = clickedButton.parentNode.parentNode;
    var configPanel = pool.lastElementChild;

    configPanel.classList.toggle("hidden")
}

function poolConfigClose(x) {
    var clickedButton = x;
    var panel = clickedButton.parentNode;

    panel.classList.toggle("hidden")
}

function toggleDisqualifyPanel() {
    var panel = document.getElementById("disqualify_panel");
    panel.classList.toggle("hidden");
}

function useAll() {
    var selectPistes = document.getElementById("select_pistes_panel");
    selectPistes.classList.add("disabled")
}

function selectPistes() {
    var selectPistes = document.getElementById("select_pistes_panel");
    selectPistes.classList.remove("disabled")
}

//Drag n drop system
//Allows the drop
function allowDrop(ev, x) {
    ev.preventDefault();
}
var rowToDelete, regenerateTable, draggedElement, index, dragPlaceTodelete, previousTable, canRegenerate = true, dragStart, dragEndActive = true;
var maxFencerNumber = document.getElementById("pool_of").value;
var rowToSave = [];
function drag(ev, x) {
    //If a drag starts from Draf Fencers Area
    if (x.parentNode.parentNode.id == "pools_drag_panel") {
        //Gets the dragged Element innerHTML
        for (i = 0; i < rowToSave.length; i++) {
            if (rowToSave[i].indexOf(x.outerHTML) > -1) {
                //Saves the dragged element
                draggedElement = rowToSave[i]
                //Saves the index
                index = i;
            }
            //Saves the element we dragged
            rowToDelete = x
            canRegenerate = false;
            //Saves the drop area where the drag started
            dragStart = x.parentNode
            //Denies the dragEnd function
            dragEndActive = false;
        }
    }

    //If a drag starts from a Table
    else {
        //Saves the dragged element
        draggedElement = x.parentNode.parentNode.outerHTML;
        //Saves the Dragged row, bottom drag place.
        dragPlaceTodelete = x.parentNode.parentNode.nextElementSibling
        //Saves the row that we dragged
        rowToDelete = x.parentNode.parentNode;
        canRegenerate = true;
        //sets the  dragStart to undifined
        dragStart = x.parentNode
        //Allows the dragEnd function
        dragEndActive = true;
        //Saves the table that need to be regenerated
        regenerateTable = x.parentNode.parentNode.parentNode;
        //Saves the table where the drag started from.
        previousTable = x.parentNode.parentNode.parentNode;
    }
    ev.dataTransfer.setData("text", ev.target.id);
}
//If we start a drag but we doesn't finish it.
function dragEnd(x) {
    if (dragEndActive) {
        var dropAreas = x.parentNode.parentNode.parentNode.querySelectorAll("tr.drop")
        for (i = 0; i < dropAreas.length; i++) {
            //It removes the droparea classes
            dropAreas[i].classList.remove("collapsed")
        }
    }
}

function drop(ev) {
    if (dragStart !== ev.target && !ev.target.classList.contains("drag_fencer")) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
        //Saves the dragged element innerHTML
        if (dragStart.parentNode.id !== "pools_drag_panel") {
            rowToSave.push(draggedElement)
        }
        //Deletes the dragged row if we dropped down.
        if (rowToDelete !== undefined && !dragStart.classList.contains("holder") && !dragStart.classList.contains("deleter")) {
            rowToDelete.remove();
        }
        //Deletes the Dragged row, bottom drag place
        if (dragPlaceTodelete !== undefined) {
            dragPlaceTodelete.remove()
        }
        //Clears the var
        rowToDelete = undefined;
        if (canRegenerate) {
            regenerate();
        }
    }
    idloader();
}
function regenerate() {
    var table = regenerateTable;
    var tableElements = table.querySelectorAll("tr")
    if (tableElements.length == 0) {
        var dropAreas = table.querySelector("tr.drop")
        dropAreas.outerHTML = '<tr class="drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"></tr>'
    }
    /*
    var tableheader = table.previousElementSibling
    var tableHeaderText = tableheader.querySelectorAll(".table_header_text")
    var rows = table.querySelectorAll(".table_row")
    for(i=3; i<tableHeaderText.length; i++){
        tableHeaderText[i].remove()
    }
    for(i=3; i<rows.length+3; i++){
        tableheader.innerHTML = tableheader.innerHTML + '<div class="table_header_text square">' + (i -2) + '</div>'
    }
    for(i=0; i<rows.length; i++){
        var tableItems = rows[i].querySelectorAll(".table_item")
        for(c=2; c<tableItems.length; c++){
            tableItems[c].remove()
        }
    }
    for(i=0; i<rows.length; i++){
        var tableItems = rows[i].querySelectorAll(".table_item")
        for(c=2; c<rows.length+3; c++){
            if(c == 2){
                rows[i].innerHTML = rows[i].innerHTML + '<div class="table_item square row_title"><p>' + (i + 1) +'</p></div>'
            }
            else if(c == i + 3){
                rows[i].innerHTML = rows[i].innerHTML + '<div class="table_item square filled"></div>'
            }
            else{
                rows[i].innerHTML = rows[i].innerHTML + '<div class="table_item square "></div>'
            }
        }
    }
    */
}
//Enables/Disables the tableWrapperHoverOff function.
var active = true;
//Add class for every droparea in the table
function tableWrapperHoverOn(x) {
    active = false;
    var dropAreas = x.querySelectorAll("tr.drop")
    for (i = 0; i < dropAreas.length; i++) {
        dropAreas[i].classList.add("collapsed")
    }

}

//Removes class from every droparea in the table
function tableWrapperHoverOff(x) {
    if (active) {
        var dropAreas = x.querySelectorAll("tr.drop")
        for (i = 0; i < dropAreas.length; i++) {
            dropAreas[i].classList.remove("collapsed")
        }
    }
}
//Adds class to the droparea
function dropAreaHoverOn(x) {
    x.classList.add("opened")
}
//Removes class from the droparea
function dropAreaHoverOff(x) {
    active = true;
    x.classList.remove("opened")
}
//If we drop an element to a table
function drop2(ev, x) {
    if (checkPoolTable(x) || previousTable == x.parentNode) {
        //Denies the dragEnd function
        dragEndActive = false;
        ev.preventDefault();
        var dropAreas = x.parentNode.querySelectorAll("tr.drop")
        regenerateTable = x.parentNode
        //If the droparea that we dropped in equals the saved droparea
        if (dragPlaceTodelete == x) {
            //It doesnt generate the top droparea
            x.outerHTML = draggedElement + '<tr class="drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"><td colspan="4">Drop Fencer here</td></tr>'
        }
        else {
            //Else it does generate the top droparea
            x.outerHTML = '<tr class="drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"><td colspan="4">Drop Fencer here</td></tr>' + draggedElement + '<tr class="drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"><td colspan="4">Drop Fencer here</td></tr>'
        }
        //Delertes the dragged row if we dropped down.
        if (rowToDelete !== undefined) {
            rowToDelete.remove();
        }
        //Deletes the saved droparea
        if (dragPlaceTodelete !== undefined) {
            dragPlaceTodelete.remove()
        }
        //Clears the var
        rowToDelete = undefined;
        //Deletes the dropped element innerHTMl from the array
        if (index > -1) {
            //Deletes by index
            rowToSave.splice(index, 1);
        }
        regenerate();
        //regenerateTable = previousTable;
        //regenerate();
        //Removes the class from all the droparea in the table
        for (i = 0; i < dropAreas.length; i++) {
            dropAreas[i].classList.remove("collapsed")
        }
        idloader();
    }
    else {
        //Removes the classes
        removeOpenAndCollapseClass()
        toggleModal(1);
    }
}

//Removes the classes (when the pool table is full)
function removeOpenAndCollapseClass() {
    var elements = document.querySelectorAll("#pool_listing .opened")
    for (i = 0; i < elements.length; i++) {
        elements[i].classList.remove("opened")
    }
    elements = document.querySelectorAll("#pool_listing .collapsed")
    for (i = 0; i < elements.length; i++) {
        elements[i].classList.remove("collapsed")
    }
}

//Checks if the pool table is full
function checkPoolTable(x) {
    var table = x.parentNode
    var fencerNumber = table.querySelectorAll("tr:not(tr.drop)").length
    if (fencerNumber < maxFencerNumber) {
        return true;
    }
    else {
        return false;
    }
}

//Makes the JSON format string
var poolsId = ""
function idloader() {
    poolsId = "["
    var entries = document.querySelectorAll(".entry")
    for (i = 0; i < entries.length; i++) {
        poolsId = poolsId + "["
        var tablerowsJSONAttribute = entries[i].querySelectorAll("tr td:first-of-type > p")
        for (d = 0; d < tablerowsJSONAttribute.length; d++) {
            if (d < tablerowsJSONAttribute.length - 1) {
                poolsId = poolsId + tablerowsJSONAttribute[d].getAttribute("x-fencersave") + ","
            }
            else {
                poolsId = poolsId + tablerowsJSONAttribute[d].getAttribute("x-fencersave");
            }
        }
        if (i == entries.length - 1) {
            poolsId = poolsId + "]"
        }
        else {
            poolsId = poolsId + "],"
        }
    }
    poolsId = poolsId + "]"
    hiddenInput = document.getElementById("savePoolsHiddenInput")
    hiddenInput.value = poolsId
}
idloader()

var hiddenInput = document.getElementById("savePoolsHiddenInput")
hiddenInput.value = poolsId
//FORM VALIDATION
var valid1 = false, valid2 = false;
//It is a var from main.js
canAutoValidate = false;
//Pistes And Time validation
var pistesAndTimeForm = document.getElementById("pist_time_panel")
var input1 = document.getElementById("startingTimeInput");
var input2 = document.getElementById("timeInput");
var pNtsaveButton = document.getElementById("pNtSaveButton");
var inputs = [input1, input2];
var allButton = document.getElementById("all");
var pNtoptioncontainer = document.getElementById("select_pistes_panel");
var pisteSelect = pNtoptioncontainer.querySelectorAll(".piste_select");

function pNtValidation() {
    pNtsaveButton.disabled = true;
    //Checking every input.
    for (i = 0; i < inputs.length; i++) {
        if (inputs[i].value == "") {
            //If it finds an empty input, then it disable the "Save" button.
            valid1 = false;
            break;
        }
        else {
            //If everything has a value then it enable the "Save" Button. The user can save.
            valid1 = true;
        }
    }
    if (allButton.checked) {
        valid2 = true;
    }
    else {
        valid2 = false;
        for (i = 0; i < pisteSelect.length; i++) {
            if (pisteSelect[i].firstElementChild.checked == true) {
                valid2 = true;
                break;
            }
        }
    }
    if (valid1 && valid2) {
        pNtsaveButton.disabled = false;
    }
    else {
        pNtsaveButton.disabled = true;
    }
}
pistesAndTimeForm.addEventListener("input", pNtValidation)
//Referees validation
var refereesForm = document.getElementById("ref_panel")
var allrfrs = document.getElementById("all_ref")
var rfrsoptioncontaioner = document.getElementById("select_referees_panel")
var rfrsselect = rfrsoptioncontaioner.querySelectorAll(".piste_select")
var rfrsSaveButton = document.getElementById("rfrsSaveButton")
function rfrsValidation() {
    rfrsSaveButton.disabled = true
    if (allrfrs.checked) {
        valid2 = true;
    }
    else {
        valid2 = false;
        for (i = 0; i < rfrsselect.length; i++) {
            if (rfrsselect[i].firstElementChild.checked == true) {
                valid2 = true;
                break;
            }
        }
    }
    if (valid2) {
        rfrsSaveButton.disabled = false;
        console.log(rfrsSaveButton.disabled)
    }
    else {
        rfrsSaveButton.disabled = true;
    }
}
refereesForm.addEventListener("input", rfrsValidation)

function poolConfig(x) {
    var searchWrappers = x.parentNode.parentNode.querySelectorAll(".search_wrapper, .pool_time_input")
    var texts = x.parentNode.parentNode.querySelectorAll("p")
    var saveButton = x.parentNode.querySelector("button:nth-of-type(2)")
    console.log(saveButton)
    for (i = 0; i < searchWrappers.length; i++) {
        searchWrappers[i].classList.remove("hidden")
    }
    for (i = 0; i < texts.length; i++) {
        texts[i].classList.add("hidden")
    }
    x.classList.add("hidden")
    saveButton.classList.remove("hidden")
}

document.addEventListener("keyup", function (e) {
    //somethingisOpened is a var. from main.js
    //somethingIsFocused is a var. from main.js
    if (!somethingisOpened && !somethingIsFocused) {
        if (e.shiftKey && e.which == 80) {
            var printPoolsButton = document.getElementById("printPools")
            printPoolsButton.click();
        }
        if (e.shiftKey && e.which == 82) {
            var refereesButton = document.getElementById("referees")
            refereesButton.click()
        }
        if (e.shiftKey && e.which == 84) {
            var pistesNTimeButton = document.getElementById("pistesNTimeBt")
            pistesNTimeButton.click();
        }
        if (e.shiftKey && e.which == 84) {
            var savePoolsButton = document.getElementById("savePoolsBt")
            savePoolsButton.click();
        }
        if (e.shiftKey && e.which == 13) {
            var startPoolsButton = document.getElementById("startPoolsBt")
            startPoolsButton.click();
        }
    }
})

function selectEntry(x) {
    var selectedEntry = x.parentElement;
    selectedEntry.classList.toggle("selected")
}