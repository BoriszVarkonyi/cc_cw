function selectRow(x){

    var placeids = document.getElementById("fencer_id_input");

    if(x.classList.contains("selected")){
    
    x.classList.remove("selected");

    placeids.value = "";
    }
    else
    {
    
        var removeall = document.getElementsByClassName("selected");
    
        console.log(removeall);
        
        if(removeall.length != 0){
        
        for (let index = 0; index < removeall.length; index++) {
            removeall[index].classList.remove("selected");
            
        }
        }
        x.classList.add("selected");


        placeids.value = x.id;
        }


    }
    
