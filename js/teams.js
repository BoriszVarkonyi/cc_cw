function toggleAddTeamPanel() {
    var panel = document.getElementById("add_team_panel");
    panel.classList.toggle("hidden");
}

document.addEventListener("keyup", function (e) {
    //somethingisOpened is a var. from main.js
    //somethingIsFocused is a var. from main.js
    if (!somethingisOpened && !somethingIsFocused) {
        if (e.shiftKey && e.which == 73) {
            var importTeamsXMLButton = document.getElementById("import_teams_XML_bt")
            importTeamsXMLButton.click();
        }
        if (e.shiftKey && e.which == 82) {
            var removeTeamButton = document.getElementById("remove_team_bt")
            removeTeamButton.click();
        }
        if (e.shiftKey && e.which == 65) {
            var addTeamButton = document.getElementById("add_team_bt")
            addTeamButton.click();
        }
        if (e.shiftKey && e.which == 84) {
            var assignFencersToTeamsButton = document.getElementById("assign_fencers_to_teams_bt")
            assignFencersToTeamsButton.click();
        }
        if (e.shiftKey && e.which == 79) {
            var teamsOrderReportsButton = document.getElementById("teams_order_reports_bt")
            teamsOrderReportsButton.click();
        }
    }
})