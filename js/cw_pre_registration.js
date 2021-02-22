var sfw = document.getElementById("selected_fencers_wrapper");
var wrapper = document.getElementById("select_fencers_wrapper");

function selectFencer(x){
    var current = document.getElementById(x.id);
    var currentname = current.getElementsByTagName("div")[1].innerHTML;
    current.classList.add("hidden");
    sfw.innerHTML += '<div><input type="number" name=""  class="hidden"><p>'+ currentname +'</p><button id="'+ x.id +'" onclick="removeSelection(this)" type="button"><img src="../assets/icons/close-black-18dp.svg" ></button></div>'
}

function removeSelection(x) {
    var toremove = document.getElementById(x.id);
    var toshow = document.getElementsByClassName("hidden");
    console.log(toshow);
    for (let index = 0; index < toshow.length; index++) {
        var element = toshow[index];

        if(element.id == x.id){
            element.classList.remove("hidden")
        }
    }
    toremove.parentElement.remove();
}

var panel = document.getElementById("confirmation");
var fenceridto = document.getElementById("fencer_ids");
var finalids = [];

function openConf() {
    panel.classList.remove("hidden");
}

function closeConf() {
    panel.classList.add("hidden");
}

//Search engine


var step1 = document.getElementById("step1")
var step2 = document.getElementById("step2")

//Form validation
var form = document.getElementById("content_wrapper");
var inputs = form.querySelectorAll(".form_wrapper input:not(input.disabled)");
var sendButton = document.querySelector(".send_panel .send_button");
var valid1 = false, valid2 = false;
sendButton.disabled = true;
function bookAppointmentsFormValidation(){
    for(i=0; i<inputs.length; i++){
        if(inputs[i].value == ""){
            //If it finds an empty input, then it disable the "Save" button.
            step2.classList.add("collapsed")
            valid1 = false;
            break;
        }
        else {
            //If everything has a value then it enable the "Save" Button. The user can save.
            step2.classList.remove("collapsed")
            valid1 = true;
        }
    }
    valid2 = true;
    if(valid1 && valid2){
        sendButton.disabled = false;
    }
    else{
        sendButton.disabled = true;
    }
}
form.addEventListener("input", bookAppointmentsFormValidation)