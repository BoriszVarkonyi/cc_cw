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
        canAutoValidate = true;
    }
    else {
        importOverlayClosed = false;
        canAutoValidate = false;
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
var passwordText = document.querySelectorAll(".password p")
var passwords = [];
var tableRows = document.querySelectorAll(".wrapper .table_row")
if (tableRows.length > 0) {


    //Saves all the passwords
    for (i = 0; i < passwordText.length; i++) {
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
            for (i = 0; i < passwordText.length; i++) {
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
}
//Selects the competition that the technicians will be imported from
var importTechHiddenInput = document.getElementById("selected_comp_input")
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

function setNation(x) {
    var input = x.parentNode.previousElementSibling.previousElementSibling;
    input.value = x.innerHTML;
}
//Table resizer

//var table = document.querySelector(' .table');
//var rows = document.querySelectorAll(".table_row")
//for(k=0; k<rows.length; k++){
//    resizableGrid(table);
//}
//resizableGrid(table);
//function resizableGrid(table) {
//    var row = table.querySelectorAll(".table_row")[k],
//    cols = row ? row.children : undefined;
//    if (!cols) return;
//    for (var i=0;i<cols.length-2;i++){
//        var div = createDiv(table.offsetHeight);
//        cols[i].appendChild(div);
//        cols[i].style.position = 'relative';
//        setListeners(div);
//    }
//    function createDiv(height){
//        var div = document.createElement('div');
//        div.style.top = 0;
//        div.style.right = 0;
//        div.style.width = '5px';
//        div.style.position = 'absolute';
//        div.style.cursor = 'col-resize';
//        /* remove backGroundColor later */
//        div.style.backgroundColor = 'red';
//        div.style.userSelect = 'none';
//        /* table height */
//        div.style.height = height+'px';
//        return div;
//    }
//    function setListeners(div){
//        var pageX,curCol,nxtCol,curColWidth,nxtColWidth;
//        div.addEventListener('mousedown', function (e) {
//        curCol = e.target.parentElement;
//        nxtCol = curCol.nextElementSibling;
//        pageX = e.pageX;
//        curColWidth = curCol.offsetWidth
//        if (nxtCol)
//        nxtColWidth = nxtCol.offsetWidth
//        });
//
//        document.addEventListener('mousemove', function (e) {
//        if (curCol) {
//        var diffX = e.pageX - pageX;
//
//        if (nxtCol)
//        nxtCol.style.width = (nxtColWidth - (diffX))+'px';
//
//        curCol.style.width = (curColWidth + diffX)+'px';
//        }
//
//        });
//
//    document.addEventListener('mouseup', function (e) {
//        curCol = undefined;
//        nxtCol = undefined;
//        pageX = undefined;
//        nxtColWidth = undefined;
//        curColWidth = undefined;
//        });
//    }
//}

//Add fencer overlay button and title system
var leftDivisionButton = document.getElementById("overlayPanelButtonLeft");
var rightDivisionButton = document.getElementById("overlayPanelButtonRight");
var currentTitle = document.querySelector(".overlay_panel_controls p");
var overlayPanelDivisions = document.querySelectorAll(".overlay_panel_division");
var controlsCounter = document.querySelector(".overlay_panel_controls_counter");
var maxNumber = overlayPanelDivisions.length;
var currentDivision = 0;

leftDivisionButton.disabled = true;
currentTitle.innerHTML = overlayPanelDivisions[currentDivision].getAttribute("overlay_division_title")
controlsCounter.innerHTML = maxNumber + " / " + (currentDivision + 1);

function leftButton(x) {
    currentDivision--
    overlayPanelDivisions[currentDivision + 1].classList.remove("visible")
    overlayPanelDivisions[currentDivision].classList.add("visible")
    currentTitle.innerHTML = overlayPanelDivisions[currentDivision].getAttribute("overlay_division_title")
    controlsCounter.innerHTML = maxNumber + " / " + (currentDivision + 1);
    divisionButtonDisabler();
}

function rightButton(x) {
    currentDivision++
    overlayPanelDivisions[currentDivision - 1].classList.remove("visible");
    overlayPanelDivisions[currentDivision].classList.add("visible");
    currentTitle.innerHTML = overlayPanelDivisions[currentDivision].getAttribute("overlay_division_title");
    controlsCounter.innerHTML = maxNumber + " / " + (currentDivision + 1);
    divisionButtonDisabler();
}

function divisionButtonDisabler() {
    if (currentDivision == 0) {
        leftDivisionButton.disabled = true;
    }
    else {
        leftDivisionButton.disabled = false;
    }

    if (currentDivision == maxNumber - 1) {
        rightDivisionButton.disabled = true;
    }
    else {
        rightDivisionButton.disabled = false;
    }
}

//Club Nation deleter
var clubAndNationInput = document.querySelectorAll("#set_nation_input")
clubAndNationInput.forEach(item => {
    item.addEventListener("keyup", function (e) {
        var ul = item.nextElementSibling.nextElementSibling;
        if (ul.classList.contains("empty")) {
            item.value = "";
            ul.classList.remove("empty")
            ul.classList.add("error")
        }
        else {
            ul.classList.remove("error")
        }
    })
})

/*
visibility_black.svg
visibility_off_black.svg
*/
