var addFencerPanel = document.getElementById("add_fencer_panel");

function toggleAddFencerPanel() {
    addFencerPanel.classList.remove("hidden");
}

function setNation(x){
    var field = document.getElementById("inputs");
    field.value = x.innerHTML;
}
