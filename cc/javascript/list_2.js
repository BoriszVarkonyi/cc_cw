//Auto width
/*
window.addEventListener("resize", automaticWidth);
window.addEventListener("DOMContentLoaded", automaticWidth);
var tableToAutoWidth;
var allTable = document.querySelectorAll(".table");
function automaticWidth() {
    for (k = 0; k < allTable.length; k++) {
        tableToAutoWidth = allTable[k];
        automaticWidthTest()
    }
}
function automaticWidthTest() {
    var table = tableToAutoWidth
    if (table != null) {
        var columnCounter = table.querySelectorAll(".table_row:nth-last-of-type(2) > div").length;
        for (columnNumber = 1; columnNumber <= columnCounter; columnNumber++) {
            var column = table.querySelectorAll('.table_row > div:nth-of-type(' + columnNumber + '), .table_header > div:nth-of-type(' + columnNumber + ')');
            var widthArray = [];
            var biggestWidth;
            //Push all widths to widthArray
            for (i = 0; i < column.length; i++) {
                widthArray.push(column[i].offsetWidth);
            }
            //Gets the biggest array
            biggestWidth = widthArray.reduce(function (a, b) {
                return Math.max(a, b);
            });
            //Sets the width to all array element.
            for (i = 0; i < column.length; i++) {
                if (column[i].style.width !== biggestWidth || column[i].style.width !== biggestWidth - 1 || column[i].style.width !== biggestWidth + 1) {
                    column[i].style.width = biggestWidth + "px";
                }
                widthArray.pop();
            }
        }
    }
}
*/
// Select System

var selectedRowInput = document.querySelectorAll(".selected_list_item_input");
function selectRow(x) {
    //If we clicked the same it removes the selected class
    if (x.classList.contains("selected")) {
        x.classList.remove("selected");
        x.blur()
        selectedRowInput.value = "";
        //It is a var. from control.js
        selectedElementIndexAr = 0;
    }
    //Select the clicked table row
    else {
        var rows = document.querySelectorAll("#page_content_panel_main tbody tr");
        //Removes selected from all row
        for (i = 0; i < rows.length; i++) {
            rows[i].classList.remove("selected")
        }
        //Select the clicked table row
        x.classList.add("selected");
        //Counts the selected table row index
        for (i = 0; i < rows.length; i++) {
            if (rows[i].classList.contains("selected")) {
                //It is a var. from control.js
                selectedElementIndexAr = i;
                break;
            }
        }
        //Saves the selected row id.
        for(i=0; i<selectedRowInput.length; i++){
            selectedRowInput[i].value = x.id;
        }
    }
}
//Toggles the selection on clicked searchresult
function selectSearch(x) {
    //Makes the id
    var selectedElementId = x.id.slice(0, -1);
    var selectedElements = document.querySelectorAll("main .selected")
    //Removes selected class from all selected element
    for (i = 0; i < selectedElements.length; i++) {
        selectedElements[i].classList.remove("selected")
    }
    //Gets the tablerow by id
    var selectedTableElement = document.getElementById(selectedElementId)
    //Adds selected class
    selectedTableElement.classList.add("selected")
    //Counts the selected table row index
    var rows = document.querySelectorAll("tbody tr");
    for (i = 0; i < rows.length; i++) {
        if (rows[i].classList.contains("selected")) {
            //It is a var. from control.js
            selectedElementIndexAr = i;
            break;
        }
    }
    selectedRowInput.value = selectedElementId
}
