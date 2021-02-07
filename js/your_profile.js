//Image upload
var input = document.getElementById("file");
document.getElementById("fileText").textContent = " ";
//Input change event listener
input.addEventListener("input", function() {
    //Deletes file parth.
    document.getElementById("fileText").textContent = input.value.replace(input.value.substring(0, input.value.lastIndexOf("\\")) + "\\", "");
})

//Closes the page
function closePage() {
    close();
}

//Saves to Shift+S
document.addEventListener("keyup", function(e){
    if(e.shiftKey && e.which == 83) {
        var orangeSaveButton = document.querySelector(".stripe_button.orange")
        orangeSaveButton.click()
    }
    if(e.shiftKey && e.which == 67) {
        closePage();
    }
})
