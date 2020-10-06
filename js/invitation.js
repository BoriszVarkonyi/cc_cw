function toggleEntry(x) {

    var tableRow = x;
    var entry = tableRow.parentNode;
    var entryPanel = tableRow.nextElementSibling;

    entry.classList.toggle("opened");
    entryPanel.classList.toggle("collapsed");

}