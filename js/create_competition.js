//Form validation
var form = document.getElementById("create_new_comp");
var titleInput = document.querySelector(".title_input");
var createButton = document.querySelector(".stripe_button.primary");
var optionContainers = document.querySelectorAll(".option_container");
var valid1 = false, valid2 =false;
createButton.classList.add("disabled")
function crtTformValidation(){
    if(titleInput.value == ""){
        valid1 = false;
    }
    else{
        valid1 = true;
    }
    valid2 = true;
    for(i=0; i<optionContainers.length; i++){
        var options = optionContainers[i].querySelectorAll("input")
        if(valid2){
            for(k=0; k<options.length; k++){
                if(options[k].checked){
                    valid2 = true;
                    break;
                }
                else{
                    valid2 = false;
                }
            }
        }
    }
    if(valid1 && valid2){
        createButton.classList.remove("disabled")
    }
    else{
        createButton.classList.add("disabled")
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