function toggleEntry(x) {
    var tableRow = x;
    var entry = tableRow.parentNode;
    var entryPanel = tableRow.nextElementSibling;

    entry.classList.toggle("opened");
    entryPanel.classList.toggle("collapsed");
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






