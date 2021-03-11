function printPage() {
    window.print();
}
document.addEventListener("keyup", function (e) {
    //somethingIsFocused is a var. from main.js
    if (!somethingIsFocused) {
        //Prints to Shift+P
        if (e.shiftKey && e.which == 80) {
            printPage();
        }
    }
})


