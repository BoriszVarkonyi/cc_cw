var selectedElementIndexAnn = 0;
//IsNotFocused a var from annoucments.js and invitation.js
IsNotFocused = true;
document.onkeydown = (keyDownEvent) => {
    //Arrow system
    if(IsNotFocused){
        if(keyDownEvent.key == "ArrowUp"){
            var tableRows = document.querySelectorAll(".table_row_wrapper .entry")
            var forms =  document.querySelectorAll(".table_row_wrapper .entry_panel")
            if(selectedElementIndexAnn == 0) {
                selectedElementIndexAnn++
            }
            selectedElementIndexAnn--
            forms[selectedElementIndexAnn + 1].classList.add("collapsed")
            tableRows[selectedElementIndexAnn + 1].classList.remove("opened")
            tableRows[selectedElementIndexAnn + 1].blur()
            forms[selectedElementIndexAnn].classList.remove("collapsed")
            tableRows[selectedElementIndexAnn].classList.add("opened")
            tableRows[selectedElementIndexAnn].focus()
            keyDownEvent.preventDefault();
        }


        if(keyDownEvent.key == "ArrowDown"){
            //Cheks if theres a selected row.
            var hasSelected = false;
            var tableRows = document.querySelectorAll(".table_row_wrapper .entry")
            var forms =  document.querySelectorAll(".table_row_wrapper .entry_panel")
            for(i=0; i<tableRows.length; i++) {
                if(tableRows[i].classList.contains("opened")){
                    hasSelected = true
                    break;
                }
            }
            if(hasSelected){
                if(selectedElementIndexAnn == tableRows.length -1) {
                    selectedElementIndexAnn--
                }
                selectedElementIndexAnn++
                forms[selectedElementIndexAnn - 1].classList.add("collapsed")
                tableRows[selectedElementIndexAnn - 1].classList.remove("opened")
                tableRows[selectedElementIndexAnn - 1].blur()
                forms[selectedElementIndexAnn].classList.remove("collapsed")
                tableRows[selectedElementIndexAnn].classList.add("opened")
                tableRows[selectedElementIndexAnn].focus()
                keyDownEvent.preventDefault();
            }
            //If there is not a selected row than it selects the first row.
            else{
                forms[selectedElementIndexAnn].classList.remove("collapsed")
                tableRows[selectedElementIndexAnn].classList.add("opened")
                tableRows[selectedElementIndexAnn].focus()
            }
        }
    }    
} 