var wctable = document.querySelector("#page_content_panel_main tbody")
var addWeaponControlButton = document.getElementById("wcButton")
var sendMessageButton = document.getElementById("sendMessageButton")
addWeaponControlButton.disabled = true;
sendMessageButton.disabled = true;
addWeaponControlButton.classList.add("disabled")
sendMessageButton.classList.add("disabled")
function buttonDisabler() {
    var selectedItem = document.querySelector("#page_content_panel_main tbody .selected")
    if (selectedItem !== null) {
        addWeaponControlButton.disabled = false;
        sendMessageButton.disabled = false;
        addWeaponControlButton.classList.remove("disabled")
        sendMessageButton.classList.remove("disabled")
    }
    else {
        addWeaponControlButton.disabled = true;
        sendMessageButton.disabled = true;
        addWeaponControlButton.classList.add("disabled")
        sendMessageButton.classList.add("disabled")
    }
}

var wcRows = document.querySelectorAll("#page_content_panel_main tbody tr")
//Event listener to class change
function callback(mutationsList, observer) {
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
            buttonDisabler()
        }
    })
}

const mutationObserver2 = new MutationObserver(callback)
for (i = 0; i < wcRows.length; i++) {
    mutationObserver2.observe(wcRows[i], { attributes: true })
}

wctable.addEventListener("click", buttonDisabler)

document.addEventListener("keyup", function (e) {
    //somethingIsFocused is a var. from main.js
    if (!somethingIsFocused) {
        if (e.shiftKey && e.which == 80) {
            var printRegistrationButton = document.getElementById("printRegistrationBt")
            printRegistrationButton.click()
        }
        if (isselected) {
            if (e.shiftKey && e.which == 68) {
                var deleteFencerButton = document.getElementById("delete_fencer_button")
                deleteFencerButton.click()
            }
        }
    }
})