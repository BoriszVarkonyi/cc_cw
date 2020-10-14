function togglePisteSettings(x) {
    var clickedPisteButton = x;
    var clickedPiste = clickedPisteButton.parentNode.parentNode;
    var pistes = document.querySelectorAll(".piste");
    var oldClickedPiste;

    for (i = 0; i < pistes.length; i++) {

        pistes[i].classList.remove("focused");

        
    }

    var found = pistes.indexOf('clickedPiste');



    console.log(found)

    if (oldClickedPiste == clickedPiste) {
        clickedPiste.classList.toggle("focused");
    }

    oldClickedPiste = clickedPiste;

    clickedPiste.classList.toggle("focused");

    console.log(clickedPiste);
    console.log(oldClickedPiste);

    //clickedPiste.classList.toggle("focused");

    //console.log(pistes[clickedPisteButton])
}








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

console.log("lefutottam");

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