function togglePisteSettings(x) {
    var clickedPisteButton = x;
    var clickedPiste = clickedPisteButton.parentNode.parentNode;
    var pisteSettings = clickedPiste.lastElementChild;

    pisteSettings.classList.toggle("collapsed");
    clickedPiste.classList.toggle("focused");

    console.log(pisteSettings)
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

var mainpiste_num_label = document.getElementById("mainpiste_num_label");


function mainPiste(){



}

function coloredPiste() {


}

function numberedPiste(){



}