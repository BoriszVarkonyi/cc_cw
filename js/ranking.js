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
/* 
var saveButton = document.querySelector(".panel_submit");
var input = document.querySelectorAll('#new_fencer>input');
console.log(input)
saveButton.disabled = true;
document.addEventListener("input", function(){
for(i=0; i<input.length; i++){
if(input[i].value == ""){
saveButton.disabled = true;
console.log(input[i] + "" + i + " üres")
} 
else {
saveButton.disabled = false;  
}
}
})
*/

function checkform(form) {
  // get all the inputs within the submitted form
  var inputs = form.getElementsByTagName('input');
  for (var i = 0; i < inputs.length; i++) {
      // only validate the inputs that have the required attribute
          if(inputs[i].value == ""){
              // found an empty field that is required
              alert("Please fill all required fields");
              return false;
          }
      
  }
  return true;
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


button.classList.add("disabled");

}
else{

x.classList.add("selected");

input.value = id;



button.classList.remove("disabled");

}


}


//patrik can't be added empty
/*
function validateForm(){
    var isValid = true;
  
    var elements = document.getElementById("rk").getElementsByTagName('input');
    console.log(elemets)
  
    for(var i=0; i < elements.length; i++){
      if(elements[i].value.length < 1){
        isValid = false;
      }
    }
  
    if(isValid){
      document.getElementById('rk').submit();
    }
    else {
      alert('Please fill all required fields');
    }
  }
  */