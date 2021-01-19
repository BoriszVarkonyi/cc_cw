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
registrationtable.addEventListener("click", selectChecker)
function selectChecker(){
    var selectedItem = document.querySelector(".table_row_wrapper .selected")
    if(selectedItem !== null){
        isselected = true; 
    }
    else{
        isselected = false;
    }
    buttonDisabler();
}
function buttonDisabler(){
    var regInButton = document.getElementById("regIn")
    var regOutButton = document.getElementById("regOut")
    if(isselected){
        regInButton.classList.remove("disabled");
        regOutButton.classList.remove("disabled");
    }
    else{
        regInButton.classList.add("disabled");
        regOutButton.classList.add("disabled");
    }
}
selectChecker();
document.addEventListener("keyup", function(e){
    //somethingisOpened is a var. from main.js
    if(!somethingisOpened){
        //Opens add registration to Shift+A
        if(e.shiftKey && e.which == 65) {
            var addfencer = document.getElementById("addFencer")
            addfencer.click()
        }
        if(isselected){
            //Regist out to Shift+O
            if(e.shiftKey && e.which == 79) {
                var regOutButton = document.getElementById("regOut")
                regOutButton.click()
            }
            //Regists in to Shift+I
            if(e.shiftKey && e.which == 73) {
                var regInButton = document.getElementById("regIn")
                regInButton.click()
            } 
        }
    }
    selectChecker();
})
