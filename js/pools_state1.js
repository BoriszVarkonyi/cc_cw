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

function disqualifyToggle() {
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
var rowToSave = [];
function drag(ev, x) {
    //If a drag starts from Draf Fencers Area
    if(x.parentNode.parentNode.id == "pools_drag_panel"){
        //Gets the dragged Element innerHTML
        for(i=0; i<rowToSave.length; i++){
            if(rowToSave[i].indexOf(x.outerHTML) > -1){
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
    else{
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
function dragEnd(x){
    if(dragEndActive){
        var dropAreas = x.parentNode.parentNode.parentNode.querySelectorAll(".table_row_drop")
        for(i=0; i<dropAreas.length; i++){
            //It removes the droparea classes
            dropAreas[i].classList.remove("collapsed")
        }
    }
}

function drop(ev) {
    if(dragStart !== ev.target){
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
        //Saves the dragged element innerHTML
        if(dragStart.parentNode.id !== "pools_drag_panel"){
            rowToSave.push(draggedElement)
        }
        //Deletes the dragged row if we dropped down.
        if(rowToDelete !== undefined && !dragStart.classList.contains("holder") && !dragStart.classList.contains("deleter")){
            rowToDelete.remove();
        }
        //Deletes the Dragged row, bottom drag place
        if(dragPlaceTodelete !== undefined){
            dragPlaceTodelete.remove()
        }
        //Clears the var
        rowToDelete = undefined;
        if(canRegenerate){
            regenerate();
        }
    }
    idloader();
}
function regenerate() {
    var table = regenerateTable;
    var tableElements = table.querySelectorAll(".table_row")
    if(tableElements.length == 0){
        var dropAreas = table.querySelector(".table_row_drop")
        dropAreas.outerHTML = '<div class="table_row_drop opened" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondrop="drop2(event, this)"></div>'
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
    var dropAreas = x.querySelectorAll(".table_row_drop")
    for(i=0; i<dropAreas.length; i++){
    dropAreas[i].classList.add("collapsed")
    }

}
//Removes class from every droparea in the table
function tableWrapperHoverOff(x){
    if(active){
        var dropAreas = x.querySelectorAll(".table_row_drop")
        for(i=0; i<dropAreas.length; i++){
        dropAreas[i].classList.remove("collapsed")
        }
    }
}
//Adds class to the droparea
function dropAreaHoverOn(x){
    x.classList.add("opened")
}
//Removes class from the droparea
function dropAreaHoverOff(x){
    active = true;
    x.classList.remove("opened")
}
//If we drop an element to a table
function drop2(ev, x){
    //Denies the dragEnd function
    dragEndActive = false;
    ev.preventDefault();
    var dropAreas = x.parentNode.querySelectorAll(".table_row_drop")
    regenerateTable = x.parentNode
    //If the droparea that we dropped in equals the saved droparea
    if(dragPlaceTodelete == x){
        //It doesnt generate the top droparea
        x.outerHTML = draggedElement + '<div class="table_row_drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"></div>'
    }
    else{
        //Else it does generate the top droparea
        x.outerHTML = '<div class="table_row_drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"></div>' + draggedElement + '<div class="table_row_drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"></div>'
    }
    //Delertes the dragged row if we dropped down.
    if(rowToDelete !== undefined){
        rowToDelete.remove();
    }
    //Deletes the saved droparea
    if(dragPlaceTodelete !== undefined){
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
    for(i=0; i<dropAreas.length; i++){
    dropAreas[i].classList.remove("collapsed")
    }
    idloader();
}

var poolsId = ""
function idloader(){
    poolsId = ""
    var entries = document.querySelectorAll(".entry")
    for(i=0; i<entries.length; i++){
        if(i !== 0){
            poolsId = poolsId + "//"
        }
        var tablerowsid = entries[i].querySelectorAll(".table_row .table_item:first-of-type > p")
        for(d=0; d<tablerowsid.length; d++){
            if(d == 0){
                poolsId = poolsId + tablerowsid[d].id
            }
            else{
                poolsId = poolsId + "," + tablerowsid[d].id
            }
        }
    }
    hiddenInput = document.getElementById("savePoolsHiddenInput")
    hiddenInput.value = poolsId
    hiddenInput.classList.remove("hidden")
}
idloader()

var hiddenInput = document.getElementById("savePoolsHiddenInput")
hiddenInput.value = poolsId
hiddenInput.classList.remove("hidden")
function tableChecker(x){
    console.log(x)
}
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
var allButton = document.getElementById("all")
var pNtoptioncontainer = document.getElementById("select_pistes_panel")
var pisteSelect = pNtoptioncontainer.querySelectorAll(".piste_select")
function pNtValidation(){
    pNtsaveButton.disabled = true;
    //Checking every input.
    for(i=0; i<inputs.length; i++){
        if(inputs[i].value == ""){
            //If it finds an empty input, then it disable the "Save" button.
            valid1 = false;
            break;
        }
        else {
            //If everything has a value then it enable the "Save" Button. The user can save.
            valid1 = true;
        }
    }
    if(allButton.checked){
        valid2 = true;
    }
    else{
        valid2 = false;
        for(i=0; i<pisteSelect.length; i++){
            if(pisteSelect[i].firstElementChild.checked == true){
                valid2 = true;
                break;
            }
        }
    }
    if(valid1 && valid2){
        pNtsaveButton.disabled = false;
    }
    else{
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
function rfrsValidation(){
    rfrsSaveButton.disabled = true
    if(allrfrs.checked){
        valid2 = true;
    }
    else{
        valid2 = false;
        for(i=0; i<rfrsselect.length; i++){
            if(rfrsselect[i].firstElementChild.checked == true){
                valid2 = true;
                break;
            }
        }
    }
    if(valid2){
        rfrsSaveButton.disabled = false;
    }
    else{
        rfrsSaveButton.disabled = true;
    }
}
refereesForm.addEventListener("input", rfrsValidation)



function generatePanel(){

    var f_number_input = document.getElementById("fencer_quantity");
    var f_number = f_number_input.value;


    for (let index = 7; index > 3; index--) {

        var torekves = index;

        var szoveg = document.getElementById("p_" + torekves);

        inputka = document.getElementById(index);

        var fullpool = f_number / torekves;

        if(f_number % torekves == 0){

            szoveg.innerHTML = fullpool + " pool of " + torekves;
            inputka.value = fullpool;

            }
        else
            {

                var teljescsop = Math.floor(f_number / torekves);


                var maradek = f_number % torekves;

                var ennyikell = (torekves - 1) - maradek;

                var nagyobb = teljescsop - ennyikell;
                var kisebb = 1 + ennyikell;

                var torekvesalatt = torekves - 1;

                if(nagyobb <= 0){

                    szoveg.innerHTML = "NEM LEHETSÉGES";

                }else{

                    szoveg.innerHTML = nagyobb + " pool of " + torekves + " and " + kisebb + " pool of " + torekvesalatt;
                    inputka.value = nagyobb + kisebb;

                }

                }
    }


}