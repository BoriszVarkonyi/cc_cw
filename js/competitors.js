var removeButton = document.querySelector(".stripe_button.red");
removeButton.classList.add("disabled")
removeButton.disabled = true;
//Event listener to class change
function removeButtonDisabler() {
    var selectedItem = document.querySelector("tbody .selected")
    if (selectedItem !== null) {
        removeButton.disabled = false;
        removeButton.classList.remove("disabled")
    }
    else {
        removeButton.disabled = true;
        removeButton.classList.add("disabled")
    }
}
//An event listener to class change
var wcRows = document.querySelectorAll("#page_content_panel_main tbody tr")
function callback(mutationsList, observer) {
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
            removeButtonDisabler();
        }
    })
}

const mutationObserver5 = new MutationObserver(callback)
for (i = 0; i < wcRows.length; i++) {
    mutationObserver5.observe(wcRows[i], { attributes: true })
}



var importCompetitorsPanel = document.getElementById("import_competitors_panel");

function toggleImportPanel() {
    importCompetitorsPanel.classList.toggle("hidden")
}

//Selects the competition that the technicians will be imported from
var importTechHiddenInput = document.getElementById("selected_comp_input")
var oldSelectedTechImport;
function selectForImport(x) {
    var importTechTablerows = document.querySelectorAll("#title_stripe tr")
    var clickedImportTechrow = x
    if (oldSelectedTechImport != clickedImportTechrow) {
        //removes selected class from every row
        for (i = 0; i < importTechTablerows.length; i++) {
            importTechTablerows[i].classList.remove("selected");
        }
        //Adds selected class
        clickedImportTechrow.classList.add("selected")
        //Saves the id into the hidden input
        importTechHiddenInput.value = clickedImportTechrow.id
        //Saves the clicked row
        oldSelectedTechImport = clickedImportTechrow;
    }
    else {
        //Adds selected class
        clickedImportTechrow.classList.remove("selected")
        //Saves the id into the hidden input
        importTechHiddenInput.value = ""
        //Saves the clicked row
        oldSelectedTechImport = undefined;
    }
}