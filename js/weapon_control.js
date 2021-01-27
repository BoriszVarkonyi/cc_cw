var wctable = document.querySelector(".table_row_wrapper")
var addWeaponControlButton = document.getElementById("wcButton")
var sendMessageButton = document.getElementById("sendMessageButton")
addWeaponControlButton.disabled = true;
sendMessageButton.disabled = true;
addWeaponControlButton.classList.add("disabled")
sendMessageButton.classList.add("disabled")
function buttonDisabler(){
    var selectedItem = document.querySelector(".table_row_wrapper .selected")
    if(selectedItem !== null){
        addWeaponControlButton.disabled = false;
        sendMessageButton.disabled = false;
        addWeaponControlButton.classList.remove("disabled")
        sendMessageButton.classList.remove("disabled")
    }
    else{
        addWeaponControlButton.disabled = true;
        sendMessageButton.disabled = true;
        addWeaponControlButton.classList.add("disabled")
        sendMessageButton.classList.add("disabled")
    }
}

var wcRows = document.querySelectorAll(".table_row_wrapper .table_row")
//Event listener to class change
function callback(mutationsList, observer) {
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
            buttonDisabler()
        }
    })
}
    
const mutationObserver2 = new MutationObserver(callback)
for(i=0; i<wcRows.length; i++){
mutationObserver2.observe(wcRows[i], { attributes: true })
}

wctable.addEventListener("click", buttonDisabler)    

document.addEventListener("keyup", function(e){
    //searchBarClosed is a var. from control.js
    if(searchBarClosed){
        if(e.shiftKey && e.which == 65) {
            addWeaponControlButton.click()
        }
    }
        
})