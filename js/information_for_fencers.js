//Removes all written in equipment value
function removeEquipmentValues(){

    for (let index = 0; index < 13; index++) {
        
        var removefrom = document.getElementById("input_" + index);
        removefrom.value = "";
    
    }
}
//END

//Copies the content of an editable div and pastes to an input

function copyContent(){
    
    var from = document.getElementById("additional");
    
    var to = document.getElementById("additional_info_input");

    to.value = from.innerHTML;

    console.log(to.value);
}
//END

//Takes the focus to the clicked line's number input field

function takeToField(x) {

y = x.id;

var tofocus = document.getElementById("input_" + y);

console.log(tofocus);

tofocus.focus();

}
//END 

//PATRIK INNENTŐL
//Maximum 0-5 numbers, max 1 lenght number input

var baloldal = document.getElementById("needed_equipment_panel");

baloldal.addEventListener("keydown", event => {

    var ertek = document.activeElement; //Érték az éppen aktív input lesz az "ACTIVEELEMENT" miatt 
    if (ertek.value >5) {

    ertek.value = 5;

    }
    if (ertek.value < 1) {

        ertek.value = "";

    }
  });
  function isNumberKey(evt)//Csak számok írhatók be az inputba 0-5 között, írásjelek nem.
      {
         var inp =document.getElementById("needed_equipment_panel") (evt.which) ? evt.which : event.keyCode
    
         if (inp > 0 && (inp <= 5  || inp > 0))
    
         return false;

         return true;
      }
    
