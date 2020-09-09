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
//Maximum 0-4 numbers, max 1 lenght number input

var answer =prompt("input_0").length;

var response;

if(answer.length > 0){
} 
if (answer.length < 2) {
    response = 'Your name has more than one characters';
}

alert(response);
