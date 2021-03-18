//GET BASIC ELEMENTS AND DATAS
//================================================================================

var notUsedContainer = document.getElementById("not_used_piste_container")
var usedContainer = document.getElementById("used_piste_container")
var time_input = document.getElementById("starting_time")
var interval_input = document.getElementById("interval")
var use_all = document.getElementById("all")
var use_not_all = document.getElementById("not_all")

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

    for (let i = contuar-1; i >= 0; i--) {

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

    for (let i = contuar-1; i >= 0; i--) {

        console.log(contuar)

        pisteobject = allUsed[i]

        var addremoveButton = pisteobject.querySelector(".func_button");
        addremoveButton.setAttribute("onclick", "addOnePiste(this)")

        var buttons = pisteobject.querySelector(".piste_order")
        buttons.classList.add("hidden")

        var plusbutton = pisteobject.querySelector(".plus")
        var minusbutton = pisteobject.querySelector(".minus")

        plusbutton.classList.remove("hidden")
        minusbutton.classList.add("hidden");

        //Addign modified piste object to used pistes container
        notUsedContainer.appendChild(pisteobject);
    }

    for (let h = contuar-1; h >= 0; h--) {

        pisteobject = allUsed[h]

        pisteobject.classList.add("not_used");
        pisteobject.classList.remove("used");
        
    }
}
//////////////////////////////////////////////////////////////////////////////////

//TRY IN PISTES AND TIME
//////////////////////////////////////////////////////////////////////////////////

function tryConfig(){

    //Get data from inputs

    var start = time_input.value
    var interval = interval_input.value

    //Get all useable piste name and how many of them
    var pisteArray = []
    var allUsed = document.getElementsByClassName("used")

    for (const iterator of allUsed) {
        
        var pisteNameObject = iterator.querySelector(".piste_name")
        pisteArray.push(pisteNameObject.innerHTML)

    }

    var pistesAvailable = allUsed.length

    console.log(pistesAvailable)
    console.log(pisteArray)

}



//////////////////////////////////////////////////////////////////////////////////