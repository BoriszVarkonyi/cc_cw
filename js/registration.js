function selectRow(x){

if(x.classList.contains("selected")){

x.classList.remove("selected");

}else{

    var removeall = document.getElementsByClassName("selected");

    console.log(removeall);
    
    if(removeall.length != 0){
    
    for (let index = 0; index < removeall.length; index++) {
        removeall[index].classList.remove("selected");
        
    }
    }
    x.classList.add("selected");
    }
}

var addFencerPanel = document.getElementById("add_fencer_panel");

function toggleAddFencerPanel() {
    addFencerPanel.classList.remove("hidden");
}
