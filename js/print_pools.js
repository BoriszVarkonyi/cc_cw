function printPage() {
    window.print();
}
document.addEventListener("keyup", function(e){
    //Prints to Shift+P
    if(e.shiftKey && e.which == 80) {
        printPage();
    }
})