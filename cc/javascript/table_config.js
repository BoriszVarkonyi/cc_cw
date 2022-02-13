//GET BASIC ELEMENTS AND DATAS
//================================================================================

var notUsedContainer = document.getElementById("not_used_selection_list")
var usedContainer = document.getElementById("used_selection_list")

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

function addAllToSelection() {

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

function removeAllFromSelection() {

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