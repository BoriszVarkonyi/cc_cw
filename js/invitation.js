//Invitation form
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
//END
//Add entry button.
var addEntryPanel = document.getElementById("add_entry")
var addingEntryPanel = document.getElementById("adding_entry");

//Toggles the classes.
function hideNshow () {
  addEntryPanel.classList.toggle("hidden");
  addingEntryPanel.classList.toggle("hidden");
}
//END

//Image upload
var input = document.getElementById("fileToUpload");
var uploadButton = document.getElementById("uploadButton");
document.getElementById("fileText").textContent = " ";
//Input change event listener
input.addEventListener("input", function() {
//Checks if an input is empty
if(input.value == "") {
  //If yes it disables the uploadButton
  uploadButton.disabled = true;

}
else {
  //If yes it enables the uploadButton
  uploadButton.disabled = false;
  //Deletes file parth. 
  document.getElementById("fileText").textContent = input.value.replace(input.value.substring(0, input.value.lastIndexOf("\\")) + "\\", "");
}
})
//END
//Entry opener
var oldentry;
function toggleEntry(x) {
  var tableRow = x;
  var entry = tableRow.parentNode;
  var entryPanel = tableRow.nextElementSibling;
  var entrys = document.querySelectorAll(".entry");
  
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
      oldentry = entry;
  }
  else {
      //If no it sets the oldentry var. undifened
      oldentry = undefined;
  }
}
//END

