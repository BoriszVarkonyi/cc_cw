var oldentry;
function toggleEntry(x) {
    var tableRow = x;
    var entry = tableRow.parentNode;
    var entryPanel = tableRow.nextElementSibling;
    var entrys =  document.querySelectorAll(".entry");
    
    
    for (i = 0; i < entrys.length; i++) {
        entrys[i].lastElementChild.classList.add("collapsed")
        entrys[i].classList.remove("opened")

    } 
    if(entry.id == oldentry){

        entryPanel.classList.remove("collapsed");
        entry.classList.add("opened");

    }

    entry.classList.toggle("opened");
    entryPanel.classList.toggle("collapsed");

    if(entry.classList.contains("opened")){
    oldentry = entry.id
    }
    else {
    oldentry = undefined
    }
}

function toggleEntryInfo(x) {
    var button = x;
    var entryPanel = button.parentNode;
    var infoPanel = entryPanel.lastElementChild;
    
    infoPanel.classList.toggle("hidden")
}





//Pre-entries -> Manage Entries -> approve all buttons


function selectAll(){

    var cb = document.getElementsByClassName("approved_status_item");
    for(var i=0; i<cb.length; i++){
        if(cb[i].type=="button")
            items[i].checked=true;
    }
}
