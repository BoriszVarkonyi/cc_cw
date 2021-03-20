//GET BASIC ELEMENTS AND DATAS
//================================================================================

var notUsedContainer = document.getElementById("not_used_piste_container")
var usedContainer = document.getElementById("used_piste_container")
var time_input = document.getElementById("starting_time")
var interval_input = document.getElementById("interval")
var use_all = document.getElementById("all")
var use_not_all = document.getElementById("not_all")
var different_time = document.getElementById("diff_time")
var different_piste = document.getElementById("diff_piste")
var table_wrapper = document.getElementById("table_row_wrapper")

//================================================================================

//ADD SINGLE PISTE TO USED PISTES
//////////////////////////////////////////////////////////////////////////////////

function useOnePiste(x) {

    //Selects whole piste html object
    var pisteobject = x.parentNode.parentNode

    //Changing button by adding arrows and changing plus to minus button
    //Also changing button function to remove piste
    x.setAttribute("onclick", "removeOnePiste(this)")

    pisteobject.classList.remove("not_used");
    pisteobject.classList.add("used");

    var buttons = pisteobject.querySelector(".piste_order")
    buttons.classList.remove("hidden")

    var plusbutton = pisteobject.querySelector(".plus")
    var minusbutton = pisteobject.querySelector(".minus")

    plusbutton.classList.add("hidden")
    minusbutton.classList.remove("hidden");

    //Addign modified piste object to used pistes container
    usedContainer.appendChild(pisteobject);
}
//////////////////////////////////////////////////////////////////////////////////

//REMOVE SINGLE PISTE FROM USED PISTES
//////////////////////////////////////////////////////////////////////////////////

function removeOnePiste(x) {

    //Selects whole piste html object
    var pisteobject = x.parentNode.parentNode

    //Changing button by adding arrows and changing plus to minus button
    //Also changing button function to remove piste
    x.setAttribute("onclick", "useOnePiste(this)")

    pisteobject.classList.add("not_used");
    pisteobject.classList.remove("used");

    var buttons = pisteobject.querySelector(".piste_order")
    buttons.classList.add("hidden")

    var plusbutton = pisteobject.querySelector(".plus")
    var minusbutton = pisteobject.querySelector(".minus")

    plusbutton.classList.remove("hidden")
    minusbutton.classList.add("hidden");

    //Addign modified piste object to used pistes container
    notUsedContainer.appendChild(pisteobject);

    console.log(usedContainer.childElementCount)

}
//////////////////////////////////////////////////////////////////////////////////

//MOVE UP PISTE IN USED PISTES CONTAINER
//////////////////////////////////////////////////////////////////////////////////

function moveUp(x) {

    console.log("asd")

    var pisteobject = x.parentNode.parentNode

    if (pisteobject.previousElementSibling) {

        pisteobject.parentNode.insertBefore(pisteobject, pisteobject.previousElementSibling);

    }
}
//////////////////////////////////////////////////////////////////////////////////

//MOVE DOWN PISTE IN USED PISTES CONTAINER
//////////////////////////////////////////////////////////////////////////////////

function moveDown(x) {

    console.log("asd")

    var pisteobject = x.parentNode.parentNode

    if (pisteobject.nextElementSibling) {

        pisteobject.parentNode.insertBefore(pisteobject.nextElementSibling, pisteobject);

    }
}
//////////////////////////////////////////////////////////////////////////////////

//ADD ALL PISTES TO USED PISTES
//////////////////////////////////////////////////////////////////////////////////

function addAllPistes() {

    var allNotUsed = document.getElementsByClassName("not_used")

    var contuar = allNotUsed.length

    console.log(allNotUsed)

    for (let i = 0; i < contuar; i++) {

        pisteobject = allNotUsed[i]

        var addremoveButton = pisteobject.querySelector(".func_button");
        addremoveButton.setAttribute("onclick", "removeOnePiste(this)")

        var buttons = pisteobject.querySelector(".piste_order")
        buttons.classList.remove("hidden")

        var plusbutton = pisteobject.querySelector(".plus")
        var minusbutton = pisteobject.querySelector(".minus")

        plusbutton.classList.add("hidden")
        minusbutton.classList.remove("hidden");

        //Addign modified piste object to used pistes container
        usedContainer.appendChild(pisteobject);
    }

    for (let i = contuar - 1; i >= 0; i--) {

        pisteobject = allNotUsed[i]

        pisteobject.classList.remove("not_used");
        pisteobject.classList.add("used");

    }
}
//////////////////////////////////////////////////////////////////////////////////

//REMOVE ALL PISTES FROM USED PISTES
//////////////////////////////////////////////////////////////////////////////////

function removeAllPistes() {

    var allUsed = document.getElementsByClassName("used")

    var contuar = allUsed.length

    for (let i = contuar - 1; i >= 0; i--) {

        console.log(contuar)

        pisteobject = allUsed[i]

        var addremoveButton = pisteobject.querySelector(".func_button");
        addremoveButton.setAttribute("onclick", "useOnePiste(this)")

        var buttons = pisteobject.querySelector(".piste_order")
        buttons.classList.add("hidden")

        var plusbutton = pisteobject.querySelector(".plus")
        var minusbutton = pisteobject.querySelector(".minus")

        plusbutton.classList.remove("hidden")
        minusbutton.classList.add("hidden");

        //Addign modified piste object to used pistes container
        notUsedContainer.appendChild(pisteobject);
    }

    for (let h = contuar - 1; h >= 0; h--) {

        pisteobject = allUsed[h]

        pisteobject.classList.add("not_used");
        pisteobject.classList.remove("used");

    }
}
//////////////////////////////////////////////////////////////////////////////////

//TRY IN PISTES AND TIME
//////////////////////////////////////////////////////////////////////////////////

function tryConfig() {

    //Get data from inputs

    var start = time_input.value
    var interval = interval_input.value

    //Get all useable piste namess
    var pisteArray = []
    var allUsed = document.getElementsByClassName("used")

    for (const iterator of allUsed) {

        var pisteNameObject = iterator.querySelector(".piste_name")
        pisteArray.push(pisteNameObject.innerHTML)

    }

    //Get how many psites are available
    var pistesAvailable = allUsed.length

    //Get how many matches are there
    var roundnum = table_wrapper.childElementCount

    //Get table match table elemets in array
    var matchesArray = table_wrapper.querySelectorAll(".table_row")

    //Main filler function
    //Same time different piste

    if (different_piste.checked == true) {

        let pistecounter = 0;

        var actualTime = new Date("2020-01-01T" + start + ":00");

        for (let i = 0; i < matchesArray.length; i++) {

            m_piste = matchesArray[i].querySelector(".pistes")
            m_time = matchesArray[i].querySelector(".time")

            if (matchesArray[i].classList.contains("skip")) {

                m_piste.innerHTML = "Finished";
                m_time.innerHTML = "Finished";

                continue;
            }

            m_piste.innerHTML = pisteArray[pistecounter];
            m_time.innerHTML = actualTime.getHours() + ":" + minutes_with_leading_zeros(actualTime);

            pistecounter++

            if (pistecounter >= pistesAvailable) {

                pistecounter = 0
                actualTime.setTime(actualTime.getTime() + (interval * 60000))

            }
        }
    }

    //Same piste different time

    if (different_time.checked == true) {

        for (let i = 0; i < matchesArray.length; i++) {

            m_piste = matchesArray[i].querySelector(".pistes")
            m_time = matchesArray[i].querySelector(".time")

            if (matchesArray[i].classList.contains("skip")) {

                m_piste.innerHTML = "Finished";
                m_time.innerHTML = "Finished";

                roundnum--

                continue;
            }

        }

        console.log("Roundnum: " + roundnum)

        while ((roundnum % pistesAvailable) != 0) {

            pistesAvailable--

        }

        var actualTime = new Date("2020-01-01T" + start + ":00");

        change_every = roundnum / pistesAvailable

        console.log("Change every: " + change_every)

        changecounter = 0;
        howmany = 0;

        for (let i = 0; i < matchesArray.length; i++) {

            m_piste = matchesArray[i].querySelector(".pistes")
            m_time = matchesArray[i].querySelector(".time")

            if (matchesArray[i].classList.contains("skip")) {

                roundnum--

                continue;
            }

            m_piste.innerHTML = pisteArray[changecounter]
            m_time.innerHTML = actualTime.getHours() + ":" + minutes_with_leading_zeros(actualTime)

            howmany++
            actualTime.setTime(actualTime.getTime() + (interval * 60000))

            if (howmany == change_every) {

                changecounter++
                actualTime = new Date("2020-01-01T" + start + ":00");
                howmany = 0
            }

        }

    }

    //Check in console
    // console.log(pistesAvailable)
    // console.log(pisteArray)
    // console.log(matchesArray)

}

//Function for leading zeros
function minutes_with_leading_zeros(dt) {
    return (dt.getMinutes() < 10 ? '0' : '') + dt.getMinutes();
}
//////////////////////////////////////////////////////////////////////////////////