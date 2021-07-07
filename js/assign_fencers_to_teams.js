function toggleAssignAutoPanel() {
    var panel = document.getElementById("assign_auto_panel")
    panel.classList.toggle("hidden")
}

var teamAssigmentsInput = document.querySelector("#save_team_assignments input")
var inputInJSON = JSON.parse(teamAssigmentsInput.value)
var unassignedTableNode = document.querySelector("#unselected_team_table tbody")
var assignedTableNode = document.querySelector("#selected_team_table tbody")

//Clears the selected table
function clearAssignedFencersTable() {
    var assignedTableRows = document.querySelectorAll("#selected_team_table tbody tr")
    for (i = 0; i < assignedTableRows.length; i++) {
        var checkBox = assignedTableRows[i].querySelector(".square input")
        //Makes the checkbox unchecked
        checkBox.checked = false;
        unassignedTableNode.insertBefore(assignedTableRows[i], unassignedTableNode.firstElementChild)
    }
}

var selectedTeamName = undefined;

function selectTeam(x) {
    var teamName = x.querySelector("p").innerHTML

    if (teamName == selectedTeamName) {
        clearAssignedFencersTable();
        x.classList.remove("selected")
        selectedTeamName = undefined
    }
    else {
        selectedTeamName = teamName
        //Removes the selected class
        var selections = document.querySelectorAll(".splitscreen_select")

        for (i = 0; i < selections.length; i++) {
            selections[i].classList.remove("selected")
        }

        clearAssignedFencersTable();

        x.classList.add("selected")
        //Goes through the array, gets the elements by id
        for (i = 0; i < inputInJSON[teamName].length; i++) {
            var rowNode = document.getElementById(inputInJSON[teamName][i]).parentNode.parentNode
            //Makes the checkbox checked
            document.getElementById(inputInJSON[teamName][i]).checked = true
            assignedTableNode.insertBefore(rowNode, assignedTableNode.firstElementChild)
        }
    }
}

function checkFencer(x) {
    var clickedNode = x.parentNode.parentNode
    var clickedRowId = clickedNode.id

    if (x.checked) {
        assignedTableNode.insertBefore(clickedNode, assignedTableNode.firstElementChild)
        //Pushes to the array
        inputInJSON[selectedTeamName].push(clickedRowId)
    }
    else {
        unassignedTableNode.insertBefore(clickedNode, unassignedTableNode.firstElementChild)
        //Removes the id from the array
        var index = inputInJSON[selectedTeamName].indexOf(clickedRowId)
    }
    console.log(inputInJSON[selectedTeamName])
}
