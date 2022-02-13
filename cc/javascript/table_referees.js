//Get html elements for further use

var table_wrapper = document.getElementById("table_row_wrapper")
var head1 = document.getElementById("f1_head")
var head2 = document.getElementById("f2_head")
var vr_name = document.getElementById("vr_name_head")
var vr_nat = document.getElementById("vr_nat_head")
var ref_input = document.getElementById("ref_to_use")
var vref_input = document.getElementById("vref_to_use")

//containers
var usedContainer = document.getElementById("used_selection_list")
var notUsedContainer = document.getElementById("not_used_selection_list")

//types of referees
var match_ref = document.getElementById("m_ref")
var video_ref = document.getElementById("v_ref")

//nation or club

var nation = document.getElementById("nat")
var club = document.getElementById("club")

//usage_of_referees

var automatic = document.getElementById("automatic")
var manual = document.getElementById("manual")

var mpr = document.getElementById("mpr")

//shuffle array function

function shuffle(array) {
    array.sort(() => Math.random() - 0.5);
    return array
}

//Function for changing nation to club selection

function nation_to_club() {

    var table_rows = table_wrapper.querySelectorAll(".table_row")

    for (let h = 0; h < table_rows.length; h++) {

        var nation_row = table_rows[h].querySelectorAll(".nation")
        var club_row = table_rows[h].querySelectorAll(".club")

        //console.log(nation_row)

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

        //console.log(nation_row)

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

    var availableMatches = 0

    for (let i = 0; i < table_rows.length; i++) {

        if (table_rows[i].classList.contains("skip")) {
            continue;
        }

        availableMatches++;

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

    //console.log("MATCHES:");
    //console.log(matches);

    //Get referees

    var referees = []

    var refereelist = usedContainer.querySelectorAll(".piste")

    for (const element of refereelist) {

        var id = element.querySelector(".referee_id")
        var name = element.querySelector(".referee_name")
        var nat = element.querySelector(".referee_nation")
        var club = element.querySelector(".referee_club")

        if (!referees) {

            referees = []

            referees.push({
                ref_id: id.innerHTML,
                n1: nat.innerHTML,
                c1: club.innerHTML,
                name: name.innerHTML
            })

        } else {
            referees.push({
                ref_id: id.innerHTML,
                n1: nat.innerHTML,
                c1: club.innerHTML,
                name: name.innerHTML
            })
        }

    }

    //console.log("REFEREES:");
    //console.log(referees)

    //console.log(change_every + " SZER " + referees.length + " < " + availableMatches)

    //WARNING IF INCORRECT REFEREE DRAW

    if (manual.checked == true && mpr.value * referees.length < availableMatches) {

        alert("Incorrect referee selection")
        //console.log("ASDASDASD")

    }


    if (automatic.checked == true) {

        //Assign referees to matches automatically

        var assignedArray = []

        for (const key in matches) {

            ////console.log(matches[key])

            refIndexCounter = 0

            for (const ref of referees) {

                var canUse = true

                for (const matchData of matches[key]) {


                    if (nation.checked == true) {

                        if (matchData.n1 != ref.n1 && matchData.n2 != ref.n1) {

                            //console.log("OK")
                        } else {

                            canUse = false
                            break
                        }

                    }

                    if (club.checked == true) {

                        if (matchData.n1 != ref.c1 && matchData.n2 != ref.c1) {

                            //console.log("OK")
                        } else {

                            canUse = false
                            break
                        }

                    }

                }

                if (canUse == true) {

                    for (const matchData of matches[key]) {

                        assignedArray.push([matchData.match_id, ref])
                    }

                    referees.splice(refIndexCounter, 1)
                    break

                } else {

                    refIndexCounter++
                }
            }
        }
        //console.log(assignedArray)
    }

    if (manual.checked == true) {

        //Assign referees to matches manual match num

        // //console.log(matches)

        var change_every = mpr.value

        var assignedArray = []
        var refereesToUse = []
        var matchesToUse = []

        var array = Array.from(matches);

        var filtered = array.filter(function (el) {
            return el != null;
        });

        //console.log("TEST")
        //console.log(filtered)

        //console.log("____________________________________END OF FIRST TESTS____________________________________")

        for (let index = 0; index < 10; index++) {

            //console.log("ASSIGNED: " + assignedArray.length + " AVAILABLE: " + availableMatches)

            if (assignedArray.length == availableMatches) {
                break
            }

            refereesToUse = Array.from(referees)

            for (const asd in matches) {

                matchesToUse[asd] = matches[asd]

            }

            //matchesToUse = Array.from(matches)
            console.log(matchesToUse)

            refereesToUse = shuffle(refereesToUse)

            //console.log("Referees to use")
            //console.log(refereesToUse)

            //console.log("Matches to use")
            //console.log(matchesToUse)

            assignedArray = []

            //ISSUE HERE ISSUE HERE ISSUE HERE ISSUE HERE ISSUE HERE ISSUE HERE ISSUE HERE ISSUE HERE  ISSUE HERE

            for (const key in matchesToUse) {

                console.log(array)

                var refIndexCounter = 0

                for (const ref of refereesToUse) {

                    if (ref == null) {
                        refIndexCounter++
                        continue
                    }

                    var canUse = true

                    var counter = 0

                    for (const matchData of matchesToUse[key]) {

                        //console.log(counter)

                        if (counter == change_every) {
                            ////console.log("GEC")
                            break
                        }

                        if (matchData.n1 != ref.n1 && matchData.n2 != ref.n1) {
                            ////console.log("OK")
                            counter++
                        } else {
                            canUse = false
                            ////console.log("REFEREE CANNOT BE USED HERE")
                            break
                        }

                    }

                    if (canUse == true) {

                        var counter = 0

                        var stopper = matchesToUse[key].length

                        //console.log("REMAINING MATCHES: " + stopper)

                        for (const matchData of matchesToUse[key]) {

                            if (counter == change_every) {
                                break
                            }
                            if (stopper == 0) {
                                break
                            }
                            // if (matchesToUse[key].length == 0) {
                            //	 //console.log("HELLO MR GECIKE, TÖRÖK")
                            //	 break
                            // }

                            assignedArray.push([matchData.match_id, ref])

                            counter++
                            stopper--
                        }

                        //refereesToUse.splice(refIndexCounter, 1)
                        //MASIK VERZIO NULL -AL

                        refereesToUse[refIndexCounter] = null

                        //console.log(ref.name + " REFEREE ADDED AND REMOVED FROM AVAILABLE REFEREES")
                        matchesToUse[key].splice(0, counter)

                        if (matchesToUse[key].length == 0) {
                            //console.log("OUT OF MATCHES ON THIS PISTE")
                            break
                        }

                    } else {
                        //console.log("CHECKING NEXT REFEREE")
                        refIndexCounter++
                        continue
                    }
                    refIndexCounter++
                }
            }

            //ISSUE HERE ISSUE HERE ISSUE HERE ISSUE HERE ISSUE HERE ISSUE HERE ISSUE HERE ISSUE HERE  ISSUE HERE
            //console.log(assignedArray)


            if (assignedArray.length != availableMatches && index == 10) {

                alert("Incorrect referee draw")

            }

        }
    }

    //KIÍRÁS KIÍRÁS KIÍRÁS KIÍRÁS KIÍRÁS KIÍRÁS KIÍRÁS KIÍRÁS KIÍRÁS KIÍRÁS KIÍRÁS KIÍRÁS |
    //																					|
    //																					V
    var table_rows = table_wrapper.querySelectorAll(".table_row")

    //console.log(table_rows)

    for (let h = 0; h < table_rows.length; h++) {

        if (match_ref.checked == true) {

            var id_row = table_rows[h].querySelector(".id")
            var referee_row = table_rows[h].querySelector(".refname")
            var refnat_row = table_rows[h].querySelector(".refnat")
            var refclub_row = table_rows[h].querySelector(".refclub")

            for (const match of assignedArray) {


                if (match[0] == id_row.children[0].innerHTML) {

                    referee_row.innerHTML = match[1].name
                    refnat_row.innerHTML = match[1].n1
                    refclub_row.innerHTML = match[1].c1

                }

            }
        }
        if (video_ref.checked == true) {

            var id_row = table_rows[h].querySelector(".id")
            var referee_row = table_rows[h].querySelector(".vrefname")
            var refnat_row = table_rows[h].querySelector(".vrefnat")
            var refclub_row = table_rows[h].querySelector(".vrefclub")

            for (const match of assignedArray) {


                if (match[0] == id_row.children[0].innerHTML) {

                    referee_row.innerHTML = match[1].name
                    refnat_row.innerHTML = match[1].n1
                    refclub_row.innerHTML = match[1].c1

                }

            }
        }
        //console.log(referee_row)
    }

    //REMOVE REFEREES FROM LIST

    var geci = 0

    var refs = usedContainer.querySelectorAll(".piste")

    for (let s = 0; s < refs.length; s++) {

        var refIndexCounter = 0

        for (const match of assignedArray) {

            var id = refs[s].querySelector(".referee_id").innerHTML

            if (match[1].ref_id == id) {

                refs[s].remove()
                geci++
                break
            }
        }
    }

    //console.log("I AM MR REMOVER CANCER. I REMOVED: " + geci)

    //Figyelmeztetni a felhasználót, hogyha frissít, elveszik a beosztás
    //Ha nem egyben osztja be akkor pedig megint az összes lesz használva, így válogatnia kell, vagy újraosztani

    var stringToUse = ""

    firstTime = true

    for (const match of assignedArray) {

        if (firstTime == false) {

            stringToUse += "//"
        }

        stringToUse += match[0] + "&&" + '{"ref_id":' + match[1].ref_id + ',"n1":"' + match[1].n1 + '","c1":"' + match[1].c1 + '","name":"' + match[1].name + '"}'

        firstTime = false
    }

    if (match_ref.checked == true) {

        ref_input.value = stringToUse
    } else {

        vref_input.value = stringToUse
    }
}