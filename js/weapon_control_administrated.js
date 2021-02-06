//var wcStatistics = document.querySelector(".stripe_button.blue");
//var sendMessangeButton = document.getElementById("sendMessageButton");
var checkInButton = document.getElementById("checkInButton");
var checkOutButton = document.getElementById("checkOutButton");
var addwcButton = document.getElementById("addWcButton");
var editWcButton = document.getElementById("editWcButton");
//Hides all the button
function hideAllButton(){
    checkInButton.style.display = "none";
    checkOutButton.style.display = "none";
    addwcButton.style.display = "none";
    editWcButton.style.display = "none";
}
hideAllButton();
//Shows the correct button
function buttonShower(x){
    var selectedItem = x
    var className = selectedItem.classList[1]
    switch(className){
        case "cheked_out" :
            hideAllButton();
        break;
        case "not_cheked_out" :
            hideAllButton();
            editWcButton.style.display = "";
            checkOutButton.style.display = "";
        break;
        case "not_ready" :
            hideAllButton();
            addwcButton.style.display = "";
        break;
        case "red" :
            hideAllButton();
            checkInButton.style.display = "";
        break;
    }
}
