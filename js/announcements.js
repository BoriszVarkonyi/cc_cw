var oldentry;
function toggleEntry(x) {
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

//NewAnnouncementsButton and addingEntryPanel.
var addingEntryPanel = document.getElementById("adding_entry");
var newAnnouncementsButton = document.getElementById("new_announcement_top");
//console.log(newAnnouncementsButton)

//Toggles the class.
function hideNshow() {   
    addingEntryPanel.classList.toggle("hidden")
    //Checking the addingEnzryPanel classlist.
    if(addingEntryPanel.classList.contains("hidden")) {
        //If it contains hidden, it sets the button enabled.
        newAnnouncementsButton.disabled = false;
    }
    else{
        //If it isn't contains hidden, it sets the button disabled.
        newAnnouncementsButton.disabled = true;
    }
    
}
document.onkeyup=function(e){
    var newAnn = document.getElementById("new_announcement_top")
    var titleBar = document.querySelector(".title_input")
    if(e.shiftKey && e.which == 78) {
        newAnn.click()
        titleBar.focus()
    }
}
var IsNotFocused = true;
var openedForm =  document.querySelectorAll(".db_panel_main .entry_panel textarea")
openedForm.forEach(item => { 
    item.addEventListener("focus", function(){
        IsNotFocused = false;
    })
    item.addEventListener("blur", function(){
        IsNotFocused = true;
    })
})

var selectedElementIndexAnn = 0;
document.onkeydown = (keyDownEvent) => {
    if(IsNotFocused){
        if(keyDownEvent.key == "ArrowUp"){
            var tableRows = document.querySelectorAll(".db_panel_main  .entry")
            var forms =  document.querySelectorAll(".db_panel_main form")
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
            var tableRows = document.querySelectorAll(".db_panel_main  .entry")
            var forms =  document.querySelectorAll(".db_panel_main form")
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





