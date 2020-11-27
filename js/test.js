var loadingScreen = document.getElementById("loading_screen");
var loadingIcon = document.querySelector("#loading_screen img");
/*var progressBar = document.getElementById("progress_bar")*/

setTimeout(function(){ loadingScreen.classList.add("done"); }, 1500);
setTimeout(function(){ loadingIcon.classList.remove("desaturated"); }, 750);
