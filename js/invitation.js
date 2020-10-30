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
//Add entry button.
var addEntryPanel = document.getElementById("add_entry")
var addingEntryPanel = document.getElementById("adding_entry");
//Toggles the classes.
function hideNshow () {
    addEntryPanel.classList.toggle("hidden");
    addingEntryPanel.classList.toggle("hidden");
}

var inputs = document.querySelectorAll('fileToUpload');

Array.prototype.forEach.call( inputs, function( input ) {
  var label = input.nextElementSibling,
              labelVal = label.innerHTML;

  input.addEventListener( 'change', function( e ) {
    var fileName = '';

    if ( this.files && this.files.length > 1 ) {
      fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
    } else {
      fileName = e.target.value.split( '\\' ).pop();
    }

    if ( fileName ) {
      label.querySelector( 'span' ).innerHTML = fileName;
    } else {
      label.innerHTML = labelVal;
    }
  });
});
//END

  