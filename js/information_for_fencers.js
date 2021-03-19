//Removes all written in equipment value
function removeEquipmentValues() {

    for (let index = 0; index < 13; index++) {
        var removefrom = document.getElementById("input_" + index);
        removefrom.value = "";
    }
}