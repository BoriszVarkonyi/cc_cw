var fencerQuantity = document.getElementById("fencer_quantity").value;

for (let index = 7; index > 3; index--) {

    var strive = index;
    var radioLabelText = document.getElementById("p_" + strive);
    var fullPool = fencerQuantity / strive;

    radioInput = document.getElementById(index);

    if (fencerQuantity % strive == 0) {
        radioLabelText.innerHTML = "(" + fullPool + " pool of " + strive + ")";
        radioInput.value = radioInput.id + ";" + fullPool;
    }
    else {
        var fullPool = Math.floor(fencerQuantity / strive);
        var leftOver = fencerQuantity % strive;
        var needed = (strive - 1) - leftOver;
        var bigger = fullPool - needed;
        var smaller = 1 + needed;
        var belowStrive = strive - 1;

        if (bigger <= 0) {
            radioInput.disabled = "true";
            radioLabelText.innerHTML = "(Not possible)";
        }
        else {
            radioLabelText.innerHTML = "(" + bigger + " pool of " + strive + " and " + smaller + " pool of " + belowStrive + ")";
            radioInput.value = radioInput.id + ";" + (bigger + smaller);
        }
    }
}

document.addEventListener("keyup", function (e) {
    //somethingisOpened is a var. from main.js
    //somethingIsFocused is a var. from main.js
    if (!somethingIsFocused) {
        if (e.shiftKey && e.which == 71) {
            var generatePoolButton = document.querySelector(".stripe_button.primary")
            generatePoolButton.click();
        }
    }
})
