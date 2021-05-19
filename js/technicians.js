//Toggles technician and import technician panel
function toggle_add_technician() {
    var element = document.getElementById("add_technician_panel");
    element.classList.toggle("hidden");
}

function toggle_import_technician() {
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
//Counts the characters of ranking information's passwords and replaces with as many stars as many characters the password had
var buttonIcon = document.querySelector("#visibility_button > img")
var passwordText = document.getElementById("password")
//Saves the password
var password = passwordText.innerHTML
var stars = "";
var visible = false;
//Hides the password
for (i = 0; i < passwordText.innerHTML.length; i++) {
    stars += "*"
}
passwordText.innerHTML = stars
buttonIcon.src = "../assets/icons/visibility_off_black.svg";

function hidePasswordButton(x) {
    if (visible) {
        //Hides the password changes the image
        buttonIcon.src = "../assets/icons/visibility_off_black.svg";
        var stars = "";
        for (i = 0; i < passwordText.innerHTML.length; i++) {
            stars += "*"
        }
        passwordText.innerHTML = stars
        visible = false;
    }
    else {
        //Show the password, changes the image
        passwordText.innerHTML = password
        buttonIcon.src = "../assets/icons/visibility_black.svg";
        visible = true;
    }
}

//Selects the competition that the technicians will be imported from
var importTechHiddenInput = document.getElementById("selected_row_input_import")
var oldSelectedTechImport;
function importTechnicians(x) {
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
