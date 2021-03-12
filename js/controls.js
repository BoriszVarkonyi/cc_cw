//Arrow system
var hiddenin = document.querySelector(".selected_list_item_input");
//This var. used in other files.
var selectedElementIndexAr = 0;
/*
if(localStorage.getItem('elementIndex') == null){
    selectedElementIndexAr = 0;
}
else{
    selectedElementIndexAr = localStorage.getItem('elementIndex')
}
*/
importOverlayClosed = true;
document.onkeydown = (keyDownEvent) => {
    //Arrow system, works only if search bar closed
    //importOverlayClosed is a var. from importoverlay.js
    //searchBarClosed is a var from search.js
    if(searchBarClosed && importOverlayClosed) {
        if(keyDownEvent.key == "ArrowUp"){
            var table = document.querySelector(".table");
            var tableRows = document.querySelectorAll(".table .table_row:not( .hidden)");
            if(selectedElementIndexAr == 0) {
                selectedElementIndexAr++
            }
            selectedElementIndexAr--
            tableRows[selectedElementIndexAr + 1].classList.remove("selected");
            tableRows[selectedElementIndexAr + 1].blur();
            tableRows[selectedElementIndexAr].classList.add("selected");
            tableRows[selectedElementIndexAr].focus();
            hiddenin.value = tableRows[selectedElementIndexAr].id;
            keyDownEvent.preventDefault();
        }


        if(keyDownEvent.key == "ArrowDown"){
            //Cheks if theres a selected row.
            var hasSelected = false;
            var table = document.querySelector(".table");
            var tableRows = document.querySelectorAll(".table .table_row:not( .hidden)")
            for(i=0; i<tableRows.length; i++) {
                if(tableRows[i].classList.contains("selected")){
                    hasSelected = true;
                    break;
                }
            }
            if(hasSelected){
                if(selectedElementIndexAr == tableRows.length -1) {
                    selectedElementIndexAr--
                }
                selectedElementIndexAr++
                tableRows[selectedElementIndexAr - 1].classList.remove("selected");
                tableRows[selectedElementIndexAr - 1].blur();
                tableRows[selectedElementIndexAr].classList.add("selected");
                tableRows[selectedElementIndexAr].focus();
                hiddenin.value = tableRows[selectedElementIndexAr].id;
                keyDownEvent.preventDefault();
            }
            //If there is not a selected row than it selects the first row.
            else{
                tableRows[selectedElementIndexAr].classList.add("selected")
                tableRows[selectedElementIndexAr].focus()
            }
        }
        localStorage.setItem('elementIndex', selectedElementIndexAr);
    }
    //Selects to enter
    //importOverlayClosed is a var. from importoverlay.js
    if(!searchBarClosed && importOverlayClosed) {
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
            keyDownEvent.preventDefault();
            //It is a function from main.js
            formvariableDeclaration();
        }
    }
    if(keyDownEvent.key == "Tab"){
        keyDownEvent.preventDefault();
    }
}
/*
//Opens the searchbar to Shift+F
document.onkeyup=function(e){
    //somethingisOpened is a var. from main.js
    if(!somethingisOpened){
        if(e.shiftKey && e.which == 70) {
            var searchBar = document.getElementById("inputs")
            searchBar.focus()
        }
    }
}
*/
function test(){
    /*
    var tableRows = document.querySelectorAll(".table .table_row")
    tableRows[selectedElementIndexAr].classList.add("selected")
    tableRows[selectedElementIndexAr].focus()
    hiddenin.value = tableRows[selectedElementIndexAr].id
    console.log(hiddenin.value)
    */
}
test();