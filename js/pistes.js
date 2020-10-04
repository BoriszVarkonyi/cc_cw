function togglePisteSettings(x) {
    var clickedPisteButton = x;
    var clickedPiste = clickedPisteButton.parentNode.parentNode;
    var pisteSettings = clickedPiste.lastElementChild;

    pisteSettings.classList.toggle("collapsed");
    clickedPiste.classList.toggle("focused");

    console.log(pisteSettings)


}

function coloredPisteCreateButton(x) {
    var selectedColor = x;

    var colorsPanel = document.getElementById("colored_color_select");
    var colors = colorsPanel.children;
    selectedColor.classList.add("selected");

}