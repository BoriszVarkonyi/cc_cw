var selectedInputIndex = 0;
var inputs = document.querySelectorAll("tbody input");

numberInputs.forEach(item => {
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
            selectedInputIndex = inputs.length-1;
            inputs[selectedInputIndex].focus();
            e.preventDefault();
        }
    }
    );
})