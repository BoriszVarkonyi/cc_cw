function toggleDropdown(x) {
    var input = x.parentNode
    var dropDown = x.nextElementSibling
    var inputText = x.firstElementChild
    var basicinputText = inputText.innerHTML
    dropDown.classList.toggle("closed")
    if(dropDown.id == "year_select_dropdown"){
        inputText.innerHTML = "-Year-"
    }
    if(dropDown.id == "sex_select_dropdown"){
        inputText.innerHTML = "-Sex-"
    }
    if(dropDown.id == "wt_select_dropdown"){
        inputText.innerHTML = "-Weapon Type-"
    }
    input.classList.remove("checked")
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

