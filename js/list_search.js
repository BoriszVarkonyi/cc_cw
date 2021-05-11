function searchButton(x) {
    var button = x;
    var search = button.previousElementSibling.previousElementSibling.previousElementSibling;
    if (search.classList.contains("opened")) {
        search.querySelector(".search").value = ""
        searchInLists();
    }
    search.classList.toggle("opened");
    button.classList.toggle("active");
}

function searchInLists() {
    var searches = document.querySelectorAll(".table_header .search")
    //Makes the search for every search input. Creates a filter effect
    for (j = 0; j < searches.length; j++) {
        var filter = searches[j].value.toUpperCase();
        if (j > 0) {
            var li = document.querySelectorAll('.table_row_wrapper .table_row:not( .hidden) > div:nth-of-type(' + (j + 1) + ')');
        }
        else {
            var li = document.querySelectorAll('.table_row_wrapper .table_row > div:nth-of-type(' + (j + 1) + ')');
        }
        //Loops throught the rows
        for (i = 0; i < li.length; i++) {
            a = li[i].querySelector("p");
            txtValue = a.textContent || a.innerText;
            //if the input is a radio button the search is stricter
            if (searches[j].parentNode.parentNode.classList.contains("option")) {
                if (txtValue.toUpperCase().indexOf(filter) > -1 && txtValue.toUpperCase().indexOf(filter) < 1) {
                    li[i].parentNode.classList.remove("hidden")
                } else {
                    li[i].parentNode.classList.add("hidden")
                }
            }
            else {
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].parentNode.classList.remove("hidden")
                } else {
                    li[i].parentNode.classList.add("hidden")
                }
            }
        }
    }
    //setas the row bg color
    var visibleRows = document.querySelectorAll(".table_row:not( .hidden)")
    for (i = 0; i < visibleRows.length; i++) {
        if (i % 2 == 0) {
            visibleRows[i].style.backgroundColor = "rgb(255, 255, 255)"
        }
        else {
            visibleRows[i].style.backgroundColor = "rgb(246, 246, 246)"
        }
    }
    //Removes elected class from all item
    var selectedElements = document.querySelectorAll(".selected")
    for (i = 0; i < selectedElements.length; i++) {
        selectedElements[i].classList.remove("selected")
    }
    //selectedElementIndexAr is a var from list.js
    selectedElementIndexAr = 0;
}

var radioButtons = document.querySelectorAll(".table_header .option_container input")
// Displays all row when click the X
function searchDelete(x) {
    if (x.previousElementSibling.value == undefined) {
        x.parentNode.previousElementSibling.firstElementChild.value = ""
        for (i = 0; i < radioButtons.length; i++) {
            radioButtons[i].checked = false;
        }
    }
    else {
        x.previousElementSibling.value = ""
    }
    searchInLists()
}

//Deals with the radio button search inputs
radioButtons.forEach(item => {
    item.addEventListener("input", function () {
        var searchInput = this.parentNode.previousElementSibling.firstElementChild
        searchInput.value = this.value;
        searchInLists();
    });
})

//Sort system
var defaultArray = [];
var defaultNameSequence = document.querySelectorAll(".table_row .table_item:first-of-type p")
for (i = 0; i < defaultNameSequence.length; i++) {
    defaultArray.push(defaultNameSequence[i].innerHTML)
}


var allButtons = document.querySelectorAll(".table_header_text > button:first-of-type");
var sortButtonCookie = cookieFinder("sortCookie", "")
for(i= 0; i<sortButtonCookie[1]; i++){
    sortButton(allButtons[sortButtonCookie[0]])
}

function sortButton(x) {
    //Gets the column index
    var columnIndex;
    for (i = 0; i < allButtons.length; i++) {
        if (allButtons[i] === x) {
            columnIndex = i

        }
        else {
            allButtons[i].querySelector("img").src = "../assets/icons/switch_full_black.svg"
        }
    }
    //Handles the modes
    var sortImg = x.querySelector("img")
    var imgSoure = sortImg.src.replace(sortImg.src.substring(0, sortImg.src.lastIndexOf("/")) + "/", "");
    switch (imgSoure) {
        case "switch_down_black.svg":
            // Current: A-Z Swtiches to: Z-A
            sortImg.src = "../assets/icons/switch_up_black.svg"
            rowSort(columnIndex + 1, "Z-A");
            document.cookie = "sortCookie=" + columnIndex + "2"
            break;
        case "switch_up_black.svg":
            // Current: Z-A Swtiches to: Default
            sortImg.src = "../assets/icons/switch_full_black.svg"
            rowSort(columnIndex + 1, "Default");
            document.cookie = "sortCookie=";
            break;
        default:
            // Current: Default Swtiches to: A-Z
            sortImg.src = "../assets/icons/switch_down_black.svg"
            rowSort(columnIndex + 1, "A-Z");
            document.cookie = "sortCookie=" + columnIndex + "1"
    }
}

function rowSort(index, mode) {
    //Makes an array from A-Z (whith strings)
    var sortByArray = [];
    var names = document.querySelectorAll(".table_row .table_item:nth-of-type(" + index + ") p")
    for (i = 0; i < names.length; i++) {
        sortByArray.push(names[i].innerHTML)
    }
    sortByArray.sort();
    var rows = document.querySelectorAll(".table_row")
    var rowNode = document.querySelector(".table_row_wrapper")
    switch (mode) {
        case "A-Z":
            for (i = rows.length - 1; i > 0; i--) {
                rowNode.insertBefore(rows[indexFinder(sortByArray[i], index, mode)], rowNode.firstElementChild)
                rows = document.querySelectorAll(".table_row")
            }
            break;
        case "Z-A":
            for (i = 0; i < rows.length; i++) {
                rowNode.insertBefore(rows[indexFinder(sortByArray[i], index, mode)], rowNode.firstElementChild)
                rows = document.querySelectorAll(".table_row")
            }
            break;
        default:
            for (i = rows.length - 1; i >= 0; i--) {
                rowNode.insertBefore(rows[indexFinder(defaultArray[i], 1, mode)], rowNode.firstElementChild)
                rows = document.querySelectorAll(".table_row")
            }
    }
}
//Gets the div index
function indexFinder(nameSearchFor, index, mode) {
    var rows = document.querySelectorAll(".table_row")
    for (j = 0; j < rows.length; j++) {
        var currentName = rows[j].querySelector(".table_item:nth-of-type(" + index + ") p")
        if (nameSearchFor === currentName.innerHTML) {
            switch (mode) {
                case "A-Z":
                    if (j < rows.length - 1 - i) {
                        continue;
                    }
                    else {
                        return j
                    }
                case "Z-A":
                    if (j < i) {
                        continue;
                    }
                    else {
                        return j
                    }
                default:
                    if (j < rows.length - 1 - i) {
                        continue;
                    }
                    else {
                        return j
                    }
            }
        }
    }
}
