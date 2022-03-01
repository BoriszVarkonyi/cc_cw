var wctable = document.querySelector("#page_content_panel_main tbody")
var addWeaponControlButton = document.getElementById("wcButton")
var sendMessageButton = document.getElementById("add_weapon_control_form")
console.log()
var isselected = false;
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
        isselected = true
    }
    else {
        addWeaponControlButton.disabled = true;
        sendMessageButton.disabled = true;
        addWeaponControlButton.classList.add("disabled")
        sendMessageButton.classList.add("disabled")
        isselected = false
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
        if (e.shiftKey && e.which == 87) {
            var weaponControlStatisticsButton = document.getElementById("weaponControlStatisticsBt")
            weaponControlStatisticsButton.click()
        }
        if (e.shiftKey && e.which == 80) {
            var printWeaponControlButton = document.getElementById("printWeaponControlBt")
            printWeaponControlButton.click()
        }
        if (e.shiftKey && e.which == 66) {
            var barCodeInput = document.querySelector("#barcode_form input")
            barCodeInput.focus()
        }
        if (isselected) {
            if (e.shiftKey && e.which == 65) {
                var addWeaponControlButton = document.getElementById("wcButton")
                addWeaponControlButton.click()
            }
        }
    }
})