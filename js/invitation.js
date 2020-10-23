function toggleEntry(x) {

    var tableRow = x;
    var entry = tableRow.parentNode;
    var entryPanel = tableRow.nextElementSibling;

    entry.classList.toggle("opened");
    entryPanel.classList.toggle("collapsed");

}

function printPage() {
    window.print();
}

var addEntryPanel = document.getElementById("add_entry")
var addingEntryPanel = document.getElementById("adding_entry");

function hideNshow () {
    addEntryPanel.classList.toggle("hidden");
    addingEntryPanel.classList.toggle("hidden");
}


    console.log();


  