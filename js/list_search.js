function searchButton(x) {
    var button = x;
    var search = button.previousElementSibling;
    search.classList.toggle("opened")
}

function serachInLists(x) {
    /*
    // Declare variables
    var input = x
    var filter = input.value.toUpperCase();
    console.log(input.parentNode.parentNode.parentNode)
    var ul = document.querySelector(".table_row_wrapper")
    console.log(ul)
    //var li = ul.getElementsByTagName('a');
    // Loop through all list items, and hide those who don't match the search query
    /*
    for (i = 0; i < li.length; i++) {
        a = li[i];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].classList.remove("hidden")
        } else {
            li[i].classList.add("hidden")
        }

    }
    */
}

function tempomaryNationSearch(x) {
    var searchFor = x.value.toUpperCase();
    var nat = document.querySelectorAll(".table_item:nth-of-type(2) > p");
    for (i = 0; i < nat.length; i++) {
        nat[i].parentNode.parentNode.style.display = "";
    }
    for (i = 0; i < nat.length; i++) {
        if (nat[i].innerHTML != searchFor) {
            nat[i].parentNode.parentNode.style.display = "none";
        }
    }

    // If the input is display all rows
    if (searchFor == "") {
        for (i = 0; i < nat.length; i++) {
            nat[i].parentNode.parentNode.style.display = "";
        }
    }

}

// Displays all row when click the X
function searchDelete() {
    var nat = document.querySelectorAll(".table_item:nth-of-type(2) > p");
    for (i = 0; i < nat.length; i++) {
        nat[i].parentNode.parentNode.style.display = "";
    }
}