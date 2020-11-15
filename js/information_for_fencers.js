//Removes all written in equipment value
function removeEquipmentValues(){

    for (let index = 0; index < 13; index++) {
        
        var removefrom = document.getElementById("input_" + index);
        removefrom.value = "";
    
    }
}


//Copies the content of an editable div and pastes to an input

function copyContent(){
    
    var from = document.getElementById("additional");
    
    var to = document.getElementById("additional_info_input");

    to.value = from.innerHTML;

    console.log(to.value);
}


//Takes the focus to the clicked line's number input field

function takeToField(x) {

y = x.id;

var tofocus = document.getElementById("input_" + y);

console.log(tofocus);

tofocus.focus();

}
 

//PATRIK INNENTŐL
//Maximum 0-5 numbers, max 1 lenght number input

var baloldal = document.getElementById("needed_equipment_panel");

baloldal.addEventListener("keyup", event => {

    var ertek = document.activeElement; // Max value 5 for needed_equipmen_panel
    if (ertek.value >5) {

    ertek.value = 5;//if it is bigger than 5, won't allow to be bigger than 5

    }
    if (ertek.value < 1) {

        ertek.value = "";//if it smaller than 1, returns to an empty space (won't storage capacity in the database)

    }
  });
  function isNumberKey(evt)//You can olny write numbers as inputs 
      {
         var inp =document.getElementById("needed_equipment_panel") (evt.which) ? evt.which : event.keyCode
    
         if (inp > 0 && (inp <= 5  || inp > 0)) //inupt can't be higher than 5
    
         return false;

         return true;
      }
    
