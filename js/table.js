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
var secondIndex = 4;
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