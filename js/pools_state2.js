document.addEventListener("keyup", function(e){
    //Prints to Shift+P
    if(e.shiftKey && e.which == 80) {
    var stripeButton = document.getElementById("printButton")
    stripeButton.click()
  }
  })