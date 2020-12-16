var oldClickedDate;
var setWcPanel = document.getElementById("set_wc_panel");

//wcPanel toggle
function toggleWcPanel(x){
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
    //Timetable form placer
    var clickedDateBounding = clickedDate.getBoundingClientRect()
    var setWcPanelBounding = setWcPanel.getBoundingClientRect()
    var navbar = document.getElementById("nav_bar").getBoundingClientRect()
    var headerbar = document.getElementById("header_bar").getBoundingClientRect()
    var titlesprite = document.getElementById("title_stripe").getBoundingClientRect()
    var page = document.getElementById("page_content_panel_main").getBoundingClientRect()
    //console.log(clickedDateBounding.left-navbar.width)
    //console.log(page.height -setWcPanelBounding.bottom - headerbar.height - titlesprite.height -page.height)
    if(page.width > clickedDateBounding.right-navbar.width+setWcPanelBounding.width){
        setWcPanel.style.width = "454px"
        setWcPanel.style.left = clickedDateBounding.right-navbar.width
    }
    else{
        setWcPanel.style.left = clickedDateBounding.right-navbar.width-clickedDateBounding.width-setWcPanelBounding.width
    }
    //console.log(page.height)
    //console.log(page.height)
    console.log(clickedDateBounding.top - clickedDateBounding.width/2 + setWcPanelBounding.width/2 - headerbar.height)
    //console.log(clickedDateBounding.top - clickedDateBounding.width/2 + setWcPanelBounding.width/2 - headerbar.height - titlesprite.height - page.height)
    if(page.height > clickedDateBounding.top - clickedDateBounding.width/2 + setWcPanelBounding.width/2 - headerbar.height - titlesprite.height){
        setWcPanel.style.top = clickedDateBounding.top + clickedDateBounding.width/2  -setWcPanelBounding.width/2 - headerbar.height
    }
    else{
        //console.log(setWcPanelBounding.bottom - headerbar.height - titlesprite.height - page.height)
        setWcPanel.style.top = clickedDateBounding.top + clickedDateBounding.width/2  -setWcPanelBounding.width/2 - headerbar.height - (clickedDateBounding.top - clickedDateBounding.width/2 + setWcPanelBounding.width/2 - headerbar.height - titlesprite.height - page.height)
    }    
    
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

console.log(datesarray);

if(datesarray[0] != ""){

    for (let index = 0; index < datesarray.length; index++) {

        var addwc = document.getElementById(datesarray[index]);
        addwc.classList.add("has_wc");
    
        addwc.onclick = "removeWcDay(this)";
    
        //addwc.removeAttribute("onclick");
        
    }


}


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
    removewcinput.value = x.parentNode.parentNode.id;

    var warning = document.getElementById("remove_warning");
    warning.innerHTML = "Are you sure you want to remove weapon control of " + x.parentNode.parentNode.id + "?";
}

function closeConf() {
    conf.classList.add("hidden");
}
//Timetable form validation
var wcInput = document.getElementById("wc_input");
var input = document.querySelectorAll('#new_wc_day input');
var saveButton = document.querySelector(".panel_submit");
var wcTime = document.querySelectorAll(".table_row:not(.hidden) .wc_time");
//Set the "Save" button disabled.
saveButton.disabled = true;
//If the document values are changing, it runs the function.
document.addEventListener("input", function checkInput(){
    wcTime = document.querySelectorAll(".table_row:not(.hidden) .wc_time");
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
//Form drag;

// Make the DIV element draggable:
var dragButton = document.querySelector(".panel_button.drag");
var formDiv = document.getElementById("set_wc_panel");
var pageContent = document.getElementById("page_content_panel_main");
var pRect;
var tgtRect
dragElement(dragButton);


function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    // if present, the header is where you move the DIV from:
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV:
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.parentNode.style.top = (elmnt.parentNode.offsetTop - pos2) + "px";
    elmnt.parentNode.style.left = (elmnt.parentNode.offsetLeft - pos1) + "px";
    //Drag borders
    pRect = pageContent.getBoundingClientRect();
    tgtRect = formDiv.getBoundingClientRect();
    //
    if (tgtRect.left < pRect.left) formDiv.style.left = 0;
    if (tgtRect.top < pRect.top) formDiv.style.top = 0;
    if (tgtRect.right > pRect.right) formDiv.style.left = pRect.width - tgtRect.width + 'px';
    if (tgtRect.bottom > pRect.bottom) formDiv.style.top = pRect.height - tgtRect.height + 'px';
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}