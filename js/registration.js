function selectRow(x){

if(x.classList.contains("selected")){

x.classList.remove("selected");

hiddenin.value = "";

}
else{

    var removeall = document.getElementsByClassName("selected");

    console.log(removeall);
    
    if(removeall.length != 0){
    
    for (let index = 0; index < removeall.length; index++) {
        removeall[index].classList.remove("selected");
        
    }
    }
    x.classList.add("selected");

    hiddenin.value = x.id;
    }
}

var addFencerPanel = document.getElementById("add_fencer_panel");

function toggleAddFencerPanel() {
    addFencerPanel.classList.remove("hidden");
}


function setNation(x){

    var field = document.getElementById("inputs");
    
    field.value = x.innerHTML;



}
