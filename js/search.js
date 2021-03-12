//Search engine
var selectedElementIndex = 0;
var liCounter;
function searchEngine(x) {
    // Declare variables
    var input = x
    var filter = input.value.toUpperCase();
    var ul = input.nextElementSibling.nextElementSibling;
    var li = ul.getElementsByTagName('a');
    if (li.length == 0) {
        li = ul.querySelectorAll("button");
    }
    ul.classList.remove("empty")
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].classList.remove("hidden")
        } else {
            li[i].classList.add("hidden")
        }

    }
    //empty class system
    var allDisplay = false;
    for (i = 0; i < li.length; i++) {
        if (!li[i].classList.contains("hidden")) {
            allDisplay = true
            break;
        }
    }
    if (!allDisplay) {
        ul.classList.add("empty")

    }
    //Search engine arrow system
    liCounter = 0;
    for (i = 0; i < li.length; i++) {
        if (!li[i].classList.contains("hidden")) {
            liCounter++
        }
    }
    //Makes it sure that the control system works only on visible elements
    var visibleLi = ul.querySelectorAll('a:not( .hidden)');
    for (i = 0; i < visibleLi.length; i++) {
        visibleLi[i].classList.remove("selected")
    }
    if (event.key != "ArrowUp" && event.key != "ArrowDown") {
        selectedElementIndex = 0;
    }
    if (visibleLi.length > 0) {
        visibleLi[selectedElementIndex].classList.add("selected")
    }
    //importOverlayClosed is a var. from importoverlay.js
    importOverlayClosed = true;
    input.onkeydown = (keyDownEvent) => {
        if (importOverlayClosed) {
            if (keyDownEvent.key == "ArrowUp") {
                if (selectedElementIndex == 0) {
                    selectedElementIndex++
                }
                selectedElementIndex--
                for (i = 0; i < visibleLi.length; i++) {
                    visibleLi[i].classList.remove("selected")
                }
                if (visibleLi.length > 0) {
                    visibleLi[selectedElementIndex].classList.add("selected")
                    visibleLi[selectedElementIndex].scrollIntoView()
                }
                keyDownEvent.preventDefault();
            }
            if (keyDownEvent.key == "ArrowDown") {
                if (selectedElementIndex == liCounter - 1) {
                    selectedElementIndex--
                }
                selectedElementIndex++
                for (i = 0; i < visibleLi.length; i++) {
                    visibleLi[i].classList.remove("selected")
                }
                if (visibleLi.length > 0) {
                    visibleLi[selectedElementIndex].classList.add("selected")
                    visibleLi[selectedElementIndex].scrollIntoView()
                }
                keyDownEvent.preventDefault();
            }
        }
    }

}
function resultChecker(x) {
    var input = x
    var ul = input.nextElementSibling.nextElementSibling;
    ul.classList.remove("error")
    ul.classList.remove("empty")
    var li = ul.getElementsByTagName('a');
    if (li.length == 0) {
        li = ul.querySelectorAll("button");
    }
    var field = document.getElementById("inputs");
    x.value = ""
    liCounter = 0;
    for (i = 0; i < li.length; i++) {
        liCounter++
        li[i].classList.remove("hidden");
    }
    if (li.length == 0) {
        ul.classList.add("empty")
    }
    else {
        for (i = 0; i < li.length; i++) {
            li[i].classList.remove("selected")
        }
        selectedElementIndex = 0;
        li[selectedElementIndex].classList.add("selected")
    }
}

//Clears the search 
var clearButton = document.querySelectorAll(".clear_search_button")
clearButton.forEach(item => {
    item.addEventListener("click", function (event) {
        var targetElement = event.target || event.srcElement;
        var searchBar = targetElement.parentNode.previousElementSibling
        searchBar.value = ""
    });
})

//Auto fills the searchresult
function autoFill(x) {
    var input = x.parentNode.previousElementSibling.previousElementSibling;
    input.value = x.innerHTML;
}


//Autofill the input with the dropdown value
function selectSystem(x) {
    var clickedOption = x
    var selectInput = x.parentNode.parentNode.firstElementChild.firstElementChild
    //Fill the input value
    selectInput.value = clickedOption.textContent
}

var searchBarClosed = true;
function isOpen(x) {
    var searchResult = x.nextElementSibling.nextElementSibling;
    searchResult.classList.add("opened")
    searchBarClosed = false;
}
function isClosed(x) {
    var searchResult = x.nextElementSibling.nextElementSibling;
    searchResult.classList.remove("opened")
    var removeElemClass = document.querySelectorAll(".search_results .selected")
    for(i=0; i<removeElemClass.length; i++){
        removeElemClass[i].classList.remove("selected")
    }
    searchBarClosed = true;
}
