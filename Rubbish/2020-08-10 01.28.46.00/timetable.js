//toggle weapon control for specific day panel
var panelfirst = document.getElementById("set_wc_panel");
panelfirst.classList.add("hidden");

function toggleWcPanel(x) {

    console.log("ege");

    const maxheight = window.innerHeight;
    const maxwidth = window.innerWidth;

    const clickedDay = x;
    const clickedDayPos = clickedDay.getBoundingClientRect();
    var cdx = clickedDayPos.left;
    var cdy = clickedDayPos.top;
    var cdw = clickedDayPos.width;


    var setWcPanel = document.getElementById("set_wc_panel");
    const setWcPanelPos = setWcPanel.getBoundingClientRect();
    var swx = setWcPanelPos.left;
    var swy = setWcPanelPos.top;
    var swr = setWcPanelPos.right;
    var swb = setWcPanelPos.bottom;

    console.log(cdx, cdy);
    console.log(swx, swy, swr, swb);


    if (swb >= maxheight) {
        setWcPanel.style.bottom = "10px";
        console.log("too long");
    } 
    
    if (swb < maxheight, swr < maxwidth) {
        setWcPanel.style.left = cdx + cdw;
        setWcPanel.style.top = cdy;
    }

    if (swr >= maxwidth) {
        setWcPanel.style.left = null;
        setWcPanel.style.right = "10px";
        console.log("too long");
    }

    
    setWcPanel.classList.remove("hidden");

    var texttoreplace = document.getElementById("panel_text");
    y = x.id;

    texttoreplace.innerHTML = y + " weapon control";

    hiddeninput = document.getElementById("save_date");
    hiddeninput.value = y;

    console.log(hiddeninput);
    
}

function closeWcPanel() {
    var setWcPanel = document.getElementById("set_wc_panel");
    setWcPanel.classList.add("hidden");
}

//END

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
//END

//Shows which day is today

var today = document.cookie.split('; ').find(row => row.startsWith('today')).split('=')[1];

var todayday = document.getElementById(today);
if(todayday){
    todayday.classList.add("today");
}

//END

//Adds new time period for specific day's weapon control
var periods = 2;
var forafter = 1;

function addPeriod(){
if(periods < 4){

afterwhich = document.getElementById("table_row_" + forafter);

var x = document.createElement("DIV");
x.setAttribute("class", "table_row");
x.setAttribute("id", "table_row_" + periods);
//document.getElementById("new_wc_day").appendChild(x);
afterwhich.after(x);

var newstart = document.createElement("DIV");
newstart.setAttribute("class", "table_item");
newstart.setAttribute("id", "start_" + periods);
document.getElementById("table_row_" + periods).appendChild(newstart);

var startinput = document.createElement("INPUT");
startinput.setAttribute("type", "time");
startinput.setAttribute("class", "number_input_big");
startinput.setAttribute("name", "wc_period_start_" + periods);
document.getElementById("start_" + periods).appendChild(startinput);


var newend = document.createElement("DIV");
newend.setAttribute("class", "table_item");
newend.setAttribute("id", "end_" + periods);
document.getElementById("table_row_" + periods).appendChild(newend);

var endinput = document.createElement("INPUT");
endinput.setAttribute("type", "time");
endinput.setAttribute("class", "number_input_big");
endinput.setAttribute("name", "wc_period_end_" + periods);
document.getElementById("end_" + periods).appendChild(endinput);

var removeperiod = document.createElement("BUTTON");
removeperiod.setAttribute("type", "button");
removeperiod.setAttribute("onclick", "removePeriod(this)");
removeperiod.setAttribute("class", "close_add_peroid");
removeperiod.setAttribute("id", "removebutton_" + periods);
document.getElementById("table_row_" + periods).appendChild(removeperiod);

var removeicon = document.createElement("IMG");
removeicon.setAttribute("src","../assets/icons/close-black-18dp.svg");
document.getElementById("removebutton_" + periods).appendChild(removeicon);


console.log(periods);
periods++;
}

}

function removePeriod(x){

var remove = document.getElementById(x.id);
let toremove = remove.parentNode.id;

var removeelement = document.getElementById(toremove);
periods = remove.id.charAt(remove.id.length-1);
removeelement.remove();



if(!document.getElementById("table_row_3") && !document.getElementById("table_row_2")){

periods = 2;

}

console.log(periods);

}
//END

//Adds has_wc class for the days that has weapon control on.

var dates = document.getElementById("dates_control_on");
var datesarray = dates.value.split(",");

for (let index = 0; index < datesarray.length; index++) {

    var addwc = document.getElementById(datesarray[index]);
    addwc.classList.add("has_wc");

    addwc.removeAttribute("onclick");
    
}

console.log(datesarray);
//END

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
warning.innerHTML = "Are you sure you want to remove weapon control of " + x.parentNode.id + "?"

}

function closeConf() {

    conf.classList.add("hidden");

}
