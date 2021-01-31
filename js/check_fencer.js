
document.addEventListener("keyup", function(e){
    //Saves to Shift+S
    if(e.shiftKey && e.which == 83) {
      var orangeSaveButton = document.querySelector(".stripe_button.orange")
      orangeSaveButton.click()
    }
    //Prints to Shift+P
    if(e.shiftKey && e.which == 80) {
    var stripeButton = document.querySelector(".stripe_button")
    stripeButton.click()
     }
});

var panelView = document.querySelector(".wrapper");
var printView = document.querySelector(".paper_wrapper");

function panelView() {
  panelView.style.display = "flex";
  printView.style.display = "none";
}

function printView() {
  panelView.style.display = "none";
  printView.style.display = "flex";
}