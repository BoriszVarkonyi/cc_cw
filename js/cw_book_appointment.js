var appointments = document.querySelectorAll(".appointment")
function selectAppointment(x){
    var clickedAppointment = x
    //Removes all class, sets the innertext
    for(i=0; i<appointments.length; i++){
        appointments[i].classList.remove("disabled")
        appointments[i].classList.remove("select")
        appointments[i].querySelector("div").innerText = "Choose"
    }
    //Add disabled class to the unclicked ones
    for(i=0; i<appointments.length; i++){
        //if it is the clicked one then it continues
        if(appointments[i] == clickedAppointment){
            continue;
        }
        else{
            //Adds disabled class
            appointments[i].classList.add("disabled")
        }
    }
    //Add selected class to the clicked one
    clickedAppointment.classList.add("selected")
    //Sets the innertext
    clickedAppointment.querySelector("div").innerText = "Selected"
}

//Form validation

var form = document.getElementById("content_wrapper");
var inputs = form.querySelectorAll(".form_wrapper input");
var findAppsButton = form.querySelector(".send_button.center")
var sendButton = document.querySelector(".send_panel .send_button");
var opitons = form.querySelectorAll("#availabe_times_wrapper > input");
var valid1 = false, valid2 = false;
findAppsButton.disabled = true;
sendButton.disabled = true;
function bookAppointmentsFormValidation(){
    for(i=0; i<inputs.length; i++){
        if(inputs[i].value == ""){
            //If it finds an empty input, then it disable the "Save" button.
            findAppsButton.disabled = true;
            valid1 = false;
            break;
        }
        else {
            //If everything has a value then it enable the "Save" Button. The user can save.
            findAppsButton.disabled = false;
            valid1 = true;
        }
    }
    for(i=0; i<opitons.length; i++){
        if(opitons[i].checked){
            valid2 = true;
            break;
        }
        else{
            valid2 = false;
        }
    }
    if(valid1 && valid2){
        sendButton.disabled = false;
    }
    else{
        sendButton.disabled = true;
    }
}
form.addEventListener("input", bookAppointmentsFormValidation)

//Step buttons
var step1 = document.getElementById("step1")
var step2 = document.getElementById("step2")
function findAppointmentsButton(){
    step2.classList.remove("collapsed")
    step1.classList.add("collapsed")
    bookAppointmentsFormValidation();
}

function editButton(){
    step1.classList.remove("collapsed")
    step2.classList.add("collapsed")
    //Removes all class, sets the innertext
    for(i=0; i<appointments.length; i++){
        appointments[i].classList.remove("disabled")
        appointments[i].classList.remove("select")
        appointments[i].parentElement.previousElementSibling.checked = false
        appointments[i].querySelector("div").innerText = "Choose"
        sendButton.disabled = true;
    }
}

function setNation(x){
    var field = document.getElementById("inputs");
    field.value = x.innerHTML;
    bookAppointmentsFormValidation();
}