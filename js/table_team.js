function toggleResetTable() {
    var panel = document.getElementById("reset_table_panel");

    panel.classList.toggle("hidden");
}

function selectRound(x) {
    console.log("fe");
}


var callRooms = document.querySelectorAll(".call_room")

function searchByMiddleTable(tableToSearchFor) {

    for (i = 0; i < callRooms.length; i++) {
        var elimination = callRooms[i].querySelectorAll(".elimination_label")[1]
        console.log(elimination.innerHTML)
    }

}

searchByMiddleTable("1-8");

function buttonLeft() {

}

function buttonRight() {

}