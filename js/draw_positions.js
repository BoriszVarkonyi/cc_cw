function drawPositions() {

    var saveButton = document.getElementById("save_positions_button");
    var drawButton = document.getElementById("draw_positions_button");

    saveButton.classList.toggle("hidden");
    drawButton.classList.toggle("inactive");
}



var teamInput = document.querySelector(".positions_wrapper input")
var inputInJSON = JSON.parse(teamInput.value)


//console.log(Object.keys(inputInJSON[0][Object.keys(inputInJSON[0])[0]])[1])
//console.log(Object.keys(inputInJSON[0])[1])
//console.log(Object.keys(Object.keys(inputInJSON[0][Object.keys(inputInJSON[0])[1]])[0]))
//console.log(inputInJSON[0][Object.keys(inputInJSON[0])[1]][Object.keys(inputInJSON[0][Object.keys(inputInJSON[0])[1]])[0]])



for (i = 0; i < 10; i++) {
    var fasz = Math.round(Math.random())
    //console.log(fasz)
}

for (i = 0; i < Object.keys(inputInJSON[0]).length; i++) {
    var randomNumber = Math.round(Math.random())
    inputInJSON[0][Object.keys(inputInJSON[0])[i]][Object.keys(inputInJSON[0][Object.keys(inputInJSON[0])[i]])[0]] = randomNumber
    if(randomNumber == 1){
        inputInJSON[0][Object.keys(inputInJSON[0])[i]][Object.keys(inputInJSON[0][Object.keys(inputInJSON[0])[i]])[1]] = 0
    }
    else{
        inputInJSON[0][Object.keys(inputInJSON[0])[i]][Object.keys(inputInJSON[0][Object.keys(inputInJSON[0])[i]])[1]] = 1
    }
}

console.log(inputInJSON[0])
