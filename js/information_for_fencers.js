//Removes all written in equipment value
function removeEquipmentValues() {

    for (let index = 0; index < 13; index++) {
        var removefrom = document.getElementById("input_" + index);
        removefrom.value = "";
    }
}

var inputs = document.querySelectorAll(".table_row input");
inputs.forEach(item => {
    item.addEventListener("input", function () {
        if(item.value > 5 || item.value < 0 || item.value == "00"){
            item.value = ""
        }
    });
})