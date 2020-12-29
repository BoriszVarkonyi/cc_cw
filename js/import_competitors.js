//Image upload
var input = document.getElementById("fileToUpload");
var uploadButton = document.getElementById("import_button");
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

console.log(uploadButton)