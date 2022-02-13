//Removes all written in equipment value
function removeEquipmentValues() {

    for (let index = 0; index < 13; index++) {
        var removefrom = document.getElementById("input_" + index);
        removefrom.value = "";
    }
}

//Max input value 5. Else it makes it empty
var inputs = document.querySelectorAll("#page_content_panel_main input[type=number]")
inputs.forEach(item => {
    item.addEventListener("input", function () {
        inputValueLimiter(this, 5, 0)
    })
})

document.addEventListener("keyup", function (e) {
    //somethingisOpened is a var. from main.js
    //somethingIsFocused is a var. from main.js
    if (!somethingisOpened && !somethingIsFocused) {
        var saveInformationButton = document.getElementById("saveInformationBt")
        saveInformationButton.click()
    }
})