//Toggles the dropdown (always removes the value)
function toggleDropdown(x) {
    var input = x.parentNode
    var dropDown = x.nextElementSibling
    var inputText = x.firstElementChild
    var basicinputText = inputText.innerHTML
    dropDown.classList.toggle("closed")
    //setting the simple text by dropdown type
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
//Autofill the input with the dropdown value
function selectSystem(x) {
    var clickedOption = x
    var inputClass = x.parentNode.parentNode
    var dropDown = inputClass.firstElementChild.nextElementSibling
    var selectInput = x.parentNode.previousElementSibling.firstElementChild
    selectInput.innerHTML = clickedOption.innerHTML
    selectInput.nextElementSibling.value = clickedOption.innerHTML
    inputClass.classList.add("checked")
    //Closes automaticly the dropdown.
    dropDown.classList.add("closed")
    console.log(selectInput.nextElementSibling.value)
}

