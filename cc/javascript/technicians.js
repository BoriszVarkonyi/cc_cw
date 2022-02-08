function toggleImportPanel() {
    var element = document.getElementById("import_technician_panel");
    element.classList.toggle("hidden");
    //importOverlayClosed is a var. from importoverlay.js
    if (element.classList.contains("hidden")) {
        importOverlayClosed = true;
    }
    else {
        importOverlayClosed = false;
    }
}

document.addEventListener("keyup", function (e) {
    //somethingisOpened is a var. from main.js
    //somethingIsFocused is a var. from main.js
    if (!somethingisOpened && !somethingIsFocused) {
        if (e.shiftKey && e.which == 65) {
            var addTechButton = document.getElementById("addTechBt")
            addTechButton.click();
        }
        if (e.shiftKey && e.which == 80) {
            var printTechButton = document.getElementById("printTechBt")
            printTechButton.click();
        }
        if (e.shiftKey && e.which == 73) {
            var importTechButton = document.getElementById("importTechBt")
            importTechButton.click();
        }
        if(selectedItem !== null){
            if (e.shiftKey && e.which == 82) {
                var removeTechButton = document.getElementById("remove_technician_button")
                removeTechButton.click();
            }
        }
    }
})


