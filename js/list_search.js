function searchButton(x) {
    var button = x;
    var search = button.previousElementSibling;
    search.classList.toggle("opened")
}

function serachInLists() {
    var searches = document.querySelectorAll(".table_header .search")
    for (j = 0; j < searches.length; j++) {
        var filter = searches[j].value.toUpperCase();
        if(j > 0){
            var li = document.querySelectorAll('.table_row_wrapper .table_row:not( .hidden) > div:nth-of-type(' + (j + 1) + ')');
        }
        else{
            var li = document.querySelectorAll('.table_row_wrapper .table_row > div:nth-of-type(' + (j + 1) + ')');
        }
        for (i = 0; i < li.length; i++) {
            a = li[i].querySelector("p");
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].parentNode.classList.remove("hidden")
            } else {
                li[i].parentNode.classList.add("hidden")
            }

        }
    }
}

// Displays all row when click the X
function searchDelete(x) {
    x.previousElementSibling.value = ""
    serachInLists()
}