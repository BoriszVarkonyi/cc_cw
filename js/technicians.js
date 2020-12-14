//Toggles technician and import technician panel
function toggle_add_technician() {
    var element = document.getElementById("add_technician_panel");
    element.classList.toggle("hidden");
}

function toggle_import_technician() {
    var element = document.getElementById("import_technician_panel");
    element.classList.toggle("hidden");
}


//Generates a random password with 10 character to the password field of new technician

function randomPassword(){

    var alphabet = "abcdefghijklmnopqrstuvwxyz" + 'abcdefghijklmnopqrstuvwxyz'.toUpperCase() + "0123456789";
    var randompasswordarray = [];
    
    for (i = 0;i < 10; i++) {
        
        var randomnumber = Math.floor(Math.random() * 62);
        var randomletter = alphabet.charAt(randomnumber);
        randompasswordarray.push(randomletter);
    
    }
    
    randompassword = randompasswordarray.join("");
    var passfield = document.getElementById("password_input");
    passfield.value = randompassword;
    }


//Counts the characters of technician's passwords and replaces with as many stars as many characters the password had

var visib = 1;
var sajtos = [];
var change_id = document.getElementsByClassName("password_table_item");
for(i = 0; i < change_id.length; i++) {

   var sajt = change_id.item(i).innerHTML;
   sajtos.push(sajt);

}
var test = [];

    sajtos.forEach(element => test.push(element.length));

var star = "*";

    for(i = 0; i < change_id.length; i++) {

        change_id.item(i).innerHTML = star.repeat(test[i]);
 
     }


//Changes between the shown end the hidden password.

function hidePasswords(x) {

    var buttonIcon = document.querySelector("#visibility_button > img");

    buttonIcon.src = "../assets/icons/visibility_off-black-18dp.svg";

    if (visib == 1){
    
        buttonIcon.src = "../assets/icons/visibility_off-black-18dp.svg";

    for(i = 0; i < change_id.length; i++) {

        change_id.item(i).innerHTML = sajtos[i];
     
    }

    visib = 2;


    }
    else{

        for(i = 0; i < change_id.length; i++) {

            change_id.item(i).innerHTML = star.repeat(test[i]);
     
         }

         buttonIcon.src = "../assets/icons/visibility-black-18dp.svg";

         visib = 1;
    }
}

//Selects the competition that the technicians will be imported from
function importTechnicians(x) {
    var remclass = document.getElementsByClassName("selected");
    var i;
    for(i = 0; i < remclass.length; i++){
        remclass[i].classList.remove("selected");
    }
    var y = x.id;
    var z = document.getElementById(y);
    z.classList.add("selected");
    document.cookie="selected=" + y;
}

//document.cookie="techtoremove=" + null;

//Technicians formvalidation
var valid1 = false, valid2 = false;
//It is a var from main.js
canAutoValidate = false;
var newTchForm = document.getElementById("new_technician");
var techInput = newTchForm.querySelector("input:first-of-type")
var techoptioncontainer = newTchForm.querySelector(".option_container")
var techOptionButton = techoptioncontainer.querySelectorAll(".option_button")
var techSaveButton = newTchForm.querySelector(".panel_submit")
techSaveButton.disabled = true;
function technisiansValidation(){
    if(techInput.value == ""){
        valid1 = false;
    }
    else{
        valid1 = true;
    }
    for(i=0; i<techOptionButton.length; i++){
        if(techOptionButton[i].checked){
            valid2 = true;
            break
        }
        else{
            valid2 = false;
        }
    }
    if(valid1 && valid2){
        techSaveButton.disabled = false;    
    }
    else{
        techSaveButton.disabled = true;
    }
}
newTchForm.addEventListener("input", technisiansValidation)