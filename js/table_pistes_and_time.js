//GET BASIC ELEMENTS AND DATAS
//================================================================================

var time_input = document.getElementById("starting_time")
var interval_input = document.getElementById("interval")
var use_all = document.getElementById("all")
var use_not_all = document.getElementById("not_all")
var different_time = document.getElementById("diff_time")
var different_piste = document.getElementById("diff_piste")
var table_wrapper = document.getElementById("table_row_wrapper")

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

        prime_array = [7, 11, 13, 17, 31, 37, 41, 43, 47, 53, 59, 71, 73, 79, 97, 113, 157, 179]

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

        if (prime_array.includes(roundnum) && pistesAvailable != roundnum) {

            roundnum++
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