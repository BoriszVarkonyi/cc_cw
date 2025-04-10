function toggleResetTable() {
    var panel = document.getElementById("reset_table_panel");

    panel.classList.toggle("hidden");
}

function selectRound(x) {
    console.log("fe");
}


var callRooms = document.querySelectorAll(".call_room")
var firstIndex = 0;
var secondIndex;
var eleminitaions = document.querySelectorAll(".elimination")
var btLeft = document.getElementById("buttonLeft")
var btRight = document.getElementById("buttonRight")
var over16 = false
var firstRight = false


if (eleminitaions.length > 4) {
    secondIndex = 4;
}
else {
    secondIndex = eleminitaions.length
}


//Gets window size
window.addEventListener("resize", windowSize);
window.addEventListener("DOMContentLoaded", windowSize);
var vw;
//Chagnes the shown table numbers by the window size
function windowSize() {
    if (document.querySelector(".call_room") != null) {
        vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0)
        if (vw > 1600 && eleminitaions.length >= 4) {
            if (!over16) {
                secondIndex = firstIndex + 4;
            }
            else{
                firstIndex = secondIndex -4;
            }
            if (!firstRight) {
                for (i = 0; i < eleminitaions.length; i++) {
                    eleminitaions[i].classList.add("hidden")
                }
                for (i = firstIndex; i < secondIndex; i++) {
                    eleminitaions[i].classList.remove("hidden")

                }
            }
        }
        else if (vw > 1100 && vw < 1600 && eleminitaions.length >= 3) {
            if (!over16) {
                secondIndex = firstIndex + 3;
            }
            else{
                firstIndex = secondIndex -3;
            }
            if (!firstRight) {
                for (i = 0; i < eleminitaions.length; i++) {
                    eleminitaions[i].classList.add("hidden")
                }
                for (i = firstIndex; i < secondIndex; i++) {
                    eleminitaions[i].classList.remove("hidden")

                }
            }
        }
        else if (vw > 700 && vw < 1100 && eleminitaions.length >= 2) {
            if (!over16) {
                secondIndex = firstIndex + 2;
            }
            else{
                firstIndex = secondIndex -2;
            }
            if (!firstRight) {
                for (i = 0; i < eleminitaions.length; i++) {
                    eleminitaions[i].classList.add("hidden")
                }
                for (i = firstIndex; i < secondIndex; i++) {
                    eleminitaions[i].classList.remove("hidden")

                }
            }
        }
        else if (vw < 700) {
            if (!over16) {
                secondIndex = firstIndex + 1;
            }
            else{
                firstIndex = secondIndex -1;
            }
            if (!firstRight) {
                for (i = 0; i < eleminitaions.length; i++) {
                    eleminitaions[i].classList.add("hidden")
                }
                for (i = firstIndex; i < secondIndex; i++) {
                    eleminitaions[i].classList.remove("hidden")

                }
            }
        }
        var shownEliminations = document.querySelectorAll(".elimination:not(.hidden)")
        if (shownEliminations.length == eleminitaions.length && !firstRight) {
            btRight.classList.add("disabled")
        }
    }
}

//Hides all the eliminations
for (i = 0; i < eleminitaions.length; i++) {
    eleminitaions[i].classList.add("hidden")
}

if (eleminitaions.length > 0) {
    for (i = firstIndex; i < secondIndex; i++) {
        eleminitaions[i].classList.remove("hidden")

    }
}

function disabler() {
    if (firstIndex == 0 && !firstRight) {
        btLeft.classList.add("disabled")
    }
    if (document.querySelectorAll(".call_room:not(.hidden)").length == 8) {
        btRight.classList.add("disabled")
    }
}
disabler();

//Helps to search throught tables
function searchByMiddleTable(tableToSearchFor) {
    var index;

    for (i = 0; i < callRooms.length; i++) {
        var elimination = callRooms[i].querySelectorAll(".elimination_label")[1]
        if (elimination != undefined) {
            if (tableToSearchFor == elimination.innerHTML) {
                index = i;
            }
        }
    }
    return index;
}


function searchBySideTables(leftside, rightSide) {
    var index;
    for (i = 0; i < callRooms.length; i++) {
        var eliminationLeft = callRooms[i].querySelectorAll(".elimination_label")[0]
        var eliminationRight = callRooms[i].querySelectorAll(".elimination_label")[2]
        if (eliminationRight == undefined) {
            continue;
        }

        if (leftside == eliminationLeft.innerHTML && rightSide == eliminationRight.innerHTML) {
            index = i;
        }

    }
    return index;
}


function buttonLeft() {
    if (!over16) {
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
    }
    else {
        btLeft.classList.remove("disabled")
        btRight.classList.remove("disabled")
        var currentCallRoom = document.querySelectorAll(".call_room:not(.hidden)")
        if (currentCallRoom[0].firstElementChild.nextElementSibling.firstElementChild.innerHTML == "1-16") {
            for (i = 0; i < callRooms.length; i++) {
                callRooms[i].classList.add("hidden")
            }
            callRooms[searchByMiddleTable("1-16") - 1].classList.remove("hidden")
            //Hides all the eliminations
            for (i = 0; i < eleminitaions.length; i++) {
                eleminitaions[i].classList.add("hidden")
            }
            for (i = firstIndex; i < secondIndex; i++) {
                eleminitaions[i].classList.remove("hidden")
            }
            over16 = false
            firstRight = false
        }
        else {
            currentCallRoom = document.querySelectorAll(".call_room:not(.hidden)")

            for (i = 0; i < callRooms.length; i++) {
                callRooms[i].classList.add("hidden")
            }
            for (j = 0; j < currentCallRoom.length; j += 2) {

                var rightTable = currentCallRoom[j].firstElementChild.nextElementSibling.firstElementChild.innerHTML
                var leftTable = currentCallRoom[j + 1].firstElementChild.nextElementSibling.firstElementChild.innerHTML
                callRooms[searchBySideTables(leftTable, rightTable)].classList.remove("hidden")

            }
        }
    }
    disabler();
}

function buttonRight() {
    if (eleminitaions[secondIndex - 1].querySelectorAll(".table_round_wrapper").length > 8) {
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
    }
    else {
        btLeft.classList.remove("disabled")
        btRight.classList.remove("disabled")
        over16 = true;
        if (!firstRight) {
            for (i = 0; i < eleminitaions.length; i++) {
                eleminitaions[i].classList.remove("hidden")
            }
            for (i = 0; i < callRooms.length; i++) {
                callRooms[i].classList.add("hidden")
            }
            callRooms[searchByMiddleTable("1-16")].classList.remove("hidden")
            firstRight = true;
        }
        else {
            var currentCallRoom = document.querySelectorAll(".call_room:not(.hidden)")

            for (i = 0; i < callRooms.length; i++) {
                callRooms[i].classList.add("hidden")
            }
            for (j = 0; j < currentCallRoom.length; j++) {

                var leftTable = currentCallRoom[j].firstElementChild.querySelector("div")
                var rightTable = currentCallRoom[j].lastElementChild.querySelector("div")
                callRooms[searchByMiddleTable(leftTable.innerHTML)].classList.remove("hidden")
                callRooms[searchByMiddleTable(rightTable.innerHTML)].classList.remove("hidden")

            }
        }
    }
    disabler();
}
