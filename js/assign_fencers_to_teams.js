function toggleAssignAutoPanel() {
    var panel = document.getElementById("assign_auto_panel")
    panel.classList.toggle("hidden")
}

var teamAssigmentsInput = document.querySelector("#save_team_assignments input")
var inputInJSON = JSON.parse(teamAssigmentsInput.value)
//Clears the selected table
function clearAssignedFencersTable() {
    var assignedTableRows = document.querySelectorAll("#selected_team_table tbody tr")
    var unassignedTableNode = document.querySelector("#unselected_team_table tbody")
    for (i = 0; i < assignedTableRows.length; i++) {
        var checkBox = assignedTableRows[i].querySelector(".square input")
        //Makes the checkbox unchecked
        checkBox.checked = false;
        unassignedTableNode.insertBefore(assignedTableRows[i], unassignedTableNode.firstElementChild)
    }
}

function selectTeam(x) {
    var teamName = x.querySelector("p").innerHTML
    var tbodyNode = document.querySelector("#selected_team_table tbody")
    clearAssignedFencersTable();
    //Goes through the array, gets the elements by id
    for (i = 0; i < inputInJSON[teamName].length; i++) {
        var rowNode = document.getElementById(inputInJSON[teamName][i]).parentNode.parentNode
        //Makes the checkbox checked
        document.getElementById(inputInJSON[teamName][i]).checked = true
        tbodyNode.insertBefore(rowNode, tbodyNode.firstElementChild)
    }
}
