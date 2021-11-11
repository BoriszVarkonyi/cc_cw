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