//Image upload
var input = document.getElementById("file");
document.getElementById("fileText").textContent = " ";
//Input change event listener
input.addEventListener("input", function() {
    //Deletes file parth. 
    document.getElementById("fileText").textContent = input.value.replace(input.value.substring(0, input.value.lastIndexOf("\\")) + "\\", "");
})

//Closes the page
function closePage() {
    close();
}

//Saves to Shift+S
document.addEventListener("keyup", function(e){
    if(e.shiftKey && e.which == 83) {
        var orangeSaveButton = document.querySelector(".stripe_button.orange")
        orangeSaveButton.click()
    }
    if(e.shiftKey && e.which == 67) {
        closePage();
    }
})

function toggleFullscreen(){
    var elem = document.getElementById("illustration_bg")
    var buttonIcon = document.querySelector("#colormode_button > img");
    if(window.innerHeight == screen.height){
        buttonIcon.src = "../assets/icons/open_in_full-black-18dp.svg"
        if (document.exitFullscreen){
            document.exitFullscreen();
        } 
        else if (document.webkitExitFullscreen){ /* Safari */
            document.webkitExitFullscreen();
        } 
        else if (document.msExitFullscreen){ /* IE11 */
            document.msExitFullscreen();
        }
    }
    else{
        buttonIcon.src = "../assets/icons/close_fullscreen-black-18dp.svg"
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } 
        else if (elem.webkitRequestFullscreen){ /* Safari */
            elem.webkitRequestFullscreen();
        } 
        else if (elem.msRequestFullscreen){ /* IE11 */
            elem.msRequestFullscreen();
        }
    }
}