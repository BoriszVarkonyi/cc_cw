var wctable = document.querySelector(".table_row_wrapper")
var addWeaponControlButton = document.getElementById("wcButton")
wctable.addEventListener("click", function(){
    var selectedItem = document.querySelector(".table_row_wrapper .selected")
    if(selectedItem !== null){
        addWeaponControlButton.disabled = true;
        addWeaponControlButton.classList.add("disabled")
    }
    else{
        addWeaponControlButton.disabled = false;
        addWeaponControlButton.classList.remove("disabled")
    }
})
document.onkeyup=function(e){
    if(e.shiftKey && e.which == 78) {
        addWeaponControlButton.click()
    }
}