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