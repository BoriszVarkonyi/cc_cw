//Form validation
var form = document.getElementById("create_new_comp");
var titleInput = document.querySelector(".title_input");
var createButton = document.querySelector(".stripe_button.primary");
var optionContainers = document.querySelectorAll(".option_container");
var valid1 = false, valid2 =false;
createButton.classList.add("disabled")
function crtTformValidation(){
    if(titleInput.value == ""){
        valid2 = false;
    }
    else{
        valid1 = true;
    }
    for(i=0; i<optionContainers.length; i++){
        var options = optionContainers[i].querySelectorAll("input")
        
    }
}
form.addEventListener("input", crtTformValidation)
function errorChecker(x){
    if(x.value == ""){
        x.previousElementSibling.classList.add("error")
    }
    else{
        x.previousElementSibling.classList.remove("error")
    }
}