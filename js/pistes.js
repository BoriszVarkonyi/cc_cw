//PISTES SETTINGS
var oldclickedPiste;
function togglePisteSettings(x) {
    var clickedPisteButton = x;
    var clickedPiste = clickedPisteButton.parentNode.parentNode;
    var pistes = document.querySelectorAll(".piste");
    //Making every piste unfocused.
    for (i = 0; i < pistes.length; i++) {

        pistes[i].classList.remove("focused");

    }
    //Checking if the oldclickedPiste var. equals the clickedPiste.
    if (clickedPiste == oldclickedPiste){
        //If yes than it adds "focused".
        clickedPiste.classList.add("focused");

    }

    clickedPiste.classList.toggle("focused");
    //Checking if we clicked the same piste.
    if (clickedPiste.classList.contains("focused")){
        //If yes it saves the piste.
        oldclickedPiste = clickedPiste
    }
    else{
    //If no it sets the oldclickedPiste var. undifened
    oldclickedPiste = undefined;

    }
}
//It is a var from main.js
canAutoValidate = false;







function toggleAddPistePanel() {
    var addPistePanel = document.getElementById("add_piste_panel");

    addPistePanel.classList.toggle("hidden");
}

function coloredPisteCreateButton(x) {
    var selectedColor = x;

    var colorsPanel = document.getElementById("colored_color_select");
    var colors = colorsPanel.children;
    selectedColor.classList.add("selected");

}

var main_group = document.getElementsByClassName("main_group");
var colored_group = document.getElementsByClassName("colored_group");
var numbered_group = document.getElementsByClassName("numbered_group");



function mainPiste(){

for (let index = 0; index < main_group.length; index++) {
    main_group[index].classList.remove("hidden");

}

for (let index = 0; index < colored_group.length; index++) {
    colored_group[index].classList.add("hidden");

}
for (let index = 0; index < numbered_group.length; index++) {
    numbered_group[index].classList.add("hidden");

}


}

function coloredPiste() {

    for (let index = 0; index < main_group.length; index++) {
        main_group[index].classList.add("hidden");

    }

    for (let index = 0; index < colored_group.length; index++) {
        colored_group[index].classList.remove("hidden");

    }
    for (let index = 0; index < numbered_group.length; index++) {
        numbered_group[index].classList.add("hidden");

    }

}

function numberedPiste(){

    for (let index = 0; index < main_group.length; index++) {
        main_group[index].classList.add("hidden");

    }

    for (let index = 0; index < colored_group.length; index++) {
        colored_group[index].classList.add("hidden");

    }
    for (let index = 0; index < numbered_group.length; index++) {
        numbered_group[index].classList.remove("hidden");

    }

}
document.addEventListener("keyup", function(e){
    //Opens Add piste to Shift+A
    if(e.shiftKey && e.which == 65) {
        var orangeAddButton = document.querySelector(".stripe_button.orange")
        orangeAddButton.click()
    }
})
