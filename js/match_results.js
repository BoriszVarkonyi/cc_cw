function getElements(id) {

    var element = document.getElementById(id)
    return element;

}

var winnertext1 = getElements('winner_f1')
var winnertext2 = getElements('winner_f2')
var score1 = getElements('points_f1')
var score2 = getElements('points_f2')
var drawcheckbox1 = getElements('draw_winner_f1')
var drawcheckbox2 = getElements('draw_winner_f2')

function abandonment(x) {

    if (x.name == "1") {
        score1.value = "ABD";
        score2.value = "";
        winnertext2.innerHTML = "WINNER"
        winnertext1.innerHTML = ""
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'
    }
    else {
        score2.value = "ABD";
        score1.value = "";
        winnertext2.innerHTML = ""
        winnertext1.innerHTML = "WINNER"
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'
    }

}

document.addEventListener('keyup', e => {

    console.log("SC1:" + parseInt(score1.value))
    console.log("SC2:" + parseInt(score2.value))

    if (score1.value == "" || score2.value == "") {

        winnertext1.innerHTML = ""
        winnertext2.innerHTML = ""
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'

    }
    else if (parseInt(score1.value) == parseInt(score2.value)) {

        winnertext1.innerHTML = ""
        winnertext2.innerHTML = ""
        drawcheckbox1.style.display = 'flex'
        drawcheckbox2.style.display = 'flex'

    }

    else if (parseInt(score1.value) > parseInt(score2.value)) {

        winnertext1.innerHTML = "WINNER"
        winnertext2.innerHTML = ""
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'

    } else if (parseInt(score2.value) > parseInt(score1.value)) {

        winnertext2.innerHTML = "WINNER"
        winnertext1.innerHTML = ""
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'

    } else {
        winnertext1.innerHTML = ""
        winnertext2.innerHTML = ""
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'
    }

})