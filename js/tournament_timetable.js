var setPanel = document.getElementById("tournament_timetable");
var addPanel = document.getElementById("tournament_weapon_control");
var table = document.getElementById("wc_phases_table");

function toggleWcPhase() {
    setPanel.classList.toggle("hidden");
    addPanel.classList.toggle("hidden");
    table.classList.toggle("hidden");
}