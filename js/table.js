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
}

function togglePistTimePanel() {
    timePistPanel.classList.toggle("hidden");
}

//Tableview cookies
var firstIndex = cookieFinder("firstIndex", 0, true);
var secondIndex;
var eleminitaions = document.querySelectorAll(".elimination")
var btLeft = document.getElementById("buttonLeft")
var btRight = document.getElementById("buttonRight")

//If found da cookie
if (document.cookie.split(';').some((item) => item.trim().startsWith('secondIndex='))) {
    secondIndex = parseInt(getCookie("secondIndex"))
}
//If not found da cookie
else {
    if (eleminitaions.length > 4) {
        secondIndex = 4;
    }
    else {
        secondIndex = eleminitaions.length
    }
    document.cookie = "secondIndex=" + secondIndex
}
//Hides all the eliminations
for (i = 0; i < eleminitaions.length; i++) {
    eleminitaions[i].classList.add("hidden")
}
//Shows eleminiations by index
disabler();
for (i = firstIndex; i < secondIndex; i++) {
    eleminitaions[i].classList.remove("hidden")

}

function buttonLeft() {
    btLeft.classList.remove("disabled")
    btRight.classList.remove("disabled")
    firstIndex--
    secondIndex--
    //Hides all the eliminations
    for (i = 0; i < eleminitaions.length; i++) {
        eleminitaions[i].classList.add("hidden")
    }
    //Shows eleminiations by index
    for (i = firstIndex; i < secondIndex; i++) {
        eleminitaions[i].classList.remove("hidden")

    }
    document.cookie = "firstIndex=" + firstIndex
    document.cookie = "secondIndex=" + secondIndex
    disabler();
}
function buttonRight() {
    btLeft.classList.remove("disabled")
    btRight.classList.remove("disabled")
    firstIndex++
    secondIndex++
    //Hides all the eliminations
    for (i = 0; i < eleminitaions.length; i++) {
        eleminitaions[i].classList.add("hidden")
    }
    //Shows eleminiations by index
    for (i = firstIndex; i < secondIndex; i++) {
        eleminitaions[i].classList.remove("hidden")

    }
    document.cookie = "firstIndex=" + firstIndex
    document.cookie = "secondIndex=" + secondIndex
    disabler();
}
function disabler() {
    if (firstIndex == 0) {
        btLeft.classList.add("disabled")
    }
    if (secondIndex == eleminitaions.length) {
        btRight.classList.add("disabled")
    }
}

//Gets window size
window.addEventListener("resize", windowSize);
window.addEventListener("DOMContentLoaded", windowSize);
var vw;
//Chagnes the shown table numbers by the window size
function windowSize() {
    vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0)
    if (vw > 1600 && eleminitaions.length >= 4) {
        for (i = 0; i < eleminitaions.length; i++) {
            eleminitaions[i].classList.add("hidden")
        }
        secondIndex = firstIndex + 4;
        for (i = firstIndex; i < secondIndex; i++) {
            eleminitaions[i].classList.remove("hidden")

        }
    }
    else if (vw > 1100 && vw < 1600 && eleminitaions.length >= 3) {
        for (i = 0; i < eleminitaions.length; i++) {
            eleminitaions[i].classList.add("hidden")
        }
        secondIndex = firstIndex + 3;
        for (i = firstIndex; i < secondIndex; i++) {
            eleminitaions[i].classList.remove("hidden")

        }
    }
    else if (vw > 700 && vw < 1100 && eleminitaions.length >= 2) {
        for (i = 0; i < eleminitaions.length; i++) {
            eleminitaions[i].classList.add("hidden")
        }
        secondIndex = firstIndex + 2;
        for (i = firstIndex; i < secondIndex; i++) {
            eleminitaions[i].classList.remove("hidden")

        }
    }
    else if (vw < 700) {
        for (i = 0; i < eleminitaions.length; i++) {
            eleminitaions[i].classList.add("hidden")
        }
        secondIndex = firstIndex + 1;
        for (i = firstIndex; i < secondIndex; i++) {
            eleminitaions[i].classList.remove("hidden")

        }
    }
    var shownEliminations = document.querySelectorAll(".elimination:not(.hidden)")
    if (shownEliminations.length == eleminitaions.length) {
        btRight.classList.add("disabled")
    }
}
//Automaticly sets the table title
var eliminations = document.querySelectorAll(".elimination_label")
var tableOfIndex = 8;
for (i = eliminations.length - 1; i >= 0; i--) {
    if (i == eliminations.length - 1) {
        eliminations[i].innerHTML = "Winner"
    }
    else if (i == eliminations.length - 2) {
        eliminations[i].innerHTML = "Final"
    }
    else if (i == eliminations.length - 3) {
        eliminations[i].innerHTML = "Semi Final"
    }
    else {
        eliminations[i].innerHTML = "Table of " + tableOfIndex
        tableOfIndex = tableOfIndex * 2
    }

}

var marginNumber;
var tableRounds = document.querySelectorAll(".table_round");
//If found da cookie
if (document.cookie.split(';').some((item) => item.trim().startsWith('marginNumber='))) {
    marginNumber = parseInt(getCookie("marginNumber"))
    for (i = 0; i < tableRounds.length; i++) {
        tableRounds[i].style.marginTop = (marginNumber) + "px";
        tableRounds[i].style.marginBottom = (marginNumber) + "px";
    }
}
//If not found da cookie
else {
    marginNumber = 30;
    document.cookie = "marginNumber="
}

//Table zoom in/zoom out buttons

function tableZoomOut() {
    marginNumber -= 1;
    for (i = 0; i < tableRounds.length; i++) {
        tableRounds[i].style.marginTop = (marginNumber) + "px";
        tableRounds[i].style.marginBottom = (marginNumber) + "px";
    }
    document.cookie = "marginNumber=" + marginNumber
    zoomButtonDisabler();
}

function tableZoomIn() {
    marginNumber += 1;
    for (i = 0; i < tableRounds.length; i++) {
        tableRounds[i].style.marginTop = (marginNumber) + "px";
        tableRounds[i].style.marginBottom = (marginNumber) + "px";
    }
    document.cookie = "marginNumber=" + marginNumber
    zoomButtonDisabler();
}
var zoomOutButton = document.getElementById("zoomOutButton");
var zoomInButton = document.getElementById("zoomInButton");
function zoomButtonDisabler() {
    if (marginNumber <= 5) {
        holding = false;
        zoomOutButton.disabled = true;
    }
    else {
        zoomOutButton.disabled = false;
    }
    if (marginNumber >= 50) {
        holding = false;
        zoomInButton.disabled = true;
    }
    else {
        zoomInButton.disabled = false;
    }
}
zoomButtonDisabler();
//Check if zoom in/ zoom out butto is held down for x sec
var buttons = [zoomInButton, zoomOutButton]
var lastKeyUpAt = 0;
var canAutoZoom = false;
buttons.forEach(item => {
    item.addEventListener('mousedown', function () {
        // Set key down time to the current time
        var keyDownAt = new Date();
        canAutoZoom = false;
        // Use a timeout with 1000ms (this would be your X variable)
        setTimeout(function () {
            // Compare key down time with key up time
            if (+keyDownAt > +lastKeyUpAt) {
                canAutoZoom = true;// Key has been held down for x seconds
            }
            else {
                canAutoZoom = false;// Key has not been held down for x seconds
            }
        }, 250);
    });
})

buttons.forEach(item => {
    item.addEventListener('mouseup', function () {
        // Set lastKeyUpAt to hold the time the last key up event was fired
        lastKeyUpAt = new Date();
    });
})

//Zoom out button hold
function oGetCursorPosition(zoomOutButton, event) {
    const rect = zoomOutButton.getBoundingClientRect()
    const x = event.clientX - rect.left
    const y = event.clientY - rect.top
    if (!zoomOutButton.disabled && canAutoZoom) {
        tableZoomOut();
    }
}
var omousePosition, oholding;

function oMyInterval() {
    var setIntervalId = setInterval(function () {
        if (!holding) clearInterval(setIntervalId);
        oGetCursorPosition(zoomOutButton, mousePosition);
    }, 100); //set your wait time between consoles in milliseconds here
}
zoomOutButton.addEventListener('mousedown', function () {
    holding = true;
    oMyInterval();
})
zoomOutButton.addEventListener('mouseup', function () {
    holding = false;
    oMyInterval();
})
zoomOutButton.addEventListener('mouseleave', function () {
    holding = false;
})
zoomOutButton.addEventListener('mousemove', function (e) {
    mousePosition = e;
})

//Zoom in button hold
function iGetCursorPosition(zoomInButton, event) {
    const rect = zoomInButton.getBoundingClientRect()
    const x = event.clientX - rect.left
    const y = event.clientY - rect.top
    if (!zoomInButton.disabled && canAutoZoom) {
        tableZoomIn();
    }
}
var imousePosition, iholding;

function iMyInterval() {
    var setIntervalId = setInterval(function () {
        if (!holding) clearInterval(setIntervalId);
        iGetCursorPosition(zoomInButton, mousePosition);
    }, 100); //set your wait time between consoles in milliseconds here
}
zoomInButton.addEventListener('mousedown', function () {
    holding = true;
    iMyInterval();
})
zoomInButton.addEventListener('mouseup', function () {
    holding = false;
    iMyInterval();
})
zoomInButton.addEventListener('mouseleave', function () {
    holding = false;
})
zoomInButton.addEventListener('mousemove', function (e) {
    mousePosition = e;
})

//Controls 
var tableFencer = document.querySelectorAll(".table_round_wrapper");
function makeArray() {
    var tableArray = []
    for (i = 0; i < eleminitaions.length; i++) {
        var currentRounds = eleminitaions[i].querySelectorAll(".table_round_wrapper")
        var columArray = []
        for (j = 0; j < currentRounds.length; j += 2) {
            var array2 = []
            array2.push(currentRounds[j])
            array2.push(currentRounds[j + 1])
            columArray.push(array2)
        }
        tableArray.push(columArray)
    }
    return tableArray
}

//Removes the focus class from every element
function focusClassRemover() {
    var focusedElement = document.querySelectorAll("#call_room .focus")
    for (i = 0; i < focusedElement.length; i++) {
        focusedElement[i].classList.remove("focus")
    }
}

var tableInArray = makeArray();
var index1 = cookieFinder("index1", 0, true)
var index2 = cookieFinder("index2", 0, true)
var index3 = cookieFinder("index3", 0, true)
eleminitaions[index1].classList.add("selected")
tableInArray[index1][index2][index3].classList.add("focus");
tableInArray[index1][index2][index3].scrollIntoView()
document.addEventListener("keyup", function (e) {
    //searchBarClosed is a var. from search.js
    //somethingisOpened is a var. from main.js
    //somethingIsFocused is a var. form main.js
    //Arrowsystem
    if (searchBarClosed && !somethingisOpened && !somethingIsFocused) {
        if (e.key == "ArrowUp") {
            if (index2 > 0) {
                focusClassRemover()
                if (index3 <= 0) {
                    index3 = 1;
                    index2--
                }
                else {
                    index3--
                }
                tableInArray[index1][index2][index3].classList.add("focus");
                tableInArray[index1][index2][index3].scrollIntoView()
            }
            else if (index2 == 0) {
                if (index3 > 0) {
                    if (tableInArray[index1][index2].length > 1) {
                        index3--
                    }
                    focusClassRemover()
                    tableInArray[index1][index2][index3].classList.add("focus");
                    tableInArray[index1][index2][index3].scrollIntoView()
                }
            }
        }
        if (e.key == "ArrowDown") {
            if (index2 < tableInArray[index1].length - 1) {
                focusClassRemover();
                if (index3 >= tableInArray[index1][index2].length - 1) {
                    index3 = 0;
                    index2++
                }
                else {
                    index3++
                }
                tableInArray[index1][index2][index3].classList.add("focus");
                tableInArray[index1][index2][index3].scrollIntoView()
            }
            else if (index2 == tableInArray[index1].length - 1) {
                if (index3 < tableInArray[index1][index2].length - 1) {
                    if (tableInArray[index1][index2][1] != undefined) {
                        index3++
                    }
                    focusClassRemover()
                    tableInArray[index1][index2][index3].classList.add("focus");
                    tableInArray[index1][index2][index3].scrollIntoView()
                }
            }
        }
        if (e.key == "ArrowLeft") {
            if (index1 > 0) {
                focusClassRemover()
                index1--
                if (index1 < firstIndex) {
                    buttonLeft();
                }
                index2 = (index2 * 2) + index3
                index3 = 0
                tableInArray[index1][index2][index3].classList.add("focus");
                tableInArray[index1][index2][index3].scrollIntoView()
            }

        }
        if (e.key == "ArrowRight") {
            if (index1 < tableInArray.length - 1) {
                focusClassRemover()
                index1++
                if (index1 + 1 > secondIndex) {
                    buttonRight();
                }
                index3 = index2 % 2
                index2 = Math.floor(index2 / 2);
                tableInArray[index1][index2][index3].classList.add("focus");
                tableInArray[index1][index2][index3].scrollIntoView()
            }
        }
        eleminitaions[index1].classList.add("selected")
        document.cookie = "index1=" + index1;
        document.cookie = "index2=" + index2;
        document.cookie = "index3=" + index3;
    }
})

