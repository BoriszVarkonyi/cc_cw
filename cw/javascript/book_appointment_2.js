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