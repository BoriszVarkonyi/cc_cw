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

function sortButton(x) {

    sortttt(2);
}

function sortttt(index) {
    var sortByArray = [];
    var names = document.querySelectorAll(".table_row .table_item:nth-of-type(" + index + ") p")
    for (i = 0; i < names.length; i++) {
        sortByArray.push(names[i].innerHTML)
    }
}