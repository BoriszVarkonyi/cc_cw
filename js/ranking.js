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
//FORM VALIDATION
var form = document.getElementById("new_fencer")
var saveButton = document.querySelector(".panel_submit");
var inputs = document.querySelectorAll('#new_fencer>input');
var points = document.getElementById("ranking_points");
//Set the "Save" button disabled.
saveButton.disabled = true;
//If the document values are changing, it runs the function.
form.addEventListener("input", function(){
  //Check the "Points" input value.
  if(points.value < 0) {
    //If its grather than 10 or less than 0, it sets the value "" (0).
    points.value = "";
  }
  //Checking every input.
  for(i=0; i<inputs.length; i++){

    if(inputs[i].value == ""){
      //If it finds an empty input, then it disable the "Save" button.
      saveButton.disabled = true;
      break;

    }
    else {
      //If everything has a value then it enable the "Save" Button. The user can save.
      saveButton.disabled = false;

    }
  }
}
)



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

//Counts the characters of ranking information's passwords and replaces with as many stars as many characters the password had
var buttonIcon = document.querySelector("#visibility_button > img")
var passwordText = document.getElementById("password")
//Saves the password
var password = passwordText.innerHTML
var stars ="";
var visible = false;
//Hides the password
for(i=0; i<passwordText.innerHTML.length; i++) {
  stars += "*"
}
passwordText.innerHTML = stars
buttonIcon.src = "../assets/icons/visibility_off-black.svg";

function hidePasswords(x) {
  if(visible){
    //Hides the password changes the image
    buttonIcon.src = "../assets/icons/visibility_off-black.svg";
    var stars ="";
    for(i=0; i<passwordText.innerHTML.length; i++) {
      stars += "*"
    }
    passwordText.innerHTML = stars
    visible = false;
  }
  else {
    //Show the password, changes the image
    passwordText.innerHTML = password
    buttonIcon.src = "../assets/icons/visibility-black.svg";
    visible = true;
  }
}

