//ENTRY TOGGLE
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

    } 
     //Checking if the oldentry var. equals the entry.
    if(entry == oldentry){
        //If yes then it adds opened, and remove collapsed.
        entryPanel.classList.remove("collapsed");
        entry.classList.add("opened");

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

    var hiddentext = document.getElementById("hidden_id_" + x.id);
    hiddentext.form = "appdisapp" + x.id;
    hiddentext.value = x.id;



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
