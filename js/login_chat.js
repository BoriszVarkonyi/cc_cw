var dropdownButton = document.getElementById("dropdown_button");
var dropdownInput = document.getElementById("competition");
var dropdownInputId = document.getElementById("competition_id");
var dropdownMenu = document.getElementById("dropdown_menu")

function dropDown() {
    dropdownButton.classList.toggle("focus");
    dropdownMenu.classList.toggle("focus");
}

function selectSystem(x) {
    var selectedItem = x;
    dropdownInput.value = selectedItem.innerText;
    dropdownInputId.value = selectedItem.id;
    dropDown();
}