const uploadPanel = document.getElementById("upload_ranking_panel");
const createPanel = document.getElementById("create_ranking_panel");
const chooseRankingWrapper = document.getElementById("choose_ranking_wrapper");
var rankingSearch = document.getElementById("ranking_search");
var rankingCreate = document.getElementById("ranking_create");

// expands and minimizes the Upload Panel
function toggleUploadRankingPanel() {
    uploadPanel.classList.toggle("opened");
    chooseRankingWrapper.classList.toggle("first");
}

// expands and minimizes the Create Panel
function toggleCreateRankingPanel() {
    createPanel.classList.toggle("opened");
    chooseRankingWrapper.classList.toggle("second");
}

function chooseRankingCreate() {
    rankingCreate.classList.toggle("closed");
}

function chooseRankingSearch() {
    uploadPanel.classList.add("state_1")
}


/*


closeUploadPanelButton.addEventListener("mousedown", closeUploadRankingPanel);
closeCreatePanelButton.addEventListener("mousedown", closeCreateRankingPanel);

function closeUploadRankingPanel() {
    uploadPanel.classList.toggle("opened");
    createPanel.classList.toggle("closed");

    closeUploadPanelButton.classList.toggle("hidden");
}

function closeCreateRankingPanel() {
    uploadPanel.classList.toggle("closed");
    createPanel.classList.toggle("opened");

    closeCreatePanelButton.classList.toggle("hidden")
}

function selectRanking(x) {

var toselect = document.getElementsByClassName("selected");
var input = document.getElementById("ranking_id_hidden");

if(toselect.length > 0){

    for (let index = 0; index < toselect.length; index++) {
        toselect[index].classList.remove("selected");
    }

    input.value = "";
    console.log(input.value)

}
else{
    x.classList.add("selected");

    input.value = x.id;

    console.log(input.value)
}
}

function getName(){

console.log("WORKING");

var name = document.getElementsByClassName("selected");
var nameto = document.getElementById("ranking_name_p");

console.log(name[0].children[0].innerHTML);
nameto.innerHTML = name[0].children[0].innerHTML;

} 

*/