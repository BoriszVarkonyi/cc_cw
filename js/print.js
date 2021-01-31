var paperWrapper = document.querySelector(".paper_wrapper");
var zoomNumber = 0.5;

function zoomOut(){
    zoomNumber = zoomNumber - 0.1
    paperWrapper.style.transform = "scale(" + zoomNumber + ")";
    zoomButtonDisabler();
}
function zoomIn(){
    zoomNumber = zoomNumber + 0.1
    paperWrapper.style.transform = "scale(" + zoomNumber + ")";
    zoomButtonDisabler();
}

var zoomOutButton = document.getElementById("zoomOutButton")
var zoomInButton = document.getElementById("zoomInButton")

function zoomButtonDisabler(){
    if(paperWrapper.style.transform == "scale(0.1)"){
        zoomOutButton.disabled = true;
    }
    else{
        zoomOutButton.disabled = false;
    }
    if(paperWrapper.style.transform == "scale(2)"){
        zoomInButton.disabled = true;
    }
    else{
        zoomInButton.disabled = false;
    }
}

function printPage() {
    window.print();
}