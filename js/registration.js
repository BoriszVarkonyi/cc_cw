var addFencerPanel = document.getElementById("add_fencer_panel");

function toggleAddFencerPanel() {
    addFencerPanel.classList.remove("hidden");
}

function setNation(x){
    var field = document.getElementById("inputs");
    field.value = x.innerHTML;
}
var isselected = false;
var registrationtable = document.querySelector(".table_row_wrapper")
registrationtable.addEventListener("click", function(){
    var selectedItem = document.querySelector(".table_row_wrapper .selected")
    if(selectedItem !== null){
        isselected = true; 
    }
    else{
        isselected = false;
    }
    console.log(isselected)
})
document.onkeyup=function registrationkeyevents(e){
    if(e.shiftKey && e.which == 65) {
        var addfencer = document.getElementById("addFencer")
        addfencer.click()
    }
    if(isselected){
        if(e.shiftKey && e.which == 79) {
            var regOutButton = document.getElementById("regOut")
            regOutButton.click()
        }
        if(e.shiftKey && e.which == 73) {
            var regInButton = document.getElementById("regIn")
            regInButton.click()
        } 
    }
}
