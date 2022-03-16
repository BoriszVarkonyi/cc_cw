var selectedInputIndex = 0;
var inputs = document.querySelectorAll("tbody input");

inputs.forEach(item => {
    item.addEventListener("keydown", function (e) {
        if (e.key == "ArrowUp" && inputs.length > 0) {
            if (selectedInputIndex == 0) {
                selectedInputIndex++
            }
            selectedInputIndex--
            inputs[selectedInputIndex].focus();
            e.preventDefault();
        }

        if (e.key == "ArrowDown" && inputs.length > 0) {
            if (selectedInputIndex == inputs.length - 1) {
                selectedInputIndex--
            }
            selectedInputIndex++
            inputs[selectedInputIndex].focus();
            e.preventDefault();
        }
        if (e.key == "Home" && inputs.length > 0) {
            selectedInputIndex = 0;
            inputs[selectedInputIndex].focus();
            e.preventDefault();
        }
        if (e.key == "End" && inputs.length > 0) {
            selectedInputIndex = inputs.length - 1;
            inputs[selectedInputIndex].focus();
            e.preventDefault();
        }
    }
    );
})
inputs.forEach(item => {
    item.addEventListener("input", function (e) {
        inputValueLimiter(this, 20)
    })

})

function addNumber(x, numberToAdd) {
    var input = x.parentNode.parentNode.querySelector("input")
    if (input.value == "") {
        input.value = 0;
    }
    if (numberToAdd == -1) {
        if (input.value > 0) {
            input.value = parseInt(input.value) + numberToAdd
        }
    }
    else {
        if (input.value < 20) {
            input.value = parseInt(input.value) + numberToAdd
        }
    }

}

function resetNumber(x) {
    x.parentNode.parentNode.querySelector("input").value = "";
}
