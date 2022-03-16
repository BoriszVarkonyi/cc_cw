//Saves to Shift+S
document.addEventListener("keyup", function (e) {
    //somethingIsFocused is a var. from main.js
    if (!somethingIsFocused) {
        if (e.shiftKey && e.which == 83) {
            var orangeSaveButton = document.getElementById("saveFormulaBt")
            orangeSaveButton.click()
        }
    }
})

//Form option Buttons
var useOptionButton = document.getElementById("used");
var useOptions = document.querySelectorAll("#useOptionContainer input");
var dontUseOptionButton = document.getElementById("not_used");

var pointsInPools = document.getElementById("pIP");
pointsInPools.addEventListener("input", function () {
    inputValueLimiter(this, 5)
})

var pointsInTable = document.getElementById("pIT")
pointsInTable.addEventListener("input", function () {
    inputValueLimiter(this, 15)
})

var numOfQualifiersAfterPools = document.getElementById("nOQAP")
numOfQualifiersAfterPools.addEventListener("input", function () {
    inputValueLimiter(this, 1024)
})
