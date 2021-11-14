function toggleResetTable() {
    var panel = document.getElementById("reset_table_panel");

    panel.classList.toggle("hidden");
}

function selectRound(x) {
    console.log("fe");
}


var callRooms = document.querySelectorAll(".call_room")
var firstIndex = 0;
var secondIndex = 1;
var eleminitaions = document.querySelectorAll(".elimination")
var btLeft = document.getElementById("buttonLeft")
var btRight = document.getElementById("buttonRight")

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
    if (firstIndex == 0) {
        btLeft.classList.add("disabled")
    }
}


//Helps to search throught tables
function searchByMiddleTable(tableToSearchFor) {
    var index;

    for (i = 0; i < callRooms.length; i++) {
        var elimination = callRooms[i].querySelectorAll(".elimination_label")[1]
        if (tableToSearchFor == elimination.innerHTML) {
            index = i;
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

function buttonRight() {
    if (eleminitaions[secondIndex - 1].querySelectorAll(".table_round_wrapper").length  > 8) {
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
    else{
        for (i = 0; i < eleminitaions.length; i++) {
            eleminitaions[i].classList.remove("hidden")
        }
        for(i=0; i<callRooms.length; i++){
            callRooms[i].classList.add("hidden")
        }
        callRooms[searchByMiddleTable("1-16")].classList.remove("hidden")
    }
}