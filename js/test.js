/*var loadingScreen = document.getElementById("loading_screen");
var loadingIcon = document.querySelector("#loading_screen img");
/*var progressBar = document.getElementById("progress_bar")

setTimeout(function(){ loadingScreen.classList.add("done"); }, 1500);
setTimeout(function(){ loadingIcon.classList.remove("desaturated"); }, 750);
*/
var loadingScreen = document.getElementById("loading_screen");
document.addEventListener('DOMContentLoaded', function(){
loadingScreen.innerHTML = '<div class="loading_panel"> <div class="loading_bar"> <div id="progress_bar"> </div> <img src="../assets/img/favicon_anim.svg" class="not_icon desaturated"/> </div> <p class="loading_text first">Competion Control Alpha</p> <p class="loading_text last">50%</p> </div>'
if (document.readyState === "complete" || document.readyState === "loaded"  || document.readyState === "interactive"){
        loadingScreen.classList.add("done")
        setTimeout(function(){ loadingScreen.innerHTML = ""  }, 750);
    }
})