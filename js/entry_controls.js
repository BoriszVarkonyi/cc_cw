var selectedElementIndexAnn = 0;
//IsNotFocused a var from annoucments.js and invitation.js
IsNotFocused = true;
document.onkeydown = (keyDownEvent) => {
    //Arrow system
    if(IsNotFocused){
        var tableRows = document.querySelectorAll("tbody tr:not(.entry)")
        var forms =  document.querySelectorAll("tbody .entry")
        if(keyDownEvent.key == "ArrowUp"){
            if(selectedElementIndexAnn == 0) {
                selectedElementIndexAnn++
            }
            selectedElementIndexAnn--
            forms[selectedElementIndexAnn + 1].classList.add("collapsed")
            tableRows[selectedElementIndexAnn + 1].classList.remove("selected")
            tableRows[selectedElementIndexAnn + 1].blur()
            forms[selectedElementIndexAnn].classList.remove("collapsed")
            tableRows[selectedElementIndexAnn].classList.add("selected")
            tableRows[selectedElementIndexAnn].focus()
            keyDownEvent.preventDefault();
        }


        if(keyDownEvent.key == "ArrowDown"){
            //Cheks if theres a selected row.
            var hasSelected = false;
            for(i=0; i<tableRows.length; i++) {
                if(tableRows[i].classList.contains("selected")){
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
                tableRows[selectedElementIndexAnn - 1].classList.remove("selected")
                tableRows[selectedElementIndexAnn - 1].blur()
                forms[selectedElementIndexAnn].classList.remove("collapsed")
                tableRows[selectedElementIndexAnn].classList.add("selected")
                tableRows[selectedElementIndexAnn].focus()
                keyDownEvent.preventDefault();
            }
            //If there is not a selected row than it selects the first row.
            else{
                forms[selectedElementIndexAnn].classList.remove("collapsed")
                tableRows[selectedElementIndexAnn].classList.add("selected")
                tableRows[selectedElementIndexAnn].focus()
            }
        }
        if (keyDownEvent.key == "Home" && tableRows.length > 0) {
            keyDownEvent.preventDefault();
            selectedElementIndexAnn = 0;
            for(i=0; i<tableRows.length; i++){
                forms[i].classList.add("collapsed")
                tableRows[i].classList.remove("selected")
            }
            tableRows[selectedElementIndexAnn].classList.add("selected");
            forms[selectedElementIndexAnn].classList.remove("collapsed")
            tableRows[selectedElementIndexAnn].focus();
        }

        if (keyDownEvent.key == "End" && tableRows.length > 0) {
            keyDownEvent.preventDefault();
            selectedElementIndexAnn = tableRows.length - 1;
            for(i=0; i<tableRows.length; i++){
                forms[i].classList.add("collapsed")
                tableRows[i].classList.remove("selected")
            }
            tableRows[selectedElementIndexAnn].classList.add("selected");
            forms[selectedElementIndexAnn].classList.remove("collapsed")
            tableRows[selectedElementIndexAnn].focus();
        }
    }
}