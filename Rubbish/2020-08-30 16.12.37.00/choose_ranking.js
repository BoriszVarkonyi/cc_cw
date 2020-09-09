const uploadPanel = document.getElementById("upload_ranking_panel");
const createPanel = document.getElementById("create_ranking_panel");
const chooseRankingWrapper = document.getElementById("choose_ranking_wrapper");
const closeUploadPanelButton = document.getElementById("close_upload_ranking_panel");
const closeCreatePanelButton = document.getElementById("close_create_ranking_panel");
const uploadPanelTitle = document.getElementById("upload_panel_title");
const uploadPanelForm = document.getElementById("upload_excel_form");
var rankingSearch = document.getElementById("ranking_search");

// expands and minimizes the Upload Panel
function toggleUploadRankingPanel() {
    uploadPanel.classList.toggle("opened");
    createPanel.classList.toggle("closed");
    chooseRankingWrapper.style.flexDirection = "row";

    uploadPanel.ontransitionend = () => {
        placeCloseButtonU();
    };

    if (uploadPanel.hasAttribute("onclick")) {
        uploadPanel.removeAttribute("onclick")
        console.log("kinyitom");
        closeUploadPanelButton.classList.remove("hidden");

        uploadPanelForm.classList.toggle("hidden");

        chooseRankingWrapper.style.flexDirection = "row";

        uploadPanelTitle.innerHTML = "";


    } else {
        console.log("bezárom");
        uploadPanel.setAttribute("onclick", "toggleUploadRankingPanel()");
        closeUploadPanelButton.classList.add("hidden");
        uploadPanelForm.classList.toggle("hidden");

        chooseRankingWrapper.style.flexDirection = "row";

        uploadPanelTitle.innerHTML = "";
        uploadPanelTitle.innerHTML = "Upload Ranking";

        rankingSearch.classList.add("closed");
    }
}

// expands and minimizes the Create Panel
function toggleCreateRankingPanel() {
    uploadPanel.classList.toggle("closed");
    createPanel.classList.toggle("opened");
    chooseRankingWrapper.style.flexDirection = "row-reverse";

    createPanel.ontransitionend = () => {
        placeCloseButtonC();
    };

    if (createPanel.hasAttribute("onclick")) {
        createPanel.removeAttribute("onclick")
        console.log("van");
        closeCreatePanelButton.classList.remove("hidden");

        chooseRankingWrapper.style.flexDirection = "row-reverse";

    } else {
        console.log("nincs");
        createPanel.setAttribute("onclick", "toggleCreateRankingPanel()");
        closeCreatePanelButton.classList.add("hidden");

        chooseRankingWrapper.style.flexDirection = "row";
    }
}

// places the Close button for the Upload Panel
function placeCloseButtonU() {
    
    const  uploadPanelPos = uploadPanel.getBoundingClientRect();
    var upr = uploadPanelPos.right - 50;
    var upt = uploadPanelPos.top - 40;

    closeUploadPanelButton.style.left = upr;
    closeUploadPanelButton.style.top = upt;
}

// places the Close button for the Create Panel
function placeCloseButtonC() {
    
    const  createPanelPos = createPanel.getBoundingClientRect();
    var upr = createPanelPos.right - 50;
    var upt = createPanelPos.top - 40;

    closeCreatePanelButton.style.left = upr;
    closeCreatePanelButton.style.top = upt;
}

function chooseRankingSearch() {
    rankingSearch.classList.toggle("closed");
}