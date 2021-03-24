function toggleOtherApps(x) {
    var otherApps = x.parentNode;
    otherApps.classList.toggle("opened");
}
var form = document.querySelector(".overlay_panel_form")
var inputs = document.querySelectorAll(".username_input, .password_input");
var loginButton = document.querySelector(".login_button");
var opitons = form.querySelectorAll(".option_container > input");
var valid1 = false, valid2 = false;
loginButton.classList.add("disabled")
function loginFormValidation() {
    for (i = 0; i < inputs.length; i++) {
        if (inputs[i].value == "") {
            //If it finds an empty input, then it disable the "Save" button.
            valid1 = false;
            break;
        }
        else {
            //If everything has a value then it enable the "Save" Button. The user can save.
            valid1 = true;
        }
    }
    for (i = 0; i < opitons.length; i++) {
        if (opitons[i].checked) {
            valid2 = true;
            break;
        }
        else {
            valid2 = false;
        }
    }
    if (valid1 && valid2) {
        loginButton.classList.remove("disabled")
    }
    else {
        loginButton.classList.add("disabled")
    }
}
form.addEventListener("input", loginFormValidation)
function errorChecker(x) {
    if (x.value == "") {
        x.previousElementSibling.classList.add("error")
    }
    else {
        x.previousElementSibling.classList.remove("error")
    }
}

document.documentElement.setAttribute('data-content-theme', 'vanilla');