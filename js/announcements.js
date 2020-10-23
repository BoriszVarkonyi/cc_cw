function toggleEntry(x) {
    var tableRow = x;
    var entry = tableRow.parentNode;
    var entryPanel = tableRow.nextElementSibling;

    entry.classList.toggle("opened");
    entryPanel.classList.toggle("collapsed");
}

var addingEntryPanel = document.getElementById("adding_entry");
var newAnnouncementsButton = document.getElementById("newAnnouncementsButton");


function hideNshow() {   
    addingEntryPanel.classList.toggle("hidden")
    
    if(addingEntryPanel.classList.contains("hidden")) {
        newAnnouncementsButton.disabled = false;
    }
    else{
        newAnnouncementsButton.disabled = true;
    }
}





