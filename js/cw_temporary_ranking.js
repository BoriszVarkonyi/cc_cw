//Search engine
function cwSearchEngine(){
    var input = document.querySelector(".search");
    var filter = input.value.toUpperCase();
    var ul = document.querySelector(".table_row_wrapper");
    var li = ul.querySelectorAll(".table_row")
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        //The var. a checks the textcontent.
        a = li[i].firstElementChild.nextElementSibling;
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].classList.remove("hidden");
        } else {
            li[i].classList.add("hidden");
        }
    }
    if(input.value != ""){
        var showedRows = document.querySelectorAll(".table_row:not(.hidden)")
        for(i=0; i<showedRows.length; i++){
            if(i%2 ==0){
                showedRows[i].style.backgroundColor = "rgb(246, 246, 246)"
            }
            else{
                showedRows[i].style.backgroundColor = "rgb(236, 236, 236)"
            }
        }
    }
    else{
        for(i=0; i<li.length; i++){
            if(i%2 ==0){
                li[i].style.backgroundColor = "rgb(246, 246, 246)"
            }
            else{
                li[i].style.backgroundColor = "rgb(236, 236, 236)"
            }
        }
    }
}