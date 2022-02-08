document.addEventListener("keyup", function (e) {
    //somethingisOpened is a var. from main.js
    //somethingIsFocused is a var. from main.js
    if (!somethingisOpened && !somethingIsFocused) {
        if (e.shiftKey && e.which == 80) {
            var printOverviewButton = document.getElementById("printOverviewBt")
            printOverviewButton.click();
        }
        if (e.shiftKey && e.which == 69) {
            var exportResultsButton = document.getElementById("exportResultsBt")
            exportResultsButton.click();
        }
    }
})