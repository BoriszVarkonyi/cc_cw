function drawPositions() {

    var saveButton = document.getElementById("save_positions_button");
    var drawButton = document.getElementById("draw_positions_button");

    saveButton.classList.toggle("hidden");
    drawButton.classList.toggle("inactive");

    var teamInput = document.querySelector(".positions_wrapper input")
    var inputInJSON = JSON.parse(teamInput.value)
    var wrapperInput = document.querySelector(".positions_wrapper input")



    for (i = 0; i < Object.keys(inputInJSON[0]).length; i++) {
        if (Object.keys(inputInJSON[0][Object.keys(inputInJSON[0])[i]])[0] == "" || Object.keys(inputInJSON[0][Object.keys(inputInJSON[0])[i]])[1] == "") {
            continue;
        }
        var randomNumber = Math.round(Math.random())
        inputInJSON[0][Object.keys(inputInJSON[0])[i]][Object.keys(inputInJSON[0][Object.keys(inputInJSON[0])[i]])[0]] = randomNumber
        if (randomNumber == 1) {
            inputInJSON[0][Object.keys(inputInJSON[0])[i]][Object.keys(inputInJSON[0][Object.keys(inputInJSON[0])[i]])[1]] = 0
        }
        else {
            inputInJSON[0][Object.keys(inputInJSON[0])[i]][Object.keys(inputInJSON[0][Object.keys(inputInJSON[0])[i]])[1]] = 1
        }
    }

    wrapperInput.value = JSON.stringify(inputInJSON)
    console.log(inputInJSON[0])
}



