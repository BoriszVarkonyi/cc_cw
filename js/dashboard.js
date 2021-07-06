function toggleWrapper(x){
    console.log(x)
    var statsWrapperDiv = x.parentNode.nextElementSibling
    var buttonImg = x.querySelector("img")
    if(statsWrapperDiv.classList.contains("closed")){
        statsWrapperDiv.classList.remove("closed")
    }
    else{
        statsWrapperDiv.classList.add("closed")
    }
}