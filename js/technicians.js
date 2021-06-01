//Toggles technician and import technician panel
function toggleAddPanel() {
    var element = document.getElementById("add_technician_panel");
    element.classList.toggle("hidden");
}

function toggleImportPanel() {
    var element = document.getElementById("import_technician_panel");
    element.classList.toggle("hidden");
    //importOverlayClosed is a var. from importoverlay.js
    if (element.classList.contains("hidden")) {
        importOverlayClosed = true;
    }
    else {
        importOverlayClosed = false;
    }
}


//Generates a random password with 10 character to the password field of new technician

function randomPassword() {

    var alphabet = "abcdefghijklmnopqrstuvwxyz" + 'abcdefghijklmnopqrstuvwxyz'.toUpperCase() + "0123456789";
    var randompasswordarray = [];

    for (i = 0; i < 10; i++) {

        var randomnumber = Math.floor(Math.random() * 62);
        var randomletter = alphabet.charAt(randomnumber);
        randompasswordarray.push(randomletter);

    }

    randompassword = randompasswordarray.join("");
    var passfield = document.getElementById("password_input");
    passfield.value = randompassword;
}
/*
//Counts the characters of ranking information's passwords and replaces with as many stars as many characters the password had
var buttonIcon = document.querySelector("#visibility_button > img")
var passwordText = document.querySelectorAll(".password p")
var passwords= [];
var tableRows = document.querySelectorAll(".wrapper .table_row")

//Saves all the passwords
for(i=0; i<passwordText.length; i++){
    passwords.push(passwordText[i].innerHTML)
}

//Saves the password
for (i = 0; i < tableRows.length; i++) {
    var stars = "";
    for (j = 0; j < passwordText[i].innerHTML.length; j++) {
        stars += "*";
    }
    passwordText[i].innerHTML = stars
}

var visible = true;

//Hides the password
buttonIcon.src = "../assets/icons/visibility_off_black.svg";
function hidePasswordButton(x) {
    if (visible) {
        //Hides the password changes the image
        buttonIcon.src = "../assets/icons/visibility_black.svg";
        for(i=0; i<passwordText.length; i++){
            passwordText[i].innerHTML = passwords[i]
        }
        visible = false;
    }
    else {
        //Show the password, changes the image
        buttonIcon.src = "../assets/icons/visibility_off_black.svg";
        for (i = 0; i < passwordText.length; i++) {
            var stars = "";
            for (j = 0; j < passwordText[i].innerHTML.length; j++) {
                stars += "*";
            }
            passwordText[i].innerHTML = stars
        }
        visible = true;
    }
}

*/

//Selects the competition that the technicians will be imported from
var importTechHiddenInput = document.getElementById("selected_row_input_import")
var oldSelectedTechImport;
function selectForImport(x) {
    var importTechTablerows = document.querySelectorAll(".select_competition_wrapper .table_row")
    var clickedImportTechrow = x
    if (oldSelectedTechImport != clickedImportTechrow) {
        //removes selected class from every row
        for (i = 0; i < importTechTablerows.length; i++) {
            importTechTablerows[i].classList.remove("selected");
        }
        //Adds selected class
        clickedImportTechrow.classList.add("selected")
        //Saves the id into the hidden input
        importTechHiddenInput.value = clickedImportTechrow.id
        //Saves the clicked row
        oldSelectedTechImport = clickedImportTechrow;
    }
    else {
        //Adds selected class
        clickedImportTechrow.classList.remove("selected")
        //Saves the id into the hidden input
        importTechHiddenInput.value = ""
        //Saves the clicked row
        oldSelectedTechImport = undefined;
    }
}


