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
}

function togglePistTimePanel() {
    timePistPanel.classList.toggle("hidden");
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
function allowDrop(ev, x) {
    ev.preventDefault();
}
var rowToDelete;
var regenerateTable;
var rowToSave = [];
var draggedElement;
var index;
var dragPlaceTodelete;
var canRegenerate = true;
var canDrop = true;
var dragEndActive = true;
var previousTable;
function drag(ev, x) {
    //Saves the dragged element innerHTML
    if(x.parentNode.parentNode.id == "pools_wrapper"){
        for(i=0; i<rowToSave.length; i++){
            if(rowToSave[i].indexOf(x.outerHTML) > -1){
               draggedElement = rowToSave[i]
               index = i;
            }
            rowToDelete = x
            canRegenerate = false;
            canDrop = false;
            dragEndActive = false;
        }
    }
    else{
        draggedElement = x.parentNode.parentNode.outerHTML;
        dragPlaceTodelete = x.parentNode.parentNode.nextElementSibling
        //Saves the row that we dragged
        rowToDelete = x.parentNode.parentNode;
        canRegenerate = true;
        canDrop = true;
        dragEndActive = true;
        regenerateTable = x.parentNode.parentNode.parentNode;
        previousTable = x.parentNode.parentNode.parentNode;
    }
    ev.dataTransfer.setData("text", ev.target.id);
}
function dragEnd(x){
    if(dragEndActive){
        var dropAreas = x.parentNode.parentNode.parentNode.querySelectorAll(".table_row_drop")
        for(i=0; i<dropAreas.length; i++){
        dropAreas[i].classList.remove("collapsed")
        }
    }
}
function drop(ev) {
    if(canDrop){
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
        rowToSave.push(draggedElement)
        //Delertes the dragged row if we dropped down.
        if(rowToDelete !== undefined){
            rowToDelete.remove();  
        }
        if(dragPlaceTodelete !== undefined){
            dragPlaceTodelete.remove()
        }
        //Clears the var
        rowToDelete = undefined;
        if(canRegenerate){
            regenerate();
        }
    }   
}
function regenerate() {
    var table = regenerateTable;
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
}
var active = true;
function tableWrapperHoverOn(x) {
    active = false;
    var dropAreas = x.querySelectorAll(".table_row_drop")
    for(i=0; i<dropAreas.length; i++){
    dropAreas[i].classList.add("collapsed")
    }

}

function tableWrapperHoverOff(x){
    if(active){
        var dropAreas = x.querySelectorAll(".table_row_drop")
        for(i=0; i<dropAreas.length; i++){
        dropAreas[i].classList.remove("collapsed")
        }
    }     
}

function dropAreaHoverOn(x){
    x.classList.add("opened")
}

function dropAreaHoverOff(x){
    active = true;
    x.classList.remove("opened")
}
function drop2(ev, x){
    dragEndActive = false;
    ev.preventDefault();
    var dropAreas = x.parentNode.querySelectorAll(".table_row_drop")
    regenerateTable = x.parentNode
    if(dragPlaceTodelete == x){
        x.outerHTML = draggedElement + '<div class="table_row_drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"></div>'
    }
    else{
        x.outerHTML = '<div class="table_row_drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"></div>' + draggedElement + '<div class="table_row_drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"></div>'
    }
    //Delertes the dragged row if we dropped down.
    
    if(rowToDelete !== undefined){
        rowToDelete.remove();  
    }

    if(dragPlaceTodelete !== undefined){
        dragPlaceTodelete.remove()
    }
    //Clears the var
    rowToDelete = undefined;
    if (index > -1) {
        rowToSave.splice(index, 1);
    }

    regenerate();
    regenerateTable = previousTable;
    console.log(regenerateTable)
    regenerate();
    for(i=0; i<dropAreas.length; i++){
    dropAreas[i].classList.remove("collapsed")
    }
}

    


    
    
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
  