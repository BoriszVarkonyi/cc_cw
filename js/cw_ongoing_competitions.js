//Search engine
function cwSearchEngine(){
    var input = document.querySelector(".search");
    var filter = input.value.toUpperCase();
    var ul = document.querySelector(".table_row_wrapper");
    var li = ul.querySelectorAll(".table_row");
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        //The var. a checks the textcontent.
        a = li[i].firstElementChild;
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].classList.remove("hidden");
        } else {
            li[i].classList.add("hidden")
        }
    }
}