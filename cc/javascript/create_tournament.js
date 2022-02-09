//Form validation
var form = document.getElementById("create_tournament")
var titleInput = document.querySelector(".title_input");
var createButton = document.querySelector(".stripe_button.primary");
createButton.classList.add("disabled")
function crtTformValidation() {
    if (titleInput.value == "") {
        createButton.classList.add("disabled")
    }
    else {
        createButton.classList.remove("disabled")
    }
}
form.addEventListener("input", crtTformValidation)
function errorChecker(x) {
    if (x.value == "") {
        x.previousElementSibling.classList.add("error")
    }
    else {
        x.previousElementSibling.classList.remove("error")
    }
}
