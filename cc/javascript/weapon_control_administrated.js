//var wcStatistics = document.querySelector(".stripe_button.blue");
//var sendMessangeButton = document.getElementById("sendMessageButton");
var checkInButton = document.getElementById("check_in_button");
var checkOutButton = document.getElementById("check_out_button");
var addwcButton = document.getElementById("add_wc_button");
var editWcButton = document.getElementById("edit_wc_button");
//Hides all the button
function hideAllButton() {
    checkInButton.style.display = "none";
    checkOutButton.style.display = "none";
    addwcButton.style.display = "none";
    editWcButton.style.display = "none";
}
hideAllButton();
//Shows the correct button
function buttonShower(x) {
    var selectedItem = x
    var className = selectedItem.classList[0]
    console.log(className)
    switch (className) {
        case "checked_out":
            hideAllButton();
            break;
        case "not_checked_out":
            hideAllButton();
            editWcButton.style.display = "";
            checkOutButton.style.display = "";
            break;
        case "not_ready":
            hideAllButton();
            addwcButton.style.display = "";
            break;
        case "red":
            hideAllButton();
            checkInButton.style.display = "";
            break;
    }
}
