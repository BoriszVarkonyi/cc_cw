function useAllReferees() {
    var selectReferees = document.getElementById("select_referees_panel");
    selectReferees.classList.add("disabled");
}

function selectReferees() {
    var selectReferees = document.getElementById("select_referees_panel");
    selectReferees.classList.remove("disabled");
}

function useAllPistes() {
    var selectPistes = document.getElementById("select_pistes_panel");
    selectPistes.classList.add("disabled");
}

function selectPistes() {
    var selectPistes = document.getElementById("select_pistes_panel");
    selectPistes.classList.remove("disabled");
}

var refPanel = document.getElementById("ref_panel");
var timePistPanel = document.getElementById("pist_time_panel");

function toggleRefPanel() {
    refPanel.classList.toggle("hidden");
}

function togglePistTimePanel() {
    timePistPanel.classList.toggle("hidden");
}

var eleminitaions = document.querySelectorAll(".elimination")
var btLeft = document.getElementById("buttonLeft")
var btRight = document.getElementById("buttonRight")
//Hides all the eliminations
for(i=0; i<eleminitaions.length; i++){
    eleminitaions[i].classList.add("hidden")
}
//Shows eleminiations by index
var firstIndex = 0;
var secondIndex;
if(eleminitaions.length > 4){
    secondIndex = 4;
}
else{
    secondIndex = eleminitaions.length
}
btLeft.classList.add("disabled")
for(i=firstIndex; i<secondIndex; i++){
    eleminitaions[i].classList.remove("hidden")

}
function buttonLeft(){
    btLeft.classList.remove("disabled")
    btRight.classList.remove("disabled")
    firstIndex--
    secondIndex--
    //Hides all the eliminations
    for(i=0; i<eleminitaions.length; i++){
        eleminitaions[i].classList.add("hidden")
    }
    //Shows eleminiations by index
    for(i=firstIndex; i<secondIndex; i++){
        eleminitaions[i].classList.remove("hidden")

    }
    disabler();
}
function buttonRight(){
    btLeft.classList.remove("disabled")
    btRight.classList.remove("disabled")
    firstIndex++
    secondIndex++
    //Hides all the eliminations
    for(i=0; i<eleminitaions.length; i++){
        eleminitaions[i].classList.add("hidden")
    }
    //Shows eleminiations by index
    for(i=firstIndex; i<secondIndex; i++){
        eleminitaions[i].classList.remove("hidden")

    }
    disabler();
}
function disabler(){
    if(firstIndex ==0) {
        btLeft.classList.add("disabled")
    }
    if(secondIndex == eleminitaions.length) {
        btRight.classList.add("disabled")
    }
}

//Gets window size
window.addEventListener("resize", windowSize);
window.addEventListener("DOMContentLoaded", windowSize);
var vw;
//Chagnes the shown table numbers by the window size
function windowSize(){
    vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0)
    if(vw > 1600 && eleminitaions.length>=4){
        for(i=0; i<eleminitaions.length; i++){
            eleminitaions[i].classList.add("hidden")
        }
        secondIndex = firstIndex + 4;
        for(i=firstIndex; i<secondIndex; i++){
            eleminitaions[i].classList.remove("hidden")

        }
    }
    else if(vw > 1100 && vw < 1600 && eleminitaions.length>=3){
        for(i=0; i<eleminitaions.length; i++){
            eleminitaions[i].classList.add("hidden")
        }
        secondIndex = firstIndex + 3;
        for(i=firstIndex; i<secondIndex; i++){
            eleminitaions[i].classList.remove("hidden")

        }
    }
    else if(vw > 700 && vw < 1100 && eleminitaions.length>=2){
        for(i=0; i<eleminitaions.length; i++){
            eleminitaions[i].classList.add("hidden")
        }
        secondIndex = firstIndex + 2;
        for(i=firstIndex; i<secondIndex; i++){
            eleminitaions[i].classList.remove("hidden")

        }
    }
    else if(vw < 700){
        for(i=0; i<eleminitaions.length; i++){
            eleminitaions[i].classList.add("hidden")
        }
        secondIndex = firstIndex + 1;
        for(i=firstIndex; i<secondIndex; i++){
            eleminitaions[i].classList.remove("hidden")

        }
    }
    var shownEliminations = document.querySelectorAll(".elimination:not(.hidden)")
    if(shownEliminations.length == eleminitaions.length){
        btRight.classList.add("disabled")
    }
}
//Automaticly sets the table title
var eliminations = document.querySelectorAll(".elimination_label")
var tableOfIndex = 8;
for(i=eliminations.length-1; i>=0; i--){
    if(i == eliminations.length-1){
        eliminations[i].innerHTML = "Winner"
    }
    else if(i == eliminations.length-2){
        eliminations[i].innerHTML = "Final"
    }
    else if(i == eliminations.length-3){
        eliminations[i].innerHTML = "Semi Final"
    }
    else{
        eliminations[i].innerHTML = "Table of " + tableOfIndex
        tableOfIndex = tableOfIndex*2
    }

}

//Table zoom in/zzom out buttons
var tableRounds = document.querySelectorAll(".table_round");
var marginNumber = 30;

function tableZoomOut(){
    marginNumber -= 1;
    for(i=0; i<tableRounds.length; i++){
        tableRounds[i].style.marginTop = (marginNumber) + "px";
        tableRounds[i].style.marginBottom = (marginNumber) + "px";
    }
    zoomButtonDisabler();
}

function tableZoomIn(){
    marginNumber += 1;
    for(i=0; i<tableRounds.length; i++){
        tableRounds[i].style.marginTop = (marginNumber) + "px";
        tableRounds[i].style.marginBottom = (marginNumber) + "px";
    }
    zoomButtonDisabler();
}
var zoomOutButton = document.getElementById("zoomOutButton");
var zoomInButton = document.getElementById("zoomInButton");
function zoomButtonDisabler(){
    if(marginNumber <= 5){
        holding = false;
        zoomOutButton.disabled = true;
    }
    else{
        zoomOutButton.disabled = false;
    }
    if(marginNumber >= 50){
        holding = false;
        zoomInButton.disabled = true;
    }
    else{
        zoomInButton.disabled = false;
    }
}

//Check if zoom in/ zoom out butto is held down for x sec
var buttons = [zoomInButton, zoomOutButton]
var lastKeyUpAt = 0;
var canAutoZoom = false;
buttons.forEach(item => {
    item.addEventListener('mousedown', function() {
        // Set key down time to the current time
        var keyDownAt = new Date();
        canAutoZoom = false;
        // Use a timeout with 1000ms (this would be your X variable)
        setTimeout(function() {
            // Compare key down time with key up time
            if (+keyDownAt > +lastKeyUpAt){
                canAutoZoom = true;// Key has been held down for x seconds
            }
            else{
                canAutoZoom = false;// Key has not been held down for x seconds
            }
        }, 250);
    });
})

buttons.forEach(item => {
    item.addEventListener('mouseup', function() {
        // Set lastKeyUpAt to hold the time the last key up event was fired
        lastKeyUpAt = new Date();
    });
})

//Zoom out button hold
function oGetCursorPosition(zoomOutButton, event) {
  const rect = zoomOutButton.getBoundingClientRect()
  const x = event.clientX - rect.left
  const y = event.clientY - rect.top
  if(!zoomOutButton.disabled && canAutoZoom){
    tableZoomOut();
  }
}
var omousePosition, oholding;

function oMyInterval() {
  var setIntervalId = setInterval(function() {
    if (!holding) clearInterval(setIntervalId);
    oGetCursorPosition(zoomOutButton, mousePosition);
  }, 100); //set your wait time between consoles in milliseconds here
}
zoomOutButton.addEventListener('mousedown', function() {
    holding = true;
    oMyInterval();
})
zoomOutButton.addEventListener('mouseup', function() {
    holding = false;
    oMyInterval();
})
zoomOutButton.addEventListener('mouseleave', function() {
    holding = false;
})
zoomOutButton.addEventListener('mousemove', function(e) {
    mousePosition = e;
})

//Zoom in button hold
function iGetCursorPosition(zoomInButton, event) {
const rect = zoomInButton.getBoundingClientRect()
const x = event.clientX - rect.left
const y = event.clientY - rect.top
if(!zoomInButton.disabled && canAutoZoom){
    tableZoomIn();
}
}
var imousePosition, iholding;

function iMyInterval() {
var setIntervalId = setInterval(function() {
    if (!holding) clearInterval(setIntervalId);
    iGetCursorPosition(zoomInButton, mousePosition);
}, 100); //set your wait time between consoles in milliseconds here
}
zoomInButton.addEventListener('mousedown', function() {
    holding = true;
    iMyInterval();
})
zoomInButton.addEventListener('mouseup', function() {
    holding = false;
    iMyInterval();
})
zoomInButton.addEventListener('mouseleave', function() {
    holding = false;
})
zoomInButton.addEventListener('mousemove', function(e) {
    mousePosition = e;
})




