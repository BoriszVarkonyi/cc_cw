function printPage() {
    window.print();
}
document.addEventListener("keyup", function(e){
    //Prints to Shift+P
    if(e.shiftKey && e.which == 80) {
        printPage();
    }
})

var poolPrintWrapper = document.getElementById("pool_print_wrapper");
var zoomNumber = 0.5;

function zoomOut(){
    zoomNumber = zoomNumber - 0.1
    poolPrintWrapper.style.transform = "scale(" + zoomNumber + ")";
    zoomButtonDisabler();
}
function zoomIn(){
    zoomNumber = zoomNumber + 0.1
    poolPrintWrapper.style.transform = "scale(" + zoomNumber + ")";
    zoomButtonDisabler();
}

var zoomOutButton = document.getElementById("zoomOutButton")
var zoomInButton = document.getElementById("zoomInButton")

function zoomButtonDisabler(){
    if(poolPrintWrapper.style.transform == "scale(0.1)"){
        zoomOutButton.disabled = true;
    }
    else{
        zoomOutButton.disabled = false;
    }
    if(poolPrintWrapper.style.transform == "scale(2)"){
        zoomInButton.disabled = true;
    }
    else{
        zoomInButton.disabled = false;
    }
}

