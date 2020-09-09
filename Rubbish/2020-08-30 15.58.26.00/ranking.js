var conf = document.getElementById("confirmation");
var infoPanel = document.getElementById("ranking_info_panel");
var addFencerPanel = document.getElementById("add_fencer_panel");
var rankingSearch = document.getElementById("ranking_search");

function closeConf() {

    conf.classList.add("hidden");

}

function toggleRankingInfo() {

    infoPanel.classList.toggle("hidden");

}

function toggleAddFencer() {

    addFencerPanel.classList.toggle("hidden");

}