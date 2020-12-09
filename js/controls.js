//Arrow system
var hiddenin = document.getElementsByClassName("selected_list_item_input");
//This var. used in other files.
var selectedElementIndexAr = 0;
document.onkeydown = (keyDownEvent) => {
    //Arrow system, works only if search bar closed
    if(searchBarClosed) {
        if(keyDownEvent.key == "ArrowUp"){
            var table = document.querySelector(".table");
            var tableRows = document.querySelectorAll(".table .table_row")
            if(selectedElementIndexAr == 0) {
                selectedElementIndexAr++
            }
            selectedElementIndexAr--
            tableRows[selectedElementIndexAr + 1].classList.remove("selected")
            tableRows[selectedElementIndexAr + 1].blur()
            tableRows[selectedElementIndexAr].classList.add("selected")
            tableRows[selectedElementIndexAr].focus()
            hiddenin.value = tableRows[selectedElementIndexAr].id
            keyDownEvent.preventDefault();
        }


        if(keyDownEvent.key == "ArrowDown"){
            //Cheks if theres a selected row.
            var hasSelected = false;
            var table = document.querySelector(".table");
            var tableRows = document.querySelectorAll(".table .table_row")
            for(i=0; i<tableRows.length; i++) {
                if(tableRows[i].classList.contains("selected")){
                    hasSelected = true
                    break;
                }
            }
            if(hasSelected){
                if(selectedElementIndexAr == tableRows.length -1) {
                    selectedElementIndexAr--
                }
                selectedElementIndexAr++
                tableRows[selectedElementIndexAr - 1].classList.remove("selected")
                tableRows[selectedElementIndexAr - 1].blur()
                tableRows[selectedElementIndexAr].classList.add("selected")
                tableRows[selectedElementIndexAr].focus()
                hiddenin.value = tableRows[selectedElementIndexAr].id
                keyDownEvent.preventDefault();
            }
            //If there is not a selected row than it selects the first row.
            else{
                tableRows[selectedElementIndexAr].classList.add("selected")
                tableRows[selectedElementIndexAr].focus()
            }
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
                selectedTableElement.focus();
                selectedTableElement.classList.add("selected")
                //Counts the selected table row index
                var rows = document.querySelectorAll(".table .table_row");
                for(i=0; i<rows.length; i++){
                    if(rows[i].classList.contains("selected")){
                        selectedElementIndexAr = i;
                        break;
                    }
                }
            }
            selected.classList.add("selected")
            keyDownEvent.target.value = selected.innerHTML;
        }
    } 
    if(keyDownEvent.key == "Tab"){
        keyDownEvent.preventDefault(); 
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