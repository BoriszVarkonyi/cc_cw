var sfw = document.getElementById("selected_fencers_wrapper");

var wrapper = document.getElementById("select_fencers_wrapper");

function selectFencer(x){

    var current = document.getElementById(x.id);

    var currentname = current.getElementsByTagName("div")[1].innerHTML;

    current.classList.add("hidden");

sfw.innerHTML += '<div><input type="number" name="" id="" class="hidden"><p>'+ currentname +'</p><button id="'+ x.id +'" onclick="removeSelection(this)" type="button"><img src="../assets/icons/close-black-18dp.svg" alt=""></button></div>'

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
var panel = document.getElementById("cw_confirmation");
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