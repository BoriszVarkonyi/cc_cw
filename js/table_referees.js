//Get html elements for further use

var table_wrapper = document.getElementById("table_row_wrapper")
var head1 = document.getElementById("f1_head")
var head2 = document.getElementById("f2_head")
var vr_name = document.getElementById("vr_name_head")
var vr_nat = document.getElementById("vr_nat_head")

//containers
var usedContainer = document.getElementById("used_selection_list")
var notUsedContainer = document.getElementById("not_used_selection_list")

//types of referees
var match_ref = document.getElementById("m_ref")
var video_ref = document.getElementById("v_ref")

//nation or club

var nation = document.getElementById("nat")
var club = document.getElementById("club")

//Function for changing nation to club selection

function nation_to_club() {

    var table_rows = table_wrapper.querySelectorAll(".table_row")

    for (let h = 0; h < table_rows.length; h++) {

        var nation_row = table_rows[h].querySelectorAll(".nation")
        var club_row = table_rows[h].querySelectorAll(".club")

        console.log(nation_row)

        for (let i = 0; i < nation_row.length; i++) {

            nation_row[i].classList.add("hidden")
            club_row[i].classList.remove("hidden")
        }
    }
    head1.innerHTML = "F1 CLUB"
    head2.innerHTML = "F2 CLUB"

    if (match_ref.checked == true) {

        vr_nat.innerHTML = "REFEREE"

        for (let h = 0; h < table_rows.length; h++) {
            var video = table_rows[h].querySelectorAll(".video")
            for (let i = 0; i < video.length; i++) {
                video[i].classList.add("hidden")
            }
            var refname = table_rows[h].querySelectorAll(".refname")
            for (let i = 0; i < refname.length; i++) {
                refname[i].classList.remove("hidden")
            }
        }

    } else {

        vr_nat.innerHTML = "VIDEO REFEREE"
        for (let h = 0; h < table_rows.length; h++) {
            var ref = table_rows[h].querySelectorAll(".referee")
            for (let i = 0; i < ref.length; i++) {
                ref[i].classList.add("hidden")
            }
            var vrefname = table_rows[h].querySelectorAll(".vrefname")
            for (let i = 0; i < vrefname.length; i++) {
                vrefname[i].classList.remove("hidden")
            }
        }
    }

    vr_nat.innerHTML += " CLUB"

    var refereelist = notUsedContainer.querySelectorAll(".piste")

    for (const element of refereelist) {

        var nation = element.querySelector(".referee_nation")
        var club = element.querySelector(".referee_club")

        nation.classList.add("hidden")
        club.classList.remove("hidden")

    }

    var refereelist = usedContainer.querySelectorAll(".piste")

    for (const element of refereelist) {

        var nation = element.querySelector(".referee_nation")
        var club = element.querySelector(".referee_club")

        nation.classList.add("hidden")
        club.classList.remove("hidden")

    }

}

//Function for changing club to nation selection

function club_to_nation() {

    var table_rows = table_wrapper.querySelectorAll(".table_row")

    for (let h = 0; h < table_rows.length; h++) {

        var nation_row = table_rows[h].querySelectorAll(".nation")
        var club_row = table_rows[h].querySelectorAll(".club")

        console.log(nation_row)

        for (let i = 0; i < nation_row.length; i++) {

            nation_row[i].classList.remove("hidden")
            club_row[i].classList.add("hidden")
        }
    }
    head1.innerHTML = "F1 NATION"
    head2.innerHTML = "F2 NATION"

    if (match_ref.checked == true) {

        vr_nat.innerHTML = "REFEREE"
        for (let h = 0; h < table_rows.length; h++) {
            var video = table_rows[h].querySelectorAll(".video")
            for (let i = 0; i < video.length; i++) {
                video[i].classList.add("hidden")
            }
            var refname = table_rows[h].querySelectorAll(".refname")
            for (let i = 0; i < refname.length; i++) {
                refname[i].classList.remove("hidden")
            }
        }

    } else {

        vr_nat.innerHTML = "VIDEO REFEREE"
        for (let h = 0; h < table_rows.length; h++) {
            var ref = table_rows[h].querySelectorAll(".referee")
            for (let i = 0; i < ref.length; i++) {
                ref[i].classList.add("hidden")
            }
            var vrefname = table_rows[h].querySelectorAll(".vrefname")
            for (let i = 0; i < vrefname.length; i++) {
                vrefname[i].classList.remove("hidden")
            }
        }

    }

    vr_nat.innerHTML += " NATION"

    var refereelist = notUsedContainer.querySelectorAll(".piste")

    for (const element of refereelist) {

        var nation = element.querySelector(".referee_nation")
        var club = element.querySelector(".referee_club")

        nation.classList.remove("hidden")
        club.classList.add("hidden")

    }

    var refereelist = usedContainer.querySelectorAll(".piste")

    for (const element of refereelist) {

        var nation = element.querySelector(".referee_nation")
        var club = element.querySelector(".referee_club")

        nation.classList.remove("hidden")
        club.classList.add("hidden")

    }


}

//Function for changing match ref to video ref

function ref_to_vref() {

    var table_rows = table_wrapper.querySelectorAll(".table_row")

    for (let h = 0; h < table_rows.length; h++) {

        var referee = table_rows[h].querySelectorAll(".referee")
        var v_referee = table_rows[h].querySelectorAll(".video")

        for (let i = 0; i < referee.length; i++) {

            referee[i].classList.add("hidden")
            v_referee[i].classList.remove("hidden")
        }
    }

    vr_name.innerHTML = "VIDEO REFEREE"

    vr_nat.innerHTML = "VIDEO REFEREE"



    if (nation.checked == true) {

        vr_nat.innerHTML += " NATION"

        for (let h = 0; h < table_rows.length; h++) {

            var club_row = table_rows[h].querySelectorAll(".club")
            for (let i = 0; i < club_row.length; i++) {

                club_row[i].classList.add("hidden")

            }

        }

    } else {

        vr_nat.innerHTML += " CLUB"

        for (let h = 0; h < table_rows.length; h++) {

            var nation_row = table_rows[h].querySelectorAll(".nation")
            for (let i = 0; i < nation_row.length; i++) {

                nation_row[i].classList.add("hidden")

            }

        }
    }
}

//Function for changing vref to match ref

function vref_to_ref() {

    var table_rows = table_wrapper.querySelectorAll(".table_row")

    for (let h = 0; h < table_rows.length; h++) {

        var referee = table_rows[h].querySelectorAll(".referee")
        var v_referee = table_rows[h].querySelectorAll(".video")

        for (let i = 0; i < referee.length; i++) {

            referee[i].classList.remove("hidden")
            v_referee[i].classList.add("hidden")
        }
    }

    vr_name.innerHTML = "REFEREE"

    vr_nat.innerHTML = "REFEREE"

    if (nation.checked == true) {

        vr_nat.innerHTML += " NATION"

        for (let h = 0; h < table_rows.length; h++) {

            var club_row = table_rows[h].querySelectorAll(".club")
            for (let i = 0; i < club_row.length; i++) {

                club_row[i].classList.add("hidden")

            }

        }

    } else {

        vr_nat.innerHTML += " CLUB"

        for (let h = 0; h < table_rows.length; h++) {

            var nation_row = table_rows[h].querySelectorAll(".nation")
            for (let i = 0; i < nation_row.length; i++) {

                nation_row[i].classList.add("hidden")

            }

        }
    }
}

//Fuction to draw referees to matches

function try_referees() {

    //Get matches

    var matches = []

    var table_rows = table_wrapper.querySelectorAll(".table_row")

    for (let i = 0; i < table_rows.length; i++) {

        if (table_rows[i].classList.contains("skip")) {
            continue;
        }

        var id = table_rows[i].querySelector(".id").children
        var piste = table_rows[i].querySelector(".pistes").children

        if (nation.checked == true) {
            var selectorArray = table_rows[i].querySelectorAll(".n_for_ref")
        } else {
            var selectorArray = table_rows[i].querySelectorAll(".c_for_ref")
        }

        if (!matches[piste[0].innerHTML]) {

            matches[piste[0].innerHTML] = []

            matches[piste[0].innerHTML].push({
                match_id: id[0].innerHTML,
                n1: selectorArray[0].children[0].innerHTML,
                n2: selectorArray[1].children[0].innerHTML
            })

        } else {
            matches[piste[0].innerHTML].push({
                match_id: id[0].innerHTML,
                n1: selectorArray[0].children[0].innerHTML,
                n2: selectorArray[1].children[0].innerHTML
            })
        }
    }

    console.log(matches);

    //Get referees

    var referees = []

    var refereelist = usedContainer.querySelectorAll(".piste")

    for (const element of refereelist) {

        var id = element.querySelector(".referee_id")
        var name = element.querySelector(".referee_name")

        if (nation.checked == true) {
            var selector = element.querySelector(".referee_nation")
        } else {
            var selector = element.querySelector(".referee_club")
        }

        if (!referees) {

            referees = []

            referees.push({
                ref_id: id.innerHTML,
                n1: selector.innerHTML,
                name: name.innerHTML
            })

        } else {
            referees.push({
                ref_id: id.innerHTML,
                n1: selector.innerHTML,
                name: name.innerHTML
            })
        }

    }

    console.log(referees)

    //Assign referees to matches

    var assignedArray = []

    for (const key in matches) {

        //console.log(matches[key])

        refIndexCounter = 0

        for (const ref of referees) {

            var canUse = true

            for (const matchData of matches[key]) {

                if (matchData.n1 != ref.n1 && matchData.n2 != ref.n1) {

                    console.log("OK")

                } else {

                    canUse = false
                    break

                }

            }

            if (canUse == true) {

                for (const matchData of matches[key]) {

                    assignedArray.push([matchData.match_id, ref])
                }

                referees.splice(refIndexCounter, 1)
                break
                
            }else{

                refIndexCounter++

            }

        }



    }

    console.log(assignedArray)
}