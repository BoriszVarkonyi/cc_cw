var languagesPanel = document.getElementById("change_language_panel");
var currentLang;

function toggleLanguagesPanel(x) {
    var languagesButton = x;
    languagesButton.classList.toggle("opened");
    languagesButton.innerHTML = "Select Language";
    languagesPanel.classList.toggle("opened")
}

var mobileNavigation = document.querySelector("nav#mobile");
function toggleMobileNavigation(x) {
    var mobileNavButton = x;
    mobileNavButton.classList.toggle("opened")
    mobileNavigation.classList.toggle("opened");
}

var compDropdown = document.getElementById("competitions_navigation");
function toggleCompetitionsPanel(x) {
    var competitionsNavButton = x;
    competitionsNavButton.classList.toggle("opened");
    compDropdown.classList.toggle("opened");
}
//NAVIGATION BUTTON
//selects the body
var body = document.querySelector("body");
//gets the classname of the body
var className = body.classList.value;
//selects all navigation buttons
var navigationButtons = document.querySelectorAll("nav#desktop > div");
var mobileNavihationButtons = document.querySelectorAll("nav#mobile > div  a");
//remove current class from every navigatiob button
for (i = 0; i < navigationButtons.length; i++) {
    navigationButtons[i].classList.remove("current")
}
//adds current class to the appropirate navigation button
switch (className) {
    case "home":
        mobileNavihationButtons[0].classList.add("current");
        navigationButtons[0].classList.add("current");
        break;
    case "competitions":
        navigationButtons[1].classList.add("current");
        break;
    case "upcoming_competitions":
        mobileNavihationButtons[1].classList.add("current");
        navigationButtons[1].classList.add("current");
        navigationButtons[1].querySelectorAll("a")[0].classList.add("current")
        break;
    case "ongoing_competitions":
        mobileNavihationButtons[2].classList.add("current");
        navigationButtons[1].classList.add("current");
        navigationButtons[1].querySelectorAll("a")[1].classList.add("current")
        break;
    case "finished_competitions":
        mobileNavihationButtons[3].classList.add("current");
        navigationButtons[1].classList.add("current");
        navigationButtons[1].querySelectorAll("a")[2].classList.add("current")
        break;
    case "blog":
        mobileNavihationButtons[4].classList.add("current");
        navigationButtons[2].classList.add("current");
        break;
    case "videos":
        mobileNavihationButtons[5].classList.add("current");
        navigationButtons[3].classList.add("current");
        break;
    case "rankings":
        mobileNavihationButtons[6].classList.add("current");
        navigationButtons[4].classList.add("current");
        break;
    case "saved_competitions":
        mobileNavihationButtons[7].classList.add("current");
        navigationButtons[5].classList.add("current");
        break;
}

//Prevents typing invalid chars. to the number input
var invalidChars = ["-", "+", "e", "E"];
var numberInputs = document.querySelectorAll("input[type='number']")
numberInputs.forEach(item => {
    item.addEventListener("keydown", function (e) {
        if (invalidChars.includes(e.key)) {
            e.preventDefault();
        }
    }
    );
})

//Search engine
var selectedElementIndex = 0;
var liCounter;
function searchEngine(x) {
    // Declare variables
    var input = x
    var filter = input.value.toUpperCase();
    var ul = input.nextElementSibling;
    var li = ul.getElementsByTagName('a');
    ul.classList.remove("empty")
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
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
        if (li[i].style.display === "") {
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
        if (li[i].style.display === "") {
            liCounter++
        }
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
                li[selectedElementIndex + 1].classList.remove("selected")
                li[selectedElementIndex].classList.add("selected")
            }
            if (keyDownEvent.key == "ArrowDown") {
                if (selectedElementIndex == liCounter - 1) {
                    selectedElementIndex--
                }
                selectedElementIndex++
                li[selectedElementIndex - 1].classList.remove("selected")
                li[selectedElementIndex].classList.add("selected")
            }
        }
    }

}
function resultChecker(x) {
    var input = x
    var ul = input.nextElementSibling;
    var li = ul.getElementsByTagName('a');
    var field = document.getElementById("inputs");
    x.value = ""
    liCounter = 0;
    for (i = 0; i < li.length; i++) {
        liCounter++
        li[i].style.display = "";
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
        var searchBar = targetElement.parentNode.nextElementSibling;
        searchBar.value = ""
    });
})

//Toggles the selection on clicked searchresult
function selectSearch(x) {
    //Makes the id
    var selectedElementId = x.id.slice(0, -1);
    var selectedElements = document.querySelectorAll(".page_content_flex .selected")
    //Removes selected class from all selected element
    for (i = 0; i < selectedElements.length; i++) {
        selectedElements[i].classList.remove("selected")
    }
    //Gets the tablerow by id
    var selectedTableElement = document.getElementById(selectedElementId)
    //Adds selected class
    selectedTableElement.classList.add("selected")
    //Counts the selected table row index
    var rows = document.querySelectorAll(".table .table_row");
    for (i = 0; i < rows.length; i++) {
        if (rows[i].classList.contains("selected")) {
            //It is a var. from control.js
            selectedElementIndexAr = i;
            break;
        }
    }
}

function printPage() {
    window.print();
}

