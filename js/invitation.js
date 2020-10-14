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

function addEntry() {
    var addEntryPanel = document.getElementById("add_entry")
    var plusInfoWrapper = document.getElementById("plus_info_wrapper");
    var newPlusInfo = document.createElement("form");
    newPlusInfo.setAttribute("id", "adding_entry");
    newPlusInfo.innerHTML = "<form id='adding_entry'><div class='table_row'><div class='table_item'><input type='text' placeholder='Type in the title'> <button class='save_entry'>Create</button> </div></div></form>";



    plusInfoWrapper.appendChild(newPlusInfo);
    addEntry.classList.add("hidden");

    console.log(plusInfoWrapper);


}
  