function toggleWrapper(x) {
    var statsWrapperDiv = x.nextElementSibling
    if (statsWrapperDiv.classList.contains("closed")) {
        statsWrapperDiv.classList.remove("closed")
        x.firstElementChild.classList.remove("closed")
    }
    else {
        statsWrapperDiv.classList.add("closed")
        x.firstElementChild.classList.add("closed")
    }
}