function toggleEntry(x) {

    var tableRow = x;
    var entry = tableRow.parentNode;
    var entryPanel = tableRow.nextElementSibling;

    entry.classList.toggle("opened");
    entryPanel.classList.toggle("collapsed");

}

function printDiv(y) {
    var printContents = document.getElementById(y).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;


    document.body.innerHTML = originalContents;

    window.print();
}