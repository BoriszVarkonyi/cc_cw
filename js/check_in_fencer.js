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
})
  