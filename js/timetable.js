var oldClickedDate;
var setWcPanel = document.getElementById("set_wc_panel");

//wcPanel toggle
function toggleWcPanel(x) {
    var clickedDate = x;
    //hide the wcPanwel
    setWcPanel.classList.add("hidden")
    if(clickedDate == oldClickedDate) {
        setWcPanel.classList.remove("hidden");
        
    }
    setWcPanel.classList.toggle("hidden");
    //If setwcPanel contains hidden
    if(setWcPanel.classList.contains("hidden")){
        //it sets oldclickedDate undefined
        oldClickedDate = undefined;
    }
    else {
        //It stets oldClickeddate to clickeddate
        oldClickedDate = clickedDate;
    }


    var texttoreplace = document.getElementById("panel_text");
    y = x.id;

    texttoreplace.innerHTML = y + " weapon control";

    hiddeninput = document.getElementById("save_date");
    hiddeninput.value = y;
}

function closeWcPanel() {
    setWcPanel.classList.add("hidden");
}



//Shows which day the competition starts and ends on

var startdate = document.cookie.split('; ').find(row => row.startsWith('comp_start')).split('=')[1];
var enddate = document.cookie.split('; ').find(row => row.startsWith('comp_end')).split('=')[1];

var start = document.getElementById(startdate);
console.log(startdate);
if(start){
start.classList.add("start");
}
var end = document.getElementById(enddate);
console.log(end);
if(end){
end.classList.add("end");
}


//Shows which day is today

var today = document.cookie.split('; ').find(row => row.startsWith('today')).split('=')[1];

var todayday = document.getElementById(today);
if(todayday){
    todayday.classList.add("today");
}



//Adds new time period for specific day's weapon control
/*
var indexNumber = 2;
var addPeriodButton = document.querySelector(".add_peroid_container")
addPeriodButton.classList.add("hidden")

function addPeriod(){
document.getElementById("table_row_" + indexNumber).classList.remove("hidden")
indexNumber++;
checkInput();
if(indexNumber == 4) {
    addPeriodButton.classList.add("hidden")
}
}

function removePeriod(){

}

*/
//Adds has_wc class for the days that has weapon control on.

var dates = document.getElementById("dates_control_on");
var datesarray = dates.value.split(",");

for (let index = 0; index < datesarray.length; index++) {

    var addwc = document.getElementById(datesarray[index]);
    //addwc.classList.add("has_wc");

    //addwc.removeAttribute("onclick");
    
}

console.log(datesarray);


//Removes onclick attribute from dates which has already weapon control

/*for (let index = 0; index < datesarray; index++) {
    
    var noonclick = document.getElementById(datesarray[index]);
    noonclick.onclick = "";

    console.log(noonclick);
}*/

//Remove WC day

var conf = document.getElementById("confirmation");

function removeWcDay(x) {
    console.log(x);
    conf.classList.remove("hidden");

    var removewcinput = document.getElementById("remove_date");
    removewcinput.value = x.parentNode.id;

    var warning = document.getElementById("remove_warning");
    warning.innerHTML = "Are you sure you want to remove weapon control of " + x.parentNode.id + "?";
}

function closeConf() {
    conf.classList.add("hidden");
}

var wcInput = document.getElementById("wc_input");
var input = document.querySelectorAll('#new_wc_day input');
var saveButton = document.querySelector(".panel_submit");


//Set the "Save" button disabled.
saveButton.disabled = true;

//If the document values are changing, it runs the function.
document.addEventListener("input", function checkInput(){
    var wcTime = document.querySelectorAll(".table_row:not(.hidden) .wc_time");
    //Check the "wcInput" input value.
    if(wcInput.value>20 || wcInput.value < 0) {
    //If its grather than 20 or less than 0, it sets the value "" (0).
    wcInput.value = "";
    }

    for(i=0; i<wcTime.length; i++){
        if(wcTime[i].value>24 || wcTime[i].value< 0) {
            //If its grather than 24 or less than 0, it sets the value "" (0).
            wcTime[i].value = "";
        }
    }   
    //Checking every input.
    for(i=0; i<wcTime.length; i++){
        
        if(wcInput.value == "" || wcTime[i].value == ""){
        //If it finds an empty input, then it disable the "Save" button.
        saveButton.disabled = true;
        //addPeriodButton.classList.add("hidden")
        break;

        }
        else {
        //If everything has a value then it enable the "Save" Button. The user can save.
        saveButton.disabled = false;
        //addPeriodButton.classList.remove("hidden")
        }
    }
    }
)
