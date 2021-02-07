var sfw = document.getElementById("selected_fencers_wrapper");
var wrapper = document.getElementById("select_fencers_wrapper");

function selectFencer(x){
    var current = document.getElementById(x.id);
    var currentname = current.getElementsByTagName("div")[1].innerHTML;
    current.classList.add("hidden");
    sfw.innerHTML += '<div><input type="number" name=""  class="hidden"><p>'+ currentname +'</p><button id="'+ x.id +'" onclick="removeSelection(this)" type="button"><img src="../assets/icons/close-black-18dp.svg" ></button></div>'
}

function removeSelection(x) {
    var toremove = document.getElementById(x.id);
    var toshow = document.getElementsByClassName("hidden");
    console.log(toshow);
    for (let index = 0; index < toshow.length; index++) {
        var element = toshow[index];

        if(element.id == x.id){
            element.classList.remove("hidden")
        }
    }
    toremove.parentElement.remove();
}

var panel = document.getElementById("confirmation");
var fenceridto = document.getElementById("fencer_ids");
var finalids = [];

function openConf() {
    panel.classList.remove("disabled");
    var gethidden = document.getElementsByClassName("hidden");
    for (let index = 0 + gethidden.length / 2; index < gethidden.length; index++) {
        finalids.push(gethidden[index].id);
    }
    var tosave = finalids.join(",");
    fenceridto.value = tosave;
    console.log(fenceridto);
}

function closeConf() {
    panel.classList.add("disabled");
    finalids = [];
}

//Search engine
function cwSearchEngine(x){
    var input = x
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