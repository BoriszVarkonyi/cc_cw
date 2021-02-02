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
