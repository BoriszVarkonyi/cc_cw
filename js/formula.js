document.addEventListener("keyup", function(e){
    if(e.shiftKey && e.which == 83) {
        var orangeSaveButton = document.querySelector(".stripe_button.orange")
        orangeSaveButton.click()
    }
})