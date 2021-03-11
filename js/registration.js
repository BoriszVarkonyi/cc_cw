var addFencerPanel = document.getElementById("add_fencer_panel");
var regInButton = document.getElementById("regIn")
var regOutButton = document.getElementById("regOut")

function toggleAddFencerPanel() {
    addFencerPanel.classList.remove("hidden");
}

function setNation(x) {
    var field = document.getElementById("nationInput");
    field.value = x.innerHTML;
    formvariableDeclaration()
}

var tableRows = document.querySelectorAll(".table_row_wrapper .table_row")
//Event listener to class change
function callback(mutationsList, observer) {
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
            buttonDisabler()
        }
    })
}

const mutationObserver3 = new MutationObserver(callback)
for (i = 0; i < tableRows.length; i++) {
    mutationObserver3.observe(tableRows[i], { attributes: true })
}

var registrationtable = document.querySelector(".table_row_wrapper")
registrationtable.addEventListener("click", buttonDisabler)
var isselected = false;

function buttonDisabler() {
    var selectedItem = document.querySelector(".table_row_wrapper .selected")
    if (selectedItem !== null) {
        regInButton.classList.remove("disabled");
        regOutButton.classList.remove("disabled");
        isselected = true;
    }
    else {
        regInButton.classList.add("disabled");
        regOutButton.classList.add("disabled");
        isselected = false;
    }
}

document.addEventListener("keyup", function (e) {
    //somethingisOpened is a var. from main.js
    //somethingIsFocused is a var. from main.js
    if (!somethingisOpened && !somethingIsFocused) {
        //Opens add registration to Shift+A
        if (e.shiftKey && e.which == 65) {
            var addfencer = document.getElementById("addFencer")
            addfencer.click()
        }
        if (isselected) {
            //Regist out to Shift+O
            if (e.shiftKey && e.which == 79) {
                regOutButton = document.getElementById("regOut")
                regOutButton.click()
            }
            //Regists in to Shift+I
            if (e.shiftKey && e.which == 73) {
                regInButton = document.getElementById("regIn")
                regInButton.click()
            }
        }
    }
})
var searchFor = ""
var nat = document.querySelectorAll(".table_item:nth-of-type(2) > p");
for (i = 0; i < nat.length; i++) {
    nat[i].parentNode.parentNode.style.display = "";
}
for (i = 0; i < nat.length; i++) {
    if (nat[i].innerHTML != searchFor && searchFor != "") {
        nat[i].parentNode.parentNode.style.display = "none";
    }
}
