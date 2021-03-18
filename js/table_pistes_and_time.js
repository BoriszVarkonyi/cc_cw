//GET BASIC ELEMENTS AND DATAS
//================================================================================

var notUsedContainer = document.getElementById("not_used_piste_container")
var usedContainer = document.getElementById("used_piste_container")

//================================================================================

//ADD SINGLE PISTE TO USED PISTES
//////////////////////////////////////////////////////////////////////////////////

function useOnePiste(x) {

    //Selects whole piste html object
    var pisteobject = x.parentNode.parentNode

    //Changing button by adding arrows and changing plus to minus button
    //Also changing button function to remove piste
    x.setAttribute("onclick", "removeOnePiste(this)")

    var buttons = pisteobject.querySelector(".piste_order")
    buttons.classList.remove("hidden")

    var plusbutton = pisteobject.querySelector(".plus")
    var minusbutton = pisteobject.querySelector(".minus")

    plusbutton.classList.add("hidden")
    minusbutton.classList.remove("hidden");

    //Addign modified piste object to used pistes container
    usedContainer.appendChild(pisteobject);

    console.log(usedContainer.childElementCount)

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

    notUsedContainer.forEach(x => {

        //Selects whole piste html object
        //var pisteobject = x.parentNode.parentNode

        //Changing button by adding arrows and changing plus to minus button
        //Also changing button function to remove piste
        x.setAttribute("onclick", "removeOnePiste(this)")

        var buttons = pisteobject.querySelector(".piste_order")
        buttons.classList.remove("hidden")

        var plusbutton = pisteobject.querySelector(".plus")
        var minusbutton = pisteobject.querySelector(".minus")

        plusbutton.classList.add("hidden")
        minusbutton.classList.remove("hidden");

        //Addign modified piste object to used pistes container
        usedContainer.appendChild(pisteobject);

        console.log(usedContainer.childElementCount)

    });
}
//////////////////////////////////////////////////////////////////////////////////