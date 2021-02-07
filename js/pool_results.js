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