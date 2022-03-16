function searchButton(x) {
    var button = x;
    var search = button.parentNode.previousElementSibling;
    if (search.querySelector("input").type == "text") {
        search.querySelector("input").focus()
    }
    if (search.classList.contains("opened")) {
        search.querySelector(".search").value = ""
        searchInLists();
    }
    search.classList.toggle("opened");
    button.classList.toggle("active");
}


var previousSearches = [];
var searches = document.querySelectorAll("th .search")
for (j = 0; j < searches.length; j++) {
    previousSearches.push(searches[j].value)
}

//Makes database
var database = []
var tempArray = []

var test = document.querySelectorAll('tbody tr > td:not(td.square):not(td.small)');
var tr = document.querySelectorAll('tbody tr')
var th = document.querySelectorAll("thead tr > th:not(th.square)")

for (i = 0; i < searches.length; i++) {
    tempArray = []
    for (j = i; j < test.length; j += th.length) {
        tempArray.push(test[j].querySelector("p"))
    }
    database.push(tempArray)
}

tempArray = []
for (i = 0; i < tr.length; i++) {
    tempArray.push(tr[i].id)

}
database.push(tempArray)
tempArray = []
for (i = 0; i < tr.length; i++) {
    tempArray.push(true)

}
database.push(tempArray)
console.log(database)



var hasAdded = false;
let timer;              // Timer identifier
const waitTime = 500;   // Wait time in milliseconds 
function searchInLists() {
    //Makes the search for every search input. Creates a filter effect
    for (j = 0; j < searches.length; j++) {
        if (previousSearches[j] != searches[j].value || j == 0 || searches[j].value != "") {
            previousSearches[j] = searches[j].value
            var filter = searches[j].value.toUpperCase();
            //Loops throught the rows
            for (i = 0; i < database[j].length; i++) {
                if (database[database.length - 1][i] || j == 0) {
                    //a = li[i].querySelector("p");
                    console.log(database[j][i])
                    txtValue = database[j][i].textContent || database[j][i].innerText;
                    //if the input is a radio button the search is stricter
                    if (searches[j].parentNode.parentNode.classList.contains("option")) {
                        if (txtValue.toUpperCase().indexOf(filter) > -1 && txtValue.toUpperCase().indexOf(filter) < 1) {
                            database[database.length - 1][i] = true
                        } else {
                            database[database.length - 1][i] = false
                        }
                    }
                    else {
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            database[database.length - 1][i] = true
                        } else {
                            database[database.length - 1][i] = false
                        }
                    }
                }
            }
        }
    }
    clearTimeout(timer);
    timer = setTimeout(() => {
        for (i = 0; i < database[0].length; i++) {
            if (database[database.length - 1][i]) {
                document.getElementById(database[database.length - 2][i]).classList.remove("hidden")
            }
            else {
                document.getElementById(database[database.length - 2][i]).classList.add("hidden")
            }
        }

        //If there is the no search found row it removes the hidden class
        var emptyRow = document.getElementById("emptyRow")
        if (emptyRow != null) {
            emptyRow.classList.remove("hidden")
        }
        reGenerateRowCloring();
        //Removes selected class from all item
        var selectedElements = document.querySelectorAll(".selected")
        for (i = 0; i < selectedElements.length; i++) {
            selectedElements[i].classList.remove("selected")
        }
        //selectedElementIndexAr is a var from list.js
        selectedElementIndexAr = 0;
        //Handles the no search found row
        var rowLenght = document.querySelectorAll('table tbody tr:not( .hidden)').length
        if (rowLenght === 0 && !hasAdded) {
            var tableRowWrapper = document.querySelector("table tbody")
            tableRowWrapper.innerHTML += '<tr id="emptyRow"><td colspan="4"><p>No result</p></td></tr>'
            hasAdded = true;
        }
        else if (rowLenght > 1 && hasAdded) {
            if (emptyRow != null) {
                var table = document.querySelector("#page_content_panel_main tbody")
                table.removeChild(table.lastElementChild)
            }
            hasAdded = false;
        }
    }, waitTime);
}

var radioButtons = document.querySelectorAll("thead .option_container input")
// Displays all row when click the X
function closeSearch(x) {
    if (x.previousElementSibling == undefined) {
        x.parentNode.nextElementSibling.firstElementChild.value = ""
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

function reGenerateRowCloring() {
    //setas the row bg color
    var visibleRows = document.querySelectorAll("tr:not( .hidden)")
    for (i = 0; i < visibleRows.length; i++) {
        if (i % 2 != 0) {
            visibleRows[i].style.backgroundColor = "rgb(255, 255, 255)"
        }
        else {
            visibleRows[i].style.backgroundColor = "rgb(246, 246, 246)"
        }
    }
}

//abchusort
Array.prototype.sortAbcHu = function () {
    this.compareWordAbcHu = function (w1, w2) {
        var SORT_ORDER = "0123456789aábcdeéfghiíjklmnoóöőpqrstuúüűvwxyz";
        var l1 = w1.length;
        var l2 = w2.length;
        var lm = l1 <= l2 ? l1 : l2;
        for (var i = 0; i < lm; ++i) {
            var c1 = w1.charAt(i).toLowerCase();
            var c2 = w2.charAt(i).toLowerCase();
            if (c1 != c2) {
                var n1 = SORT_ORDER.indexOf(c1);
                var n2 = SORT_ORDER.indexOf(c2);
                if (n1 == -1) {
                    if (n2 == -1) {
                        return c1 < c2 ? -1 : 1;
                    } else {
                        return c1 < 'A' ? -1 : 1;
                    }
                } else if (n2 == -1) {
                    return c2 < 'A' ? 1 : -1;
                } else {
                    return n1 < n2 ? -1 : 1;
                }
            }
        }
        return l1 == l2 ? 0 : (l1 < l2 ? -1 : 1);
    };
    this.sort(this.compareWordAbcHu);
}

//Sort system
var defaultArray = [];
var defaultArrayIndex;
var columns = document = document.querySelectorAll("#page_content_panel_main tr:first-of-type td")
outterLoop:
for (i = 0; i < columns.length; i++) {
    var defaultNameSequence = document.querySelectorAll("#page_content_panel_main tr td:nth-of-type(" + (i + 1) + ") p")
    for (j = 0; j < defaultNameSequence.length; j++) {
        if (defaultNameSequence[j].innerHTML == "") {
            defaultArray = [];
            continue outterLoop
        }
        else {
            defaultArray.push(defaultNameSequence[j].innerHTML.toLowerCase())
        }
    }
    defaultArrayIndex = i + 1;
    break;
}

var allButtons = document.querySelectorAll("#page_content_panel_main th > .table_buttons_wrapper button:first-of-type");

var sortButtonCookie = cookieFinder("sortCookie", "")
for (i = 0; i < sortButtonCookie[1]; i++) {
    console.log("bfwqjfb")
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
            allButtons[i].classList.remove("active")
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
            x.classList.add("active")
            document.cookie = "sortCookie=" + columnIndex + "2"
            reGenerateRowCloring();
            break;
        case "switch_up_black.svg":
            // Current: Z-A Swtiches to: Default
            sortImg.src = "../assets/icons/switch_full_black.svg"
            rowSort(columnIndex + 1, "Default");
            document.cookie = "sortCookie=";
            x.classList.remove("active")
            reGenerateRowCloring();
            break;
        default:
            // Current: Default Swtiches to: A-Z
            sortImg.src = "../assets/icons/switch_down_black.svg"
            rowSort(columnIndex + 1, "A-Z");
            x.classList.add("active")
            document.cookie = "sortCookie=" + columnIndex + "1"
            reGenerateRowCloring();
    }
}

function rowSort(index, mode) {
    //Makes an array from A-Z (whith strings)
    var sortByArray = [];
    var names = document.querySelectorAll("#page_content_panel_main tr td:nth-of-type(" + index + ") p")
    var isNumberArray = true;
    for (i = 0; i < names.length; i++) {
        if (isNaN(names[i].innerHTML)) {
            sortByArray.push(names[i].innerHTML.toLowerCase())
            isNumberArray = false;
        }
        else {
            if (!isNaN(parseInt(names[i].innerHTML))) {
                sortByArray.push(parseInt(names[i].innerHTML))
            }
        }
    }
    if (isNumberArray) {
        sortByArray.sort(function (a, b) {
            return a - b;
        });
        for (i = 0; i < sortByArray.length; i++) {
            sortByArray[i] = sortByArray[i].toString();
        }
    }
    else {
        sortByArray.sortAbcHu();
    }
    if (sortByArray.length > 1) {
        var rows = document.querySelectorAll("#page_content_panel_main tbody tr")
        var rowNode = document.querySelector("#page_content_panel_main tbody")
        switch (mode) {
            case "A-Z":
                for (i = rows.length - 1; i >= 0; i--) {
                    rowNode.insertBefore(rows[indexFinder(sortByArray[i], index, mode)], rowNode.firstElementChild)
                    rows = document.querySelectorAll("#page_content_panel_main tbody tr")
                }

                break;
            case "Z-A":
                for (i = 0; i < rows.length; i++) {
                    rowNode.insertBefore(rows[indexFinder(sortByArray[i], index, mode)], rowNode.firstElementChild)
                    rows = document.querySelectorAll("#page_content_panel_main tbody tr")
                }
                break;
            default:
                for (i = rows.length - 1; i >= 0; i--) {
                    rowNode.insertBefore(rows[indexFinder(defaultArray[i], defaultArrayIndex, mode)], rowNode.firstElementChild)
                    rows = document.querySelectorAll("#page_content_panel_main tbody tr")
                }
        }
    }
}
//Gets the div index
function indexFinder(nameSearchFor, index, mode) {
    var rows = document.querySelectorAll("#page_content_panel_main tbody tr")
    for (j = 0; j < rows.length; j++) {
        var currentName = rows[j].querySelector("#page_content_panel_main td:nth-of-type(" + index + ") p")
        if (nameSearchFor === currentName.innerHTML.toLowerCase()) {
            switch (mode) {
                case "A-Z":
                    if (j < rows.length - 2 - i) {
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
                    if (j < rows.length - 2 - i) {
                        continue;
                    }
                    else {
                        return j
                    }
            }
        }
    }
}

document.addEventListener("keyup", function (e) {
    //somethingisOpened is a var. from main.js
    //somethingIsFocused is a var. from main.js
    if (!somethingisOpened && !somethingIsFocused) {
        if (e.shiftKey && e.which == 70) {
            var nameSearch = document.querySelector(".table_buttons_wrapper button:nth-of-type(2)")
            nameSearch.click()
        }
    }
})
