function searchButton(x) {
    var button = x;
    var search = button.previousElementSibling.previousElementSibling.previousElementSibling;
    if (search.classList.contains("opened")) {
        search.querySelector(".search").value = ""
        serachInLists();
    }
    search.classList.toggle("opened")
}

function serachInLists() {
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
    serachInLists()
}

//Deals with the radio button search inputs
radioButtons.forEach(item => {
    item.addEventListener("input", function () {
        var searchInput = this.parentNode.previousElementSibling.firstElementChild
        searchInput.value = this.value;
        serachInLists();
    });
})

function sortButton(x, mode) {
    //Gets the column index
    var columnIndex
    var allButtons = document.querySelectorAll(".table_header_text > button:first-of-type")
    for (i = 0; i < allButtons.length; i++) {
        if (allButtons[i] === x) {
            columnIndex = i
        }
    }
    rowSort(columnIndex + 1);
}

function rowSort(index, mode) {
    //Makes an array from A-Z (whith strings)
    var sortByArray = [];
    var names = document.querySelectorAll(".table_row .table_item:nth-of-type(" + index + ") p")
    for (i = 0; i < names.length; i++) {
        sortByArray.push(names[i].innerHTML)
    }
    sortByArray.sort();
    console.log(sortByArray)
    var rows = document.querySelectorAll(".table_row")
    var rowNode = document.querySelector(".table_row_wrapper")
    for (i= rows.length -1; i>=0; i--) {
        rowNode.insertBefore(rows[indexFinder(sortByArray[i])], rowNode.firstElementChild)
        rows = document.querySelectorAll(".table_row")
    }

}
//Gets the div index
function indexFinder(nameSearchFor) {
    console.log(i)
    //console.log(nameSearchFor)
    var rows = document.querySelectorAll(".table_row")
    for (j = 0; j < rows.length; j++) {
        var currentName = rows[j].querySelector(".table_item:first-of-type p")
        if (nameSearchFor === currentName.innerHTML && j > i) {
            return j
        }
    }
}
