var sfw = document.getElementById("selected_fencers_wrapper");

var wrapper = document.getElementById("select_fencers_wrapper");

function selectFencer(x){

    var current = document.getElementById(x.id);

    var currentname = current.getElementsByTagName("div")[1].innerHTML;

    current.classList.add("hidden");

sfw.innerHTML += '<div><input type="number" name="" id="" class="hidden"><p>'+ currentname +'</p><button id="'+ x.id + '_b' +'" onclick="removeSelection(this)" type="button"><img src="../assets/icons/close-black-18dp.svg" alt=""></button></div>'

}

function removeSelection(x) {

var toremove = document.getElementById(x.id);

var toshow = document.getElementById();

toshow.classList.remove("hidden");

toremove.parentElement.remove();



}