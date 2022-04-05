
function useAllReferees() {
    var selectReferees = document.getElementById("select_referees_panel");
    selectReferees.classList.add("disabled");
}

function selectReferees() {
    var selectReferees = document.getElementById("select_referees_panel");
    selectReferees.classList.remove("disabled");
}

function useAllPistes() {
    var selectPistes = document.getElementById("select_pistes_panel");
    selectPistes.classList.add("disabled");
}

function selectPistes() {
    var selectPistes = document.getElementById("select_pistes_panel");
    selectPistes.classList.remove("disabled");
}

var refPanel = document.getElementById("ref_panel");
var timePistPanel = document.getElementById("pist_time_panel");

function toggleRefPanel() {
    refPanel.classList.toggle("hidden");
    rfrsValidation();
}

function togglePistTimePanel() {
    timePistPanel.classList.toggle("hidden");
    pNtValidation();
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

function toggleDisqualifyPanel() {
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


//Removes the classes (when the pool table is full)
function removeOpenAndCollapseClass() {
    var elements = document.querySelectorAll("#pool_listing .opened")
    for (i = 0; i < elements.length; i++) {
        elements[i].classList.remove("opened")
    }
    elements = document.querySelectorAll("#pool_listing .collapsed")
    for (i = 0; i < elements.length; i++) {
        elements[i].classList.remove("collapsed")
    }
}

//Checks if the pool table is full
function checkPoolTable(x) {
    var table = x.parentNode
    var fencerNumber = table.querySelectorAll("tr:not(tr.drop)").length
    if (fencerNumber < maxFencerNumber) {
        return true;
    }
    else {
        return false;
    }
}

function checkSelectedEntry() {
    var moveFencerBackButtons = document.querySelectorAll(".fencer button")
    if (selectedEntry != undefined) {
        for (i = 0; i < moveFencerBackButtons.length; i++) {
            moveFencerBackButtons[i].disabled = false;
        }
    }
    else {
        for (i = 0; i < moveFencerBackButtons.length; i++) {
            moveFencerBackButtons[i].disabled = true;
        }
    }
}

var selectedEntry = undefined;
function selectEntry(x) {
    selectedEntry = x.parentElement;
    var entries = document.querySelectorAll(".entry")
    if (selectedEntry.classList.contains("selected")) {
        for (i = 0; i < entries.length; i++) {
            entries[i].classList.remove("selected")
        }
        selectedEntry = undefined;
        checkSelectedEntry();
    }
    else {
        for (i = 0; i < entries.length; i++) {
            entries[i].classList.remove("selected")
        }
        selectedEntry.classList.add("selected")
        checkSelectedEntry();
    }
}

class Fencer {
    constructor(name, nameP, club, cp, pr) {
        this.name = name;
        this.nameP = nameP;
        this.club = club;
        this.cp = cp;
        this.pr = pr;
    }
    createRow(selectedEntry) {
        // create a new div element
        const newDiv = document.createElement("tr");

        // and give it some content
        const newContent = '<td>' + this.nameP + '</td><td><p>' + this.club + '</p></td><td class="square"><p>' + this.cp + '</p></td><td class="square"><p>' + this.pr + '</p></td><td class="wide_controls"><button type="button" onclick="moveFencer(this, 0)"><img src="../assets/icons/arrow_upward_black.svg"></button><button type="button" onclick="moveFencer(this, 1)"><img src="../assets/icons/arrow_downward_black.svg"></button><button type="button" onclick="moveFencerAside(this)"><img src="../assets/icons/last_page_black.svg"></button></td>'

        // add the text node to the newly created div
        newDiv.innerHTML = newContent

        // add the newly created element and its content into the DOM
        selectedEntry.querySelector("tbody").appendChild(newDiv)
        checkSelectedEntry();
    }
    createBox() {
        // create a new div element
        const newDiv = document.createElement("div");
        newDiv.classList.add("fencer");

        // and give it some content
        const newContent = '<button type="button" onclick="moveFencerBack(this)"><img src="../assets/icons/keyboard_double_arrow_left_black.svg"></button><p>' + this.name + '</p>';

        // add the text node to the newly created div
        newDiv.innerHTML = newContent


        // add the newly created element and its content into the DOM
        document.getElementById("fencer_holder").appendChild(newDiv)
        checkSelectedEntry();
    }

}

var allTr = document.querySelectorAll("#page_content_panel_main tbody tr")
var fencerArray = []
for (i = 0; i < allTr.length; i++) {
    var fencer = new Fencer(allTr[i].querySelectorAll("tbody p")[0].innerHTML, allTr[i].querySelectorAll("tbody p")[0].outerHTML, allTr[i].querySelectorAll("tbody p")[1].innerHTML, allTr[i].querySelectorAll("tbody p")[2].innerHTML, allTr[i].querySelectorAll("tbody p")[3].innerHTML);
    fencerArray.push(fencer)
}

function findFencer(nameToSearchFor) {
    for (i = 0; i < fencerArray.length; i++) {
        if (fencerArray[i].name == nameToSearchFor) {
            return fencerArray[i]
        }
    }
}

function switchDivs(a, b) {
    var tempInner = a.innerHTML;
    a.innerHTML = b.innerHTML;
    b.innerHTML = tempInner;

}

function moveFencer(x, bool) {
    var currentTr = x.parentNode.parentNode
    var nextTr;
    if (bool) {
        nextTr = currentTr.nextElementSibling;
        if (nextTr != undefined) {
            switchDivs(currentTr, nextTr)
        }
    }
    else {
        nextTr = currentTr.previousElementSibling;
        if (nextTr != undefined) {
            switchDivs(currentTr, nextTr)
        }
    }
    cookieDealer();
    idloader();
}

function moveFencerBack(x) {
    findFencer(x.parentNode.querySelector("p").innerHTML).createRow(selectedEntry)
    x.parentNode.remove()
    cookieDealer();
    idloader();
}

function moveFencerAside(x) {
    findFencer(x.parentNode.parentNode.querySelector("p").innerHTML).createBox();
    x.parentNode.parentNode.remove()
    cookieDealer();
    idloader();
}


//Makes the JSON format string
var poolsId = ""
function idloader() {
    poolsId = "["
    var entries = document.querySelectorAll(".entry")
    for (i = 0; i < entries.length; i++) {
        poolsId = poolsId + "["
        var tablerowsJSONAttribute = entries[i].querySelectorAll("tr td:first-of-type > p")
        //console.log(tablerowsJSONAttribute)
        for (d = 0; d < tablerowsJSONAttribute.length; d++) {
            //console.log(tablerowsJSONAttribute[d].getAttribute("x-fencersave"))
            if (d < tablerowsJSONAttribute.length - 1) {
                poolsId = poolsId + tablerowsJSONAttribute[d].getAttribute("x-fencersave") + ","
            }
            else {
                poolsId = poolsId + tablerowsJSONAttribute[d].getAttribute("x-fencersave");
            }
        }
        if (i == entries.length - 1) {
            poolsId = poolsId + "]"
        }
        else {
            poolsId = poolsId + "],"
        }
    }
    poolsId = poolsId + "]"
    hiddenInput = document.getElementById("savePoolsHiddenInput")
    hiddenInput.value = poolsId
}
idloader()

function cookieDealer() {
    var fencers = document.querySelectorAll("aside .fencer")
    var asideId = []
    var stringifyString;
    for (i = 0; i < fencers.length; i++) {
        asideId.push(fencers[i].querySelector("p").innerHTML)
    }
    stringifyString = JSON.stringify(asideId)
    document.cookie = "aside = " + stringifyString + ";" + setExpireDay(365)

    var entries = document.querySelectorAll("#page_content_panel_main .entry")
    for (i = 0; i < entries.length; i++) {
        fencers = entries[i].querySelectorAll("tbody tr > td:first-of-type p")
        var tempArray = []
        for (j = 0; j < fencers.length; j++) {
            tempArray.push(fencers[j].innerHTML)
            stringifyString = JSON.stringify(tempArray)
        }
        document.cookie = 'pool' + i + ' = ' + stringifyString + ';' + setExpireDay(365)
    }
}

var poolCookies = []
for (i = 0; i < document.querySelectorAll(".entry").length; i++) {
    var cookie = cookieFinder("pool" + i, "", false, 365)
    poolCookies.push(cookie)
}
var asideCookie = cookieFinder("aside", "", false, 365)

function reloadByCooke() {
    var trs = document.querySelectorAll("tbody tr")
    for (i = 0; i < trs.length; i++) {
        trs[i].remove();
    }
    
    var poolsToRegenerate = JSON.parse("[" + poolCookies + "]")
    var entries = document.querySelectorAll(".entry")
    for (k = 0; k < entries.length; k++) {
        for (j = 0; j < poolsToRegenerate[k].length; j++) {
            var name = poolsToRegenerate[k][j]
            findFencer(name).createRow(entries[k])
        }
    }

    var asideToRegenerate =  JSON.parse("[" + asideCookie + "]")

    for(k=0; k<asideToRegenerate[0].length; k++){
        findFencer(asideToRegenerate[0][k]).createBox();
    }
    

}

var hiddenInput = document.getElementById("savePoolsHiddenInput")
hiddenInput.value = poolsId
//FORM VALIDATION
var valid1 = false, valid2 = false;
//It is a var from main.js
canAutoValidate = false;
//Pistes And Time validation
var pistesAndTimeForm = document.getElementById("pist_time_panel")
var input1 = document.getElementById("startingTimeInput");
var input2 = document.getElementById("timeInput");
var pNtsaveButton = document.getElementById("pNtSaveButton");
var inputs = [input1, input2];
var allButton = document.getElementById("all");
var pNtoptioncontainer = document.getElementById("select_pistes_panel");
var pisteSelect = pNtoptioncontainer.querySelectorAll(".piste_select");

function pNtValidation() {
    pNtsaveButton.disabled = true;
    //Checking every input.
    for (i = 0; i < inputs.length; i++) {
        if (inputs[i].value == "") {
            //If it finds an empty input, then it disable the "Save" button.
            valid1 = false;
            break;
        }
        else {
            //If everything has a value then it enable the "Save" Button. The user can save.
            valid1 = true;
        }
    }
    if (allButton.checked) {
        valid2 = true;
    }
    else {
        valid2 = false;
        for (i = 0; i < pisteSelect.length; i++) {
            if (pisteSelect[i].firstElementChild.checked == true) {
                valid2 = true;
                break;
            }
        }
    }
    if (valid1 && valid2) {
        pNtsaveButton.disabled = false;
    }
    else {
        pNtsaveButton.disabled = true;
    }
}
pistesAndTimeForm.addEventListener("input", pNtValidation)
//Referees validation
var refereesForm = document.getElementById("ref_panel")
var allrfrs = document.getElementById("all_ref")
var rfrsoptioncontaioner = document.getElementById("select_referees_panel")
var rfrsselect = rfrsoptioncontaioner.querySelectorAll(".piste_select")
var rfrsSaveButton = document.getElementById("rfrsSaveButton")
function rfrsValidation() {
    rfrsSaveButton.disabled = true
    if (allrfrs.checked) {
        valid2 = true;
    }
    else {
        valid2 = false;
        for (i = 0; i < rfrsselect.length; i++) {
            if (rfrsselect[i].firstElementChild.checked == true) {
                valid2 = true;
                break;
            }
        }
    }
    if (valid2) {
        rfrsSaveButton.disabled = false;
    }
    else {
        rfrsSaveButton.disabled = true;
    }
}
refereesForm.addEventListener("input", rfrsValidation)

function poolConfig(x) {
    var searchWrappers = x.parentNode.parentNode.querySelectorAll(".search_wrapper, .pool_time_input")
    var texts = x.parentNode.parentNode.querySelectorAll("p")
    var saveButton = x.parentNode.parentNode.querySelector(".pool_config_submit")
    document.querySelector("aside").classList.add("closed")
    for (i = 0; i < searchWrappers.length; i++) {
        searchWrappers[i].classList.remove("hidden")
    }
    for (i = 0; i < texts.length; i++) {
        texts[i].classList.add("hidden")
    }
    x.classList.add("hidden")
    saveButton.classList.remove("hidden")
}

document.addEventListener("keyup", function (e) {
    //somethingisOpened is a var. from main.js
    //somethingIsFocused is a var. from main.js
    if (!somethingisOpened && !somethingIsFocused) {
        if (e.shiftKey && e.which == 80) {
            var printPoolsButton = document.getElementById("printPools")
            printPoolsButton.click();
        }
        if (e.shiftKey && e.which == 82) {
            var refereesButton = document.getElementById("referees")
            refereesButton.click()
        }
        if (e.shiftKey && e.which == 84) {
            var pistesNTimeButton = document.getElementById("pistesNTimeBt")
            pistesNTimeButton.click();
        }
        if (e.shiftKey && e.which == 84) {
            var savePoolsButton = document.getElementById("savePoolsBt")
            savePoolsButton.click();
        }
        if (e.shiftKey && e.which == 13) {
            var startPoolsButton = document.getElementById("startPoolsBt")
            startPoolsButton.click();
        }
    }
})





