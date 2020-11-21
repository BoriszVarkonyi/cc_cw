function refPisTimePanel() {
    var panel = document.getElementById("ref_pis_time_panel");
    panel.classList.toggle("hidden");
}

function poolConfigToggle(x) {
    var clickedButton = x;
    var pool = clickedButton.parentNode.parentNode;
    var configPanel = pool.lastElementChild;

    configPanel.classList.toggle("hidden")
}

function poolConfigClose(x) {
    var clickedButton = x;
    var panel = clickedButton.parentNode;

    panel.classList.toggle("hidden")
}

function disqualifyToggle() {
    var panel = document.getElementById("disqualify_panel");
    panel.classList.toggle("hidden");
}

function useAll() {
    var selectPistes = document.getElementById("select_pistes_panel");
    selectPistes.classList.add("disabled")
}

function selectPistes() {
    var selectPistes = document.getElementById("select_pistes_panel");
    selectPistes.classList.remove("disabled")
}

function allowDrop(ev) {
    ev.preventDefault();
  }
  
  function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
  }
  
  function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
  }

    




    

    


    
    
function generatePanel(){

    var f_number_input = document.getElementById("fencer_quantity");
    var f_number = f_number_input.value;


    for (let index = 7; index > 3; index--) {
        
        var torekves = index;

        var szoveg = document.getElementById("p_" + torekves);

        inputka = document.getElementById(index);

        var fullpool = f_number / torekves;
        
        if(f_number % torekves == 0){

            szoveg.innerHTML = fullpool + " pool of " + torekves;
            inputka.value = fullpool;
        
            }
        else
            {

                var teljescsop = Math.floor(f_number / torekves);
                
            
                var maradek = f_number % torekves;
            
                var ennyikell = (torekves - 1) - maradek;
            
                var nagyobb = teljescsop - ennyikell;
                var kisebb = 1 + ennyikell;
            
                var torekvesalatt = torekves - 1;
            
                if(nagyobb <= 0){
            
                    szoveg.innerHTML = "NEM LEHETSÉGES";
            
                }else{
            
                    szoveg.innerHTML = nagyobb + " pool of " + torekves + " and " + kisebb + " pool of " + torekvesalatt;
                    inputka.value = nagyobb + kisebb;
            
                }
            
                }
    }


}
  