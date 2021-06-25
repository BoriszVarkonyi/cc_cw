var removeButton = document.querySelector(".stripe_button.red");
removeButton.classList.add("disabled")
removeButton.disabled = true;
//Event listener to class change
function removeButtonDisabler(){
    var selectedItem = document.querySelector("tbody .selected")
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
var wcRows = document.querySelectorAll("#page_content_panel_main tbody tr")
function callback(mutationsList, observer) {
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
            removeButtonDisabler();
        }
    })
}

const mutationObserver5 = new MutationObserver(callback)
for(i=0; i<wcRows.length; i++){
mutationObserver5.observe(wcRows[i], { attributes: true })
}