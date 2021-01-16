//Image upload
var input = document.getElementById("file");
document.getElementById("fileText").textContent = " ";
//Input change event listener
input.addEventListener("input", function() {
    //Deletes file parth. 
    document.getElementById("fileText").textContent = input.value.replace(input.value.substring(0, input.value.lastIndexOf("\\")) + "\\", "");
})