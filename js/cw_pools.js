var oldentry;
function togglePool(x) {
    var tableRow = x;
    var entry = tableRow.parentNode;
    var entryPanel = tableRow.nextElementSibling;
    var entrys =  document.querySelectorAll(".entry");

    //Making every entry collapsed.
    for (i = 0; i < entrys.length; i++) {
        entrys[i].lastElementChild.classList.add("collapsed")
        entrys[i].classList.remove("opened")
        if(entrys[i] == entry){
            selectedElementIndexAnn = i;
        }

    } 
    //Checking if the oldentry var. equals the entry.
    if(entry == oldentry){
        //If yes then it adds opened, and remove collapsed.
        entryPanel.classList.remove("collapsed");
        entry.classList.add("opened");
        selectedElementIndexAnn = 0;
    }

    entry.classList.toggle("opened");
    entryPanel.classList.toggle("collapsed");
    //Checking if we clicked the same entry.
    if(entry.classList.contains("opened")){
        //If yes it saves the entry.
        oldentry = entry
    }
    else {
        //If no it sets the oldentry var. undifened
        oldentry = undefined
    }
}
var selectedElementIndexAnn = 0;
document.onkeydown = (keyDownEvent) => {
    //Arrow system
    if(keyDownEvent.key == "ArrowUp"){
        var tableRows = document.querySelectorAll(".table_row_wrapper .entry")
        var entryPanels = document.querySelectorAll(".table_row_wrapper .entry_panel")
        if(selectedElementIndexAnn == 0) {
            selectedElementIndexAnn++
        }
        selectedElementIndexAnn--
        entryPanels[selectedElementIndexAnn + 1].classList.add("collapsed")
        tableRows[selectedElementIndexAnn + 1].classList.remove("opened")
        tableRows[selectedElementIndexAnn + 1].blur()
        entryPanels[selectedElementIndexAnn].classList.remove("collapsed")
        tableRows[selectedElementIndexAnn].classList.add("opened")
        tableRows[selectedElementIndexAnn].focus()
        keyDownEvent.preventDefault();
    }


    if(keyDownEvent.key == "ArrowDown"){
        //Cheks if theres a selected row.
        var hasSelected = false;
        var tableRows = document.querySelectorAll(".table_row_wrapper  .entry")
        var entryPanels = document.querySelectorAll(".table_row_wrapper .entry_panel")
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
            entryPanels[selectedElementIndexAnn - 1].classList.add("collapsed")
            tableRows[selectedElementIndexAnn - 1].classList.remove("opened")
            tableRows[selectedElementIndexAnn - 1].blur()
            entryPanels[selectedElementIndexAnn].classList.remove("collapsed")
            tableRows[selectedElementIndexAnn].classList.add("opened")
            tableRows[selectedElementIndexAnn].focus()
            keyDownEvent.preventDefault();
        }
        //If there is not a selected row than it selects the first row.
        else{
            entryPanels[selectedElementIndexAnn].classList.remove("collapsed")
            tableRows[selectedElementIndexAnn].classList.add("opened")
            tableRows[selectedElementIndexAnn].focus()
        }
    }
}     
