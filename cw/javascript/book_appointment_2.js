/*
var appointments = document.querySelectorAll(".appointment")
var appointmentDetailInputs = document.querySelectorAll(".appointment_details input")
var fencNumberInput = document.getElementById("fencerNumber")
appointmentDetailInputs.forEach(item => {
    item.addEventListener("input", function () {
        var fromTime =  parseInt(item.parentNode.previousElementSibling.querySelector("p").innerText.slice(0, 2) * 60) + parseInt(item.parentNode.previousElementSibling.querySelector("p").innerText.slice(3, 5))
        var tillTime = parseInt(item.parentNode.previousElementSibling.querySelector("p").innerText.slice(-5).slice(0, 2) * 60) + parseInt(item.parentNode.previousElementSibling.querySelector("p").innerText.slice(-2))
        var minFencTime = 5
        var time = minFencTime * fencNumberInput.value
        var starTime = parseInt(item.value.slice(0, 2) * 60) + parseInt(item.value.slice(-2)) 
        var endTime = item.parentNode.querySelector("p")

        endTime.innerHTML = " - " + intToTime(starTime+time)
        
        if(starTime + time > tillTime || starTime < fromTime){
            //item.parentNode.querySelector(".error").classList.add("hidden")
            console.log("AAAAAAAAAAAAAAAAAAAAAAAAAAAA")
        }
        else{
            //item.parentNode.querySelector(".error").classList.remove("hidden")
            console.log("okes minden jó")
        }
    })
})
*/
/*
var fencNumberInput = document.getElementById("fencerNumber")
var appointmentDetailInputs = document.querySelectorAll(".appointment_day .selected_start_time_input")


function intToTime(num){
    var hour = parseInt(num/60)
    var min = num - hour*60
    return hour + ":" + min;
}


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
            appointments[i].parentNode.nextElementSibling.classList.remove("hidden")
            continue;
        }
        else {
            //Adds disabled class
            appointments[i].classList.add("disabled")
            appointments[i].parentNode.nextElementSibling.classList.add("hidden")
        }
    }
    //Add selected class to the clicked one
    clickedAppointment.classList.add("selected")
    //Sets the innertext
    clickedAppointment.querySelector("div").innerText = "Selected"

}

*/

var form = document.getElementById("content_wrapper");
var inputs = form.querySelectorAll(".form_wrapper input");
var sendButton = document.querySelector(".send_panel .send_button");
var opitons = form.querySelectorAll("#availabe_times_wrapper  input");
var appointmentDetailInputs = document.querySelectorAll(".appointment_day .selected_start_time_input")
console.log(appointmentDetailInputs)
var valid1 = false, valid2 = false;
sendButton.disabled = true;
function bookAppointmentsFormValidation() {
    valid2 = false;
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
    for(i=0; i < appointmentDetailInputs.length; i++){
        console.log(appointmentDetailInputs[i])
        if(appointmentDetailInputs[i].value != ""){
            var inputValue = appointmentDetailInputs[i].value
            const regex = new RegExp('[0-9][0-9]:[0-9][0-9]')
            if(regex.test(inputValue)){
                var min = inputValue.slice(-2)
                var hour = inputValue.slice(0,2)
                if(min > -1 && min < 60 && hour > -1 && hour < 24){
                valid2 = true;
                }
            }
            else{
                valid2 = false;
            }
            break;
        }
    }
    if (valid1 && valid2) {
        sendButton.disabled = false;
    }
    else {
       sendButton.disabled = true;
    }
}
form.addEventListener("input", bookAppointmentsFormValidation)

function selectTime(x){
    var input = x.parentNode.previousElementSibling.previousElementSibling;
    input.value = x.innerHTML;
    bookAppointmentsFormValidation();
}

function openTimes(x){
    var searchResult = x.nextElementSibling.nextElementSibling;
    searchResult.classList.add("opened")
    searchBarClosed = false;
    for(i=0; i< appointmentDetailInputs.length; i++){
        appointmentDetailInputs[i].value = '';
    }
    searchEngine(x);
    bookAppointmentsFormValidation();
}