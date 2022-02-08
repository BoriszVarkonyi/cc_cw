document.addEventListener("keyup", function (e) {
    //somethingIsFocused is a var. from main.js
    if (!somethingIsFocused) {
      //Prints to Shift+P
      if (e.shiftKey && e.which == 80) {
        var stripeButton = document.getElementById("printButton")
        stripeButton.click()
      }
    }
  })