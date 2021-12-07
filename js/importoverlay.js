var removeButton = document.querySelector(".stripe_button.red");
removeButton.classList.add("disabled")
removeButton.disabled = true;
var selectedItem = document.querySelector("tbody .selected")
//Event listener to class change
function removeButtonDisabler() {
    selectedItem = document.querySelector("tbody .selected")
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

const mutationObserver3 = new MutationObserver(callback)
for (i = 0; i < wcRows.length; i++) {
    mutationObserver3.observe(wcRows[i], { attributes: true })
}

var importOverlayClosed = true;
var selectedElementIndexImport = 0;
//Arrow system
document.addEventListener("keyup", function (keyDownEvent) {
    if (!importOverlayClosed) {
        if (keyDownEvent.key == "ArrowUp") {
            var tableRows = document.querySelectorAll(".select_competition_wrapper .table_row")
            if (selectedElementIndexImport == 0) {
                selectedElementIndexImport++
            }
            selectedElementIndexImport--
            tableRows[selectedElementIndexImport + 1].classList.remove("selected")
            tableRows[selectedElementIndexImport + 1].blur()
            tableRows[selectedElementIndexImport].classList.add("selected")
            tableRows[selectedElementIndexImport].focus()
            keyDownEvent.preventDefault();
        }
        if (keyDownEvent.key == "ArrowDown") {
            //Cheks if theres a selected row.
            var hasSelected = false;
            var tableRows = document.querySelectorAll(".select_competition_wrapper .table_row")
            for (i = 0; i < tableRows.length; i++) {
                if (tableRows[i].classList.contains("selected")) {
                    hasSelected = true
                    break;
                }
            }
            if (hasSelected) {
                if (selectedElementIndexImport == tableRows.length - 1) {
                    selectedElementIndexImport--
                }
                selectedElementIndexImport++
                tableRows[selectedElementIndexImport - 1].classList.remove("selected")
                tableRows[selectedElementIndexImport - 1].blur()
                tableRows[selectedElementIndexImport].classList.add("selected")
                tableRows[selectedElementIndexImport].focus()
                keyDownEvent.preventDefault();
            }
            //If there is not a selected row than it selects the first row.
            else {
                tableRows[selectedElementIndexImport].classList.add("selected")
                tableRows[selectedElementIndexImport].focus()
            }
        }
    }
})