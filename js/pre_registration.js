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