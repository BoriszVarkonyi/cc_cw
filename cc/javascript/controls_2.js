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
    if (searchBarClosed && importOverlayClosed) {
        var tableRows = document.querySelectorAll("#page_content_panel_main tbody tr:not( .hidden)");
        if (keyDownEvent.key == "ArrowUp" && tableRows.length > 0) {
            if (selectedElementIndexAr == 0) {
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

        if (keyDownEvent.key == "ArrowDown" && tableRows.length > 0) {
            //Cheks if theres a selected row.
            var hasSelected = false;
            for (i = 0; i < tableRows.length; i++) {
                if (tableRows[i].classList.contains("selected")) {
                    hasSelected = true;
                    break;
                }
            }
            if (hasSelected) {
                if (selectedElementIndexAr == tableRows.length - 1) {
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
            else {
                tableRows[selectedElementIndexAr].classList.add("selected")
                tableRows[selectedElementIndexAr].focus()
            }
        }
        if (keyDownEvent.key == "Home" && tableRows.length > 0) {
            keyDownEvent.preventDefault();
            selectedElementIndexAr = 0;
            var selectedElements = document.querySelectorAll(".selected")
            for (i = 0; i < selectedElements.length; i++) {
                selectedElements[i].classList.remove("selected")
            }
            tableRows[selectedElementIndexAr].classList.add("selected");
            tableRows[selectedElementIndexAr].focus();
        }

        if (keyDownEvent.key == "End" && tableRows.length > 0) {
            keyDownEvent.preventDefault();
            selectedElementIndexAr = tableRows.length - 1;
            var selectedElements = document.querySelectorAll(".selected")
            for (i = 0; i < selectedElements.length; i++) {
                selectedElements[i].classList.remove("selected")
            }
            tableRows[selectedElementIndexAr].classList.add("selected");
            tableRows[selectedElementIndexAr].focus();
        }
        //localStorage.setItem('elementIndex', selectedElementIndexAr);
    }
    //Selects to enter
    //importOverlayClosed is a var. from importoverlay.js
    if (!searchBarClosed && importOverlayClosed) {
        if (keyDownEvent.key == "Enter") {
            var selected = document.querySelector(".search_results a:not(.hidden).selected")
            var selectedElementId = document.querySelector(".search_results .selected").id.slice(0, -1);
            var selectedElements = document.querySelectorAll("main .selected")
            var selectedTableElement = document.getElementById(selectedElementId)
            //Works only if theres a table. Select the table element
            if (selectedTableElement !== null) {
                for (i = 0; i < selectedElements.length; i++) {
                    selectedElements[i].classList.remove("selected")
                }
                selectedTableElement.focus();
                selectedTableElement.classList.add("selected")
                //Counts the selected table row index
                var rows = document.querySelectorAll("tbody tr");
                for (i = 0; i < rows.length; i++) {
                    if (rows[i].classList.contains("selected")) {
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
    if (keyDownEvent.key == "Tab") {
        keyDownEvent.preventDefault();
    }
}