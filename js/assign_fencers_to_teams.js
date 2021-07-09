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
        assignedTableRows[i].remove();
    }
}

var selectedTeamName = undefined;

function selectTeam(x) {
    var teamName = x.querySelector("p").innerHTML
    var squares = document.querySelectorAll(".square")
    clearAssignedFencersTable();
    if (teamName == selectedTeamName) {
        x.classList.remove("selected")
        selectedTeamName = undefined
        //Hides the check boxes
        for (i = 0; i < squares.length; i++) {
            squares[i].classList.add("hidden")
        }
    }
    else {
        //Shows the check boxes
        for (i = 0; i < squares.length; i++) {
            squares[i].classList.remove("hidden")
        }
        selectedTeamName = teamName
        //Removes the selected class
        var selections = document.querySelectorAll(".splitscreen_select")
        for (i = 0; i < selections.length; i++) {
            selections[i].classList.remove("selected")
        }
        x.classList.add("selected")
        //Goes through the array, gets the elements by id
        if (inputInJSON[teamName].length > 0) {
            for (i = 0; i < inputInJSON[teamName].length; i++) {
                //Makes the row
                var rowNode = document.createElement("TR")
                rowNode.id = "f_" + inputInJSON[teamName][i][0];
                rowNode.innerHTML = '<td><p>' + inputInJSON[teamName][i][1] + '</p></td><td><p>' + inputInJSON[teamName][i][2] + '</p></td><td><p>' + inputInJSON[teamName][i][3] + '</p></td><td class="square"><input onclick="checkFencer(this)" type="checkbox" checked="true" name="emberek" id=' + inputInJSON[teamName][i][0] + '><label for=' + inputInJSON[teamName][i][0] + '></label></td>'
                //Makes the checkbox checked
                assignedTableNode.insertBefore(rowNode, assignedTableNode.firstElementChild)
            }
        }
        else{
            var rowNode = document.createElement("TR")
            rowNode.id = "placeholder";
            rowNode.innerHTML = ' <td colspan="4"><p>No Fencers selected yet</p></td>'
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
    var fencerName = clickedNode.querySelector("td:nth-of-type(1) p").innerHTML
    var fencerNat = clickedNode.querySelector("td:nth-of-type(2) p").innerHTML
    var fencerClub = clickedNode.querySelector("td:nth-of-type(3) p").innerHTML;
    var dataArray = [clickedRowId, fencerName, fencerNat, fencerClub];

    if (x.checked) {
        assignedTableNode.insertBefore(clickedNode, assignedTableNode.firstElementChild)
        //Pushes to the array
        inputInJSON[selectedTeamName].push(dataArray)
        statusUpdater(selectedTeamName)
        updateJSON();
        //Looks for the placeholder. Deletes if its there
        var placeholder = document.getElementById("placeholder")
        if(placeholder != null){
            placeholder.remove();
        }
    }
    else {
        unassignedTableNode.insertBefore(clickedNode, unassignedTableNode.firstElementChild)
        //Removes the id from the array
        var index = indexFinder(dataArray)
        inputInJSON[selectedTeamName].splice(index, 1)
        statusUpdater(selectedTeamName)
        updateJSON();
        if(document.querySelectorAll("#selected_team_table tr").length < 2){
            var rowNode = document.createElement("TR")
            rowNode.id = "placeholder";
            rowNode.innerHTML = ' <td colspan="4"><p>No Fencers selected yet</p></td>'
            assignedTableNode.insertBefore(rowNode, assignedTableNode.firstElementChild)   
        }
    }
}

function statusUpdater(currentTeamName) {
    //Gets the right status
    var selections = document.querySelectorAll(".splitscreen_section:not( .header) .splitscreen_select > p")
    var unselectedNumber = document.getElementById("unselected_number")
    //Updates the unselected number
    unselectedNumber.innerHTML = document.querySelectorAll("#unselected_team_table tr").length
    var index;
    for (i = 0; i < selections.length; i++) {
        if (selections[i].innerHTML == currentTeamName) {
            index = (i + 1);
            break;
        }
    }

    var fencerNumber = document.querySelector(".splitscreen_section:not( .header) .splitscreen_select:nth-of-type(" + index + ") > div > p")
    var statusDiv = document.querySelector(".splitscreen_section:not( .header) .splitscreen_select:nth-of-type(" + index + ") > div")
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

function updateJSON() {
    teamAssigmentsInput.value = JSON.stringify(inputInJSON)
    inputInJSON = JSON.parse(teamAssigmentsInput.value)
}
