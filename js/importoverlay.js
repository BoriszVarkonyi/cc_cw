var importOverlayClosed = true;
var selectedElementIndexImport = 0;
document.addEventListener("keyup", function(keyDownEvent){
    if(!importOverlayClosed){
        if(keyDownEvent.key == "ArrowUp"){
            var tableRows = document.querySelectorAll(".select_competition_wrapper .table_row")
            if(selectedElementIndexImport == 0) {
                selectedElementIndexImport++
            }
            selectedElementIndexImport--
            tableRows[selectedElementIndexImport + 1].classList.remove("selected")
            tableRows[selectedElementIndexImport + 1].blur()
            tableRows[selectedElementIndexImport].classList.add("selected")
            tableRows[selectedElementIndexImport].focus()
            keyDownEvent.preventDefault();
        }
        if(keyDownEvent.key == "ArrowDown"){
            //Cheks if theres a selected row.
            var hasSelected = false;
            var tableRows = document.querySelectorAll(".select_competition_wrapper .table_row")
            for(i=0; i<tableRows.length; i++) {
                if(tableRows[i].classList.contains("selected")){
                    hasSelected = true
                    break;
                }
            }
            if(hasSelected){
                if(selectedElementIndexImport == tableRows.length -1) {
                    selectedElementIndexImport--
                }
                selectedElementIndexImport++
                tableRows[selectedElementIndexImport - 1].classList.remove("selected")
                tableRows[selectedElementIndexImport - 1].blur()
                tableRows[selectedElementIndexImport].classList.add("selected")
                tableRows[selectedElementIndexImport].focus()
                keyDownEvent.preventDefault();
            }
            //If there is not a selected row than it selects the first row.
            else{
                tableRows[selectedElementIndexImport].classList.add("selected")
                tableRows[selectedElementIndexImport].focus()
            }
        }
    } 
})    