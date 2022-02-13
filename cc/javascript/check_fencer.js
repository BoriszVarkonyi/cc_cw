
document.addEventListener("keyup", function (e) {
  //somethingIsFocused is a var. form main.js
  if (!somethingIsFocused) {
    //Saves to Shift+S
    if (e.shiftKey && e.which == 83) {
      var orangeSaveButton = document.querySelector(".stripe_button.orange")
      orangeSaveButton.click()
    }
    //Prints to Shift+P
    if (e.shiftKey && e.which == 80) {
      var stripeButton = document.querySelector(".stripe_button")
      stripeButton.click()
    }
  }
});

var panelView = document.querySelector(".wrapper");
var printView = document.querySelector(".paper_wrapper");
var panelViewButton = document.getElementById("panelViewButton");
var printViewButton = document.getElementById("printViewButton")

function panelView() {
  panelView.style.display = "flex";
  printView.style.display = "none";
}

function printView() {
  panelView.style.display = "none";
  printView.style.display = "flex";
}
panelViewButton.disabled = true;
function viewButton(x) {
  panelView.classList.toggle('hidden');
  printView.classList.toggle('hidden');
  var clickedButton = x
  if (clickedButton.id == "panelViewButton") {
    clickedButton.disabled = true;
    printViewButton.disabled = false;
  }
  else {
    clickedButton.disabled = true;
    panelViewButton.disabled = false;
  }
}

function printPage() {
  window.print();
}
