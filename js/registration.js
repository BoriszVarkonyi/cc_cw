document.onkeydown = (keyDownEvent) => {

    if(keyDownEvent.key == "ArrowUp"){


        var tabla = document.getElementById("table");
        var kijelolt = document.getElementsByClassName("selected");

        var elem = kijelolt[0];
        var kovielem = elem.previousElementSibling;

        //console.log(tabla.children[2]);
        //console.log(elem);

        if(elem != tabla.children[1]){

            elem.classList.remove("selected");
            kovielem.classList.add("selected");

        }else
        {

            console.log("First");
        }
    }


    if(keyDownEvent.key == "ArrowDown"){


        var tabla = document.getElementById("table");
        var kijelolt = document.getElementsByClassName("selected");

        var elem = kijelolt[0];
        var kovielem = elem.nextElementSibling;

        if(elem != tabla.lastElementChild){

            elem.classList.remove("selected");
            kovielem.classList.add("selected");

        }else
        {

            console.log("LAST");
        }
    }
}

function selectRow(x){

var hiddenin = document.getElementById("fencer_ids");

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
