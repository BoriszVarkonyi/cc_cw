var removeButton = document.querySelector(".stripe_button.red");
removeButton.classList.add("disabled")
removeButton.disabled = true;
//Event listener to class change
function removeButtonDisabler(){
    var selectedItem = document.querySelector(".table_row_wrapper .selected")
    if(selectedItem !== null){
        removeButton.disabled = false;
        removeButton.classList.remove("disabled")
    }
    else{
        removeButton.disabled = true;
        removeButton.classList.add("disabled")
    }
}
//An event listener to class change
var wcRows = document.querySelectorAll(".table_row_wrapper .table_row")
function callback(mutationsList, observer) {
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
            removeButtonDisabler();
        }
    })
}
    
const mutationObserver3 = new MutationObserver(callback)
for(i=0; i<wcRows.length; i++){
mutationObserver3.observe(wcRows[i], { attributes: true })
}

var importOverlayClosed = true;
var selectedElementIndexImport = 0;
document.addEventListener("keyup", function(keyDownEvent){
    if(!importOverlayClosed){
        if(keyDownEvent.key == "ArrowUp"){
            var tableRows = document.querySelectorAll(".select_competition_wrapper .table_row")
            if(selectedElementIndexImport == 0) {
                selectedElementIndexImport++
            }
            selectedElementIndexImport--
            tableRows[selectedElementIndexImport + 1].classList.remove("selected")
            tableRows[selectedElementIndexImport + 1].blur()
            tableRows[selectedElementIndexImport].classList.add("selected")
            tableRows[selectedElementIndexImport].focus()
            keyDownEvent.preventDefault();
        }
        if(keyDownEvent.key == "ArrowDown"){
            //Cheks if theres a selected row.
            var hasSelected = false;
            var tableRows = document.querySelectorAll(".select_competition_wrapper .table_row")
            for(i=0; i<tableRows.length; i++) {
                if(tableRows[i].classList.contains("selected")){
                    hasSelected = true
                    break;
                }
            }
            if(hasSelected){
                if(selectedElementIndexImport == tableRows.length -1) {
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
            else{
                tableRows[selectedElementIndexImport].classList.add("selected")
                tableRows[selectedElementIndexImport].focus()
            }
        }
    }
    //searchBarClosed is a var. from control.js
    //somethingisOpened is a var. from main.js
    if(searchBarClosed && !somethingisOpened){
        if(keyDownEvent.shiftKey && keyDownEvent.which == 65) {
            var orangeAddButton = document.querySelector(".stripe_button.orange")
            orangeAddButton.click()
        }
        if(keyDownEvent.shiftKey && keyDownEvent.which == 73) {
            var stripeButton = document.querySelector(".stripe_button")
            stripeButton.click()
        }
        if(keyDownEvent.shiftKey && keyDownEvent.which == 82){
            removeButton.click()
        }
    }     
})