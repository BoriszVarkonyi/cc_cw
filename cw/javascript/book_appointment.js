var appointments = document.querySelectorAll(".appointment")
console.log(appointments)
function selectAppointment(x) {
    var clickedAppointment = x
    //Removes all class, sets the innertext
    for (i = 0; i < appointments.length; i++) {
        appointments[i].classList.remove("disabled")
        appointments[i].classList.remove("select")
        appointments[i].querySelector("div").innerText = "Choose"
    }
    //Add disabled class to the unclicked ones
    for (i = 0; i < appointments.length; i++) {
        //if it is the clicked one then it continues
        if (appointments[i] == clickedAppointment) {
            continue;
        }
        else {
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
console.log(form)
var inputs = form.querySelectorAll(".form_wrapper input");
var sendButton = document.querySelector(".send_panel .send_button");
var opitons = form.querySelectorAll("#availabe_times_wrapper  input");
var valid1 = false, valid2 = false;
//sendButton.disabled = true;
function bookAppointmentsFormValidation() {
    var fencNumber = document.getElementById("fencerNumber");
    if (fencNumber.value > 100 || fencNumber.value == 0) {
        fencNumber.value = ""
    }
    for (i = 0; i < inputs.length; i++) {
        if (inputs[i].value == "") {
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
    for (i = 0; i < opitons.length; i++) {
        if (opitons[i].checked) {
            valid2 = true;
            break;
        }
        else {
            valid2 = false;
        }
    }
    if (valid1 && valid2) {
        console.log()
        //sendButton.disabled = false;
    }
    else {
       // sendButton.disabled = true;
    }
}
form.addEventListener("input", bookAppointmentsFormValidation)


//Shows the right apointsments
var fencNumberInput = document.getElementById("fencerNumber")
fencNumberInput.addEventListener("input", function () {
    var dates = document.querySelectorAll("#availabe_times_wrapper > div > p")
    var currentDiv = document.querySelectorAll("#availabe_times_wrapper > div")
    for (i = 0; i < dates.length; i++) {
        var minFencTime = dates[i].getAttribute("minperfencer")
        var time = minFencTime * fencNumberInput.value
        var appointmentsDivs = currentDiv[i].querySelectorAll(".appointment_wrapper");
        for (k = 0; k < appointmentsDivs.length; k++) {
            var minsLeft = appointmentsDivs[k].getAttribute("minsleft")
            if (time > minsLeft) {
                appointmentsDivs[k].style.display = "none";
            }
            else {
                appointmentsDivs[k].style.display = "block";
            }
        }

        for (k = 0; k < appointmentsDivs.length; k++) {
            var allHidden = false;
            if (appointmentsDivs[k].style.display == "none") {
                allHidden = true;
            }
            else {
                allHidden = false;
                break;
            }
        }
        if (allHidden) {
            currentDiv[i].style.display = "none";
        }
        else {
            currentDiv[i].style.display = "block";
        }

        //Display the minutes
        var minuteDisplay = currentDiv[i].querySelectorAll(".appointment .minute")
        for (k = 0; k < minuteDisplay.length; k++) {
            minuteDisplay[k].innerHTML = time
        }
    }
})

//Step buttons
var step1 = document.getElementById("step1")
var step2 = document.getElementById("step2")

function setNation(x) {
    var field = document.getElementById("inputs");
    field.value = x.innerHTML;
    bookAppointmentsFormValidation();
}


var panel = document.getElementById("confirmation");

function toggleConf() {
    panel.classList.toggle("hidden");
}
