function toggleEntry(x) {

    var tableRow = x;
    var entry = tableRow.parentNode;
    var entryPanel = tableRow.nextElementSibling;

    entry.classList.toggle("opened");
    entryPanel.classList.toggle("collapsed");

}

//patrik not approved changes onclick to approved




//Pre-entries -> Manage Entries -> approve all buttons


function selectAll(){

    var cb = document.getElementsByClassName("approved_status_item");
    for(var i=0; i<cb.length; i++){
        if(cb[i].type=="button")
            items[i].checked=true;
    }
}
