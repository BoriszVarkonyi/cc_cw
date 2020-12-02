//Arrow system
var hiddenin = document.getElementsByClassName("selected_list_item_input");
var selectedElementIndexAr = 0;
document.onkeydown = (keyDownEvent) => {
    //Arrow system
    if(searchBarClosed) {
        if(keyDownEvent.key == "ArrowUp"){
            var table = document.querySelector(".table");
            var tableRows = document.querySelectorAll(".table .table_row")
            if(selectedElementIndexAr == 0) {
                selectedElementIndexAr++
            }
            selectedElementIndexAr--
            console.log(selectedElementIndexAr)
            tableRows[selectedElementIndexAr + 1].classList.remove("selected")
            tableRows[selectedElementIndexAr].classList.add("selected")
            hiddenin.value = tableRows[selectedElementIndexAr].id
        }


        if(keyDownEvent.key == "ArrowDown"){
            var table = document.querySelector(".table");
            var tableRows = document.querySelectorAll(".table .table_row")
            if(selectedElementIndexAr == tableRows.length -1) {
                selectedElementIndexAr--
            }
            selectedElementIndexAr++
            console.log(selectedElementIndexAr)
            tableRows[selectedElementIndexAr - 1].classList.remove("selected")
            tableRows[selectedElementIndexAr].classList.add("selected")
            hiddenin.value = tableRows[selectedElementIndexAr].id
        }
    } 
    //Selects to enter
    if(!searchBarClosed) {
        if(keyDownEvent.key == "Enter"){
            var selected = document.querySelector(".search_results .selected")
            var selectedElementId = document.querySelector(".search_results .selected").id.slice(0, -1);
            var selectedElements = document.querySelectorAll(".page_content_flex .selected")
            var selectedTableElement = document.getElementById(selectedElementId)
            //Works only if theres a table. Select the table element
            if(selectedTableElement !== null) {
                for(i=0; i<selectedElements.length; i++){
                    selectedElements[i].classList.remove("selected")
                }
                selectedTableElement.classList.add("selected")
            }
            selected.classList.add("selected")
            keyDownEvent.target.value = selected.innerHTML;
        }
    }     
}
var searchBarClosed = true;
function isOpen() {
    searchBarClosed = false;

}
function isClosed() {
    var removeElemClass = document.querySelectorAll(".search_results .selected")
    for(i=0; i<removeElemClass.length; i++){
        removeElemClass[i].classList.remove("selected")
    }
    searchBarClosed = true;
}