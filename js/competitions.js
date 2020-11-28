const yearSelectDropdown = document.getElementById("year_select_dropdown");
const sexSelectDropdown = document.getElementById("sex_select_dropdown");
const wtSelectDropdown = document.getElementById("wt_select_dropdown");


function toggleYearSelect() {
    yearSelectDropdown.classList.toggle("closed")
}

function toggleSexSelect() {
    sexSelectDropdown.classList.toggle("closed")
}

function toggleWTSelect() {
    wtSelectDropdown.classList.toggle("closed")
}
function selectSystem(x) {
    var clickedOption = x
    var inputClass = x.parentNode.parentNode
    var dropDown = inputClass.firstElementChild.nextElementSibling
    var selectInput = x.parentNode.previousElementSibling.firstElementChild
    selectInput.innerHTML = clickedOption.innerHTML
    inputClass.classList.add("checked")
    dropDown.classList.add("closed")
}

