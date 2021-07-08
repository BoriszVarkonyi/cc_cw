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
    clearAssignedFencersTable();
    if (teamName == selectedTeamName) {
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

function indexFinder(idToSearchFor) {
    for (i = 0; i < inputInJSON[selectedTeamName].length; i++) {
        if (inputInJSON[selectedTeamName][i] === idToSearchFor) {
            return i;
        }
    }
}

function checkFencer(x) {
    var clickedNode = x.parentNode.parentNode
    var clickedRowId = clickedNode.querySelector(".square input").id

    if (x.checked) {
        assignedTableNode.insertBefore(clickedNode, assignedTableNode.firstElementChild)
        //Pushes to the array
        inputInJSON[selectedTeamName].push(clickedRowId)
        statusUpdater(selectedTeamName)
        updateJSON();
    }
    else {
        unassignedTableNode.insertBefore(clickedNode, unassignedTableNode.firstElementChild)
        //Removes the id from the array
        var index = indexFinder(clickedRowId)
        inputInJSON[selectedTeamName].splice(index, 1)
        statusUpdater(selectedTeamName)
        updateJSON();
    }
}

function statusUpdater(currentTeamName) {
    //Gets the right status
    var selections = document.querySelectorAll(".splitscreen_select > p")
    var index;
    for (i = 0; i < selections.length; i++) {
        if (selections[i].innerHTML == currentTeamName) {
            index = i;
            break;
        }
    }

    var fencerNumber = document.querySelector(".splitscreen_section .splitscreen_select:nth-of-type(" + index + ") > div > p")
    var statusDiv = document.querySelector(".splitscreen_section .splitscreen_select:nth-of-type(" + index + ") > div")
    //Updates the number
    fencerNumber.innerHTML = inputInJSON[selectedTeamName].length;
    //Handles the status color
    if (fencerNumber.innerHTML < 5 && fencerNumber.innerHTML > 2) {
        statusDiv.classList.add("green")
        statusDiv.classList.remove("red")
    }
    else {
        statusDiv.classList.remove("green")
        statusDiv.classList.add("red")
    }
}

function updateJSON(){
    teamAssigmentsInput.value = JSON.stringify(inputInJSON)
    inputInJSON = JSON.parse(teamAssigmentsInput.value)
    console.log(teamAssigmentsInput.value)
}
