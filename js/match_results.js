var fencerNames = document.querySelectorAll(".fencer_name")

for (const iterator of fencerNames) {
    
    if (iterator.innerHTML == "No opponent yet") {

        iterator.parentElement.parentElement.parentElement.classList.add("disabled")
    }

}

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

var black_1 = getElements('f1_b')
var black_2 = getElements('f2_b')

var nc_black_1 = getElements('f1_b_p')
var nc_black_2 = getElements('f2_b_p')


document.addEventListener('keyup', e => {

    if(black_1.value != 0 && black_1.value != "" && black_1 == document.activeElement){

        score1.value = "EXC";
        score2.value = "";
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'
        black_2.value = ""
        nc_black_1.value = ""
        nc_black_2.value = ""

    }
    else if(black_2.value != 0 && black_2.value != "" && black_2 == document.activeElement){

        score2.value = "EXC";
        score1.value = "";
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'
        black_1.value = ""
        nc_black_1.value = ""
        nc_black_2.value = ""

    }
    else if (nc_black_1.value != 0 && nc_black_1.value != "" && nc_black_1 == document.activeElement){

        score1.value = "NCB";
        score2.value = "";
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'
        black_2.value = ""
        black_1.value = ""
        nc_black_2.value == ""

    }
    else if(nc_black_2.value != 0 && nc_black_2.value != "" && nc_black_2 == document.activeElement){

        score2.value = "NCB";
        score1.value = "";
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'
        black_2.value = ""
        black_1.value = ""
        nc_black_1.value = ""


    }
})


function abandonment(x) {

    if (x.name == "1") {
        score1.value = "ABD";
        score2.value = "";
        winnertext2.innerHTML = "WINNER"
        winnertext1.innerHTML = ""
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'
        black_1.value = ""
        black_2.value = ""
        nc_black_1.value = ""
        nc_black_2.value = ""
    }
    else {
        score2.value = "ABD";
        score1.value = "";
        winnertext2.innerHTML = ""
        winnertext1.innerHTML = "WINNER"
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'
        black_1.value = ""
        black_2.value = ""
        nc_black_1.value = ""
        nc_black_2.value = ""
    }

}

document.addEventListener('keyup', e => {

    //console.log("SC1:" + parseInt(score1.value))
    //console.log("SC2:" + parseInt(score2.value))

    
    if(score1.value == "EXC" || score1.value == "NCB"){

        winnertext1.innerHTML = ""
        winnertext2.innerHTML = "WINNER"        


    }
    else if(score2.value == "EXC" || score2.value == "NCB"){

        winnertext2.innerHTML = ""
        winnertext1.innerHTML = "WINNER"

    }
    else if (parseInt(score1.value) == parseInt(score2.value)) {

        winnertext1.innerHTML = ""
        winnertext2.innerHTML = ""
        drawcheckbox1.style.display = 'flex'
        drawcheckbox2.style.display = 'flex'

    }
    else if (score1.value == "" || score2.value == "") {

        winnertext1.innerHTML = ""
        winnertext2.innerHTML = ""
        drawcheckbox1.style.display = 'none'
        drawcheckbox2.style.display = 'none'

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

/* Chnage match attributes */

function collapser() {
    var settings = document.querySelectorAll(".setting")
    var changeButtons = document.querySelectorAll(".underlined_button");
    for (i = 0; i < changeButtons.length; i++) {
        changeButtons[i].nextElementSibling.classList.add("collapsed")
        changeButtons[i].classList.remove("hidden")
    }
    for(i=0; i<settings.length; i++){
        settings[i].classList.remove("hidden")
    }
}

//Referees input deleter
var refereesInputs = document.querySelectorAll("#rfrInput, #vdrfrInput")
refereesInputs.forEach(item => {
    var ul = item.nextElementSibling.nextElementSibling;
    item.addEventListener("keyup", function () {
        if (ul.classList.contains("empty")) {
            item.value = "";
            ul.classList.remove("empty")
            ul.classList.add("error")
        }
        else {
            ul.classList.remove("error")
        }
    })
    item.addEventListener("input", function () {
        var hiddenInput = item.parentNode.nextElementSibling;
        var searchResults = ul.querySelectorAll("button")
        for (i = 0; i < searchResults.length; i++) {
            if (item.value == searchResults[i].innerHTML) {
                hiddenInput.value = searchResults[i].id
            }
        }
    })
})

function changeThis(x) {
    collapser();
    var changeThisWrapper = x.nextElementSibling;
    var input = changeThisWrapper.firstElementChild.nextElementSibling.firstElementChild;
    if (input != null) {
        if (input.id == "rfrInput" || input.id == ("vdrfrInput")) {
            input.focus();
        }
    }
    changeThisWrapper.classList.remove("collapsed");
    x.classList.add("hidden");
    var setting = x.parentNode.querySelector(".setting")
    setting.classList.add("hidden")
}

function setreferee(x) {
    var hiddenInput = x.parentNode.parentNode.nextElementSibling;
    var input = x.parentNode.parentNode.querySelector("input")
    input.value = x.innerHTML;
    hiddenInput.value = x.id
}

function closeWrapper(x) {
    var input = x.nextElementSibling.firstElementChild;
    var hiddenInput = input.parentNode.nextElementSibling;
    if (input != null) {
        hiddenInput.value = ""
        input.value = ""
    }
    collapser();
}






