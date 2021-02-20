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

var step1 = document.getElementById("step1")
var step2 = document.getElementById("step2")

//Form validation
var form = document.getElementById("content_wrapper");
var inputs = form.querySelectorAll(".form_wrapper input:not(input.disabled)");
var sendButton = document.querySelector(".send_panel .send_button");
var valid1 = false, valid2 = false;
sendButton.disabled = true;
function bookAppointmentsFormValidation(){
    for(i=0; i<inputs.length; i++){
        if(inputs[i].value == ""){
            //If it finds an empty input, then it disable the "Save" button.
            step2.classList.add("collapsed")
            valid1 = false;
            break;
        }
        else {
            //If everything has a value then it enable the "Save" Button. The user can save.
            step2.classList.remove("collapsed")
            valid1 = true;
        }
    }
    valid2 = true;
    if(valid1 && valid2){
        sendButton.disabled = false;
    }
    else{
        sendButton.disabled = true;
    }
}
form.addEventListener("input", bookAppointmentsFormValidation)