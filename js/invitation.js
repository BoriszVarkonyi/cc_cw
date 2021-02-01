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

//Add entry button.
var addEntryPanel = document.getElementById("add_entry")
var addingEntryPanel = document.getElementById("adding_entry");

//Toggles the classes.
function hideNshow () {
  addEntryPanel.classList.toggle("hidden");
  addingEntryPanel.classList.toggle("hidden");
}

var addInformationInput = addingEntryPanel.querySelector("input")
var addInformationButton = addingEntryPanel.querySelector(".save_entry")

addInformationButton.classList.add("disabled")

addingEntryPanel.addEventListener("input", entryformvalidation)
//Entry form validation
function entryformvalidation(){
    if(addInformationInput.value == ""){
        addInformationButton.classList.add("disabled")
    }
    else{
        addInformationButton.classList.remove("disabled")
    }
}

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

//Entry opener
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
      if(entrys[i] == entry){
          selectedElementIndexAnn = i;
      }

  } 
  //Checking if the oldentry var. equals the entry.
  if(entry == oldentry){
      //If yes then it adds opened, and remove collapsed.
      entryPanel.classList.remove("collapsed");
      entry.classList.add("opened");
      selectedElementIndexAnn = 0;
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
}
document.addEventListener("keyup", function(e){
  //Saves to Shift+S
  if(e.shiftKey && e.which == 83) {
    var orangeSaveButton = document.querySelector(".stripe_button.orange")
    orangeSaveButton.click()
  }
  //Prints to Shift+P
  if(e.shiftKey && e.which == 80) {
  var stripeButton = document.querySelector(".stripe_button")
  stripeButton.click()
}
})

var IsNotFocused = true;
var openedForm =  document.querySelectorAll(".db_panel_main .entry_panel textarea")
openedForm.forEach(item => { 
    item.addEventListener("focus", function(){
        IsNotFocused = false;
    })
    item.addEventListener("blur", function(){
        IsNotFocused = true;
    })
})

var selectedElementIndexAnn = 0;
document.onkeydown = (keyDownEvent) => {
    //Arrow system
    if(IsNotFocused){
        if(keyDownEvent.key == "ArrowUp"){
            var tableRows = document.querySelectorAll(".db_panel_main  .entry")
            var forms =  document.querySelectorAll(".db_panel_main form")
            if(selectedElementIndexAnn == 0) {
                selectedElementIndexAnn++
            }
            selectedElementIndexAnn--
            forms[selectedElementIndexAnn + 1].classList.add("collapsed")
            tableRows[selectedElementIndexAnn + 1].classList.remove("opened")
            tableRows[selectedElementIndexAnn + 1].blur()
            forms[selectedElementIndexAnn].classList.remove("collapsed")
            tableRows[selectedElementIndexAnn].classList.add("opened")
            tableRows[selectedElementIndexAnn].focus()
            keyDownEvent.preventDefault();
        }


        if(keyDownEvent.key == "ArrowDown"){
            //Cheks if theres a selected row.
            var hasSelected = false;
            var tableRows = document.querySelectorAll(".db_panel_main  .entry")
            var forms =  document.querySelectorAll(".db_panel_main form")
            for(i=0; i<tableRows.length; i++) {
                if(tableRows[i].classList.contains("opened")){
                    hasSelected = true
                    break;
                }
            }
            if(hasSelected){
                if(selectedElementIndexAnn == tableRows.length -1) {
                    selectedElementIndexAnn--
                }
                selectedElementIndexAnn++
                forms[selectedElementIndexAnn - 1].classList.add("collapsed")
                tableRows[selectedElementIndexAnn - 1].classList.remove("opened")
                tableRows[selectedElementIndexAnn - 1].blur()
                forms[selectedElementIndexAnn].classList.remove("collapsed")
                tableRows[selectedElementIndexAnn].classList.add("opened")
                tableRows[selectedElementIndexAnn].focus()
                keyDownEvent.preventDefault();
            }
            //If there is not a selected row than it selects the first row.
            else{
                forms[selectedElementIndexAnn].classList.remove("collapsed")
                tableRows[selectedElementIndexAnn].classList.add("opened")
                tableRows[selectedElementIndexAnn].focus()
            }
        }
    }    
} 