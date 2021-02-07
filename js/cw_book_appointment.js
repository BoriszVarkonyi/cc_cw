var appointments = document.querySelectorAll(".appointment")
var oldClickedAppointment
function selectAppointment(x){
    var clickedAppointment = x
    if(oldClickedAppointment != clickedAppointment){
        //Removes all class, sets the innertext
        for(i=0; i<appointments.length; i++){
            appointments[i].classList.remove("disabled")
            appointments[i].classList.remove("select")
            appointments[i].querySelector("button").innerText = "Choose"
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
        clickedAppointment.querySelector("button").innerText = "Selected"
        //Saves the clicked one
        oldClickedAppointment = clickedAppointment;
    }
    else{
        //Removes all class, sets the inner text
        for(i=0; i<appointments.length; i++){
            appointments[i].classList.remove("disabled")
            appointments[i].classList.remove("select")
            appointments[i].querySelector("button").innerText = "Choose"
        }
        oldClickedAppointment = undefined;
    }
}