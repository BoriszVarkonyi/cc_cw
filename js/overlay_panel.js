//Overlay panels
var overlayPanelAll = document.querySelectorAll(".overlay_panel");
var overlayPanelsOepened = [];
var somethingisOpened = false;

function overlayPanel() {
    var overlayPanelsHidden = [];
    //Push to appropriate array by class.
    for(i=0; i<overlayPanelAll.length; i++) {
        if(overlayPanelAll[i].classList.contains("hidden")) {
            overlayPanelsHidden.push(overlayPanelAll[i]);
        }
        else {
            overlayPanelsOepened.push(overlayPanelAll[i])
        }
    }
    //It updates the overlayPanelsOepened array.
    if(overlayPanelsOepened.length>1){
        for(i=0; i<overlayPanelsOepened.length; i++) {
            overlayPanelsOepened.pop()
        }
        overlayPanelsOepened[0].classList.add("hidden")
        overlayPanelsOepened.pop()
    }
    //Check if the first array element contains hidden.
    else {
        for(i=0; i<overlayPanelsOepened.length; i++) {
            //If yes it pops.
            if(overlayPanelsOepened[i].classList.contains("hidden")) {
                overlayPanelsOepened.pop()
            }
        }
    }
    if(overlayPanelsOepened.length == 1){
        somethingisOpened = true;
        var firstInput = overlayPanelsOepened[0].querySelector("input:first-of-type:not(input[type=radio])")
        if(firstInput != null && !firstInput.classList.contains("hidden")){
            firstInput.focus();
        }   
    }
    else{
        somethingisOpened = false;
    }
}
var somethingisOpened = false;

//Event listener to class change (overlay panels)
function callback(mutationsList, observer) {
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
            overlayPanel()
            formvariableDeclaration()
        }
    })
}
    
const mutationObserver = new MutationObserver(callback)
for(i=0; i<overlayPanelAll.length; i++){
mutationObserver.observe(overlayPanelAll[i], { attributes: true })
}

//FORM VALIDATION
function formvariableDeclaration() {
    if(overlayPanelsOepened.length == 1) {
        var formelement = overlayPanelsOepened[0].querySelector(".overlay_panel_form")
        if(formelement != null){
            var overlayForm = document.querySelector(".overlay_panel:not( .hidden) .overlay_panel_form"); 
            var inputs = document.querySelectorAll(".overlay_panel:not( .hidden) .overlay_panel_form input:not(input[type=radio])");
            var saveButton = document.querySelector(".overlay_panel:not( .hidden) .overlay_panel_form .panel_submit");
            var optionContainers = overlayForm.querySelectorAll(".option_container");
            formValidation(overlayForm, inputs, saveButton, optionContainers);
        }
    }
}
var canAutoValidate = true;
function formValidation(overlayForm, inputs, saveButton, optionContainers){
    if(canAutoValidate){
        var valid1 = false, valid2 = false;
        saveButton.disabled = true;
        //If the document values are changing, it runs the function.
        function validation(){
            //Checking every input.
            for(i=0; i<inputs.length; i++){
                if(inputs[i].value == ""){
                    //If it finds an empty input, then it disable the "Save" button.
                    valid1 = false;
                    break;      
                }
                else {
                    //If everything has a value then it enable the "Save" Button. The user can save.
                    valid1 = true;      
                }
            }
            if(optionContainers.length == 0){
                valid2 = true;
            }
            else{
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
            }   
            if(valid1 && valid2){
                saveButton.disabled = false;
            }
            else{
                saveButton.disabled = true;
            }
        }
        validation();
        overlayForm.addEventListener("input", validation)
    }    
}