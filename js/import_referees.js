//Image upload
var input = document.getElementById("fileToUpload");
var uploadButton = document.getElementById("import_button");
var filetext = document.getElementById("file_text")
document.getElementById("file_text").textContent = " ";
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
    document.getElementById("file_text").textContent = input.value.replace(input.value.substring(0, input.value.lastIndexOf("\\")) + "\\", "");
  }
  //Check if its an xml file.
  //if not it deletes the input value, and send an error message
  if(filetext.innerHTML.substr(filetext.innerHTML.lastIndexOf('.') + 1) !== "xml"){
   filetext.innerHTML = "Incorrect file format"
   input.value = ""
  }
  //If yes then it reads the file
  else{
    var file, fr, parser;
    file = input.files[0];
    fr = new FileReader();
    parser = new DOMParser();
    fr.onload = receivedText;
    fr.readAsText(file, 'ISO-8859-1');

    var tablewrapper = document.querySelector(".table_row_wrapper")
    function receivedText() {
      //Creates rows in the table.
      var doc = parser.parseFromString(fr.result, "text/xml");
      var tireurs = doc.getElementsByTagName("Arbitre")
      for(i=0; i<(tireurs.length/2)-1; i++){
        tablewrapper.innerHTML = tablewrapper.innerHTML + '<div class="table_row"><div class="table_item"><p>g</p></div><div class="table_item"><p>g</p></div><div class="table_item"><p>g</p></div><div class="table_item"><p>g</p></div><div class="table_item"><p>g</p></div><div class="table_item"><p>g</p></div></div>'
      }
      //Count the created rows
      var tablerows = document.querySelectorAll(".table_row")
      //Fills the rows with the data
      for(i=0; i<tireurs.length/2; i++){
        var tableitems = tablerows[i].querySelectorAll(".table_item")
        tableitems[0].firstElementChild.innerHTML = doc.getElementsByTagName("Arbitre")[i].getAttribute("ID")
        tableitems[1].firstElementChild.innerHTML = doc.getElementsByTagName("Arbitre")[i].getAttribute("Prenom")
        tableitems[2].firstElementChild.innerHTML = doc.getElementsByTagName("Arbitre")[i].getAttribute("Nom")
        tableitems[3].firstElementChild.innerHTML = doc.getElementsByTagName("Arbitre")[i].getAttribute("Nation")
        tableitems[4].firstElementChild.innerHTML = doc.getElementsByTagName("Arbitre")[i].getAttribute("Club")
        tableitems[5].firstElementChild.innerHTML = doc.getElementsByTagName("Arbitre")[i].getAttribute("Categorie")
      }
      //This is a function from list.js
      automaticWidth();
    }
  }
})
