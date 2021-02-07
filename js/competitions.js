
//Autofill the input with the dropdown value
function selectSystem(x) {
    var clickedOption = x
    var inputClass = x.parentNode.parentNode
    var dropDown = inputClass.firstElementChild.nextElementSibling
    var selectInput = x.parentNode.parentNode.firstElementChild
    //Fill the input value
    selectInput.value = clickedOption.textContent
    selectInput.nextElementSibling.value = clickedOption.innerHTML
    inputClass.classList.add("checked")
    //Closes automaticly the dropdown.
    dropDown.classList.add("closed")
}

function selectSystemWithSearch(x){
    var input = x;
    var filter = input.value.toUpperCase();
    var ul = input.nextElementSibling;
    var li = ul.querySelectorAll("button");
    ul.classList.remove("empty")
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        //The var. a checks the textcontent.
        a = li[i];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
    var allDisplay = false;
    for (i = 0; i < li.length; i++) {
        if(li[i].style.display === "") {
            allDisplay = true
            break;
        }
    }
    if(!allDisplay) {
        ul.classList.add("empty")

    }
}

