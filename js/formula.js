//Saves to Shift+S
document.addEventListener("keyup", function(e){
    if(e.shiftKey && e.which == 83) {
        var orangeSaveButton = document.querySelector(".stripe_button.orange")
        orangeSaveButton.click()
    }
})

//Form option Buttons
var useOptionButton = document.getElementById("used");
var useOptions = document.querySelectorAll("#useOptionContainer input");
var dontUseOptionButton = document.getElementById("not_used");

//Use option
function useOption(){
    for(i=0; i<useOptions.length; i++){
        useOptions[i].disabled = false;
    }
}
//Don't use option
function dontUseOption(){
    for(i=0; i<useOptions.length; i++){
        useOptions[i].checked = false;
        useOptions[i].disabled = true;
    }
}
dontUseOption();