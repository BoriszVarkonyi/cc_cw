var conf = document.getElementById("confirmation");
var infoPanel = document.getElementById("ranking_info_panel");
var addFencerPanel = document.getElementById("add_fencer_panel");

function closeConf() {

    conf.classList.add("hidden");

}

function toggleRankingInfo() {

    infoPanel.classList.toggle("hidden");

}

function toggleAddFencer() {

    addFencerPanel.classList.toggle("hidden");

}

//igen ez egy változtatás

function toDelete(x){

var input = document.getElementById("id_to_delete");
var button = document.getElementById("delete_fencer_button");

id = x.id;
var toselect = document.getElementsByClassName("selected");


if(toselect.length > 0){

    for (let index = 0; index < toselect.length; index++) {
        toselect[index].classList.remove("selected")
        
    }


input.value = "";
console.log(input.value);

button.classList.add("disabled");

}
else{

x.classList.add("selected");

input.value = id;

console.log(input.value);

button.classList.remove("disabled");

}


}
