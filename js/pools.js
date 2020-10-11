function refPisTimePanel() {
    var panel = document.getElementById("ref_pis_time_panel");
    panel.classList.toggle("hidden");
}

function poolConfigToggle(x) {
    var clickedButton = x;
    var pool = clickedButton.parentNode.parentNode;
    var configPanel = pool.lastElementChild;

    configPanel.classList.toggle("hidden")
}

function poolConfigClose(x) {
    var clickedButton = x;
    var panel = clickedButton.parentNode;

    panel.classList.toggle("hidden")
}

function disqualifyToggle() {
    var panel = document.getElementById("disqualify_panel");
    panel.classList.toggle("hidden");
}