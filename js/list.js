//Auto width

window.addEventListener("resize", automaticWidth);
window.addEventListener("DOMContentLoaded", automaticWidth);
function automaticWidth(){
    var table = document.querySelector(".table");
    if(table != null) {
        var columnCounter = table.querySelectorAll(".table_row:last-of-type > div").length;
        for(columnNumber = 1; columnNumber<=columnCounter; columnNumber++) {
            var column= table.querySelectorAll('.table_row > div:nth-of-type(' + columnNumber +'), .table_header > div:nth-of-type(' + columnNumber +')');
            var widthArray = [];
            var biggestWidth;
            //Push all widths to widthArray
            for(i = 0; i<column.length; i++) {
                widthArray.push(column[i].offsetWidth);
            }
            //Gets the biggest array
            biggestWidth = widthArray.reduce(function(a, b) {
                return Math.max(a, b);
            });
            //Sets the width to all array element.
            for(i = 0; i<column.length; i++) {
                column[i].style.width = biggestWidth + "px";
                widthArray.pop();
            }
        }
    }
}

// Select System

var selectedRowInput = document.querySelector(".selected_list_item_input");

function selectRow(x){
    if(x.classList.contains("selected")){
        x.classList.remove("selected");
        selectedRowInpu.value = "";
    }
    else{
        var removeall = document.getElementsByClassName("selected");
        console.log(removeall);
        if(removeall.length !== 0) {
            for (let index = 0; index < removeall.length; index++) {
                removeall[index].classList.remove("selected");
            }
        }
    }
    x.classList.add("selected");
    console.log(selectedRowInput)
    selectedRowInput.value = x.id;
}
//Toggles the selection on clicked searchresult
function selectSearch(x) {
    console.log(x)
    var selectedElementId = x.id.slice(0, -1);
    var selectedElements = document.querySelectorAll(".page_content_flex .selected")
    for(i=0; i<selectedElements.length; i++){
        selectedElements[i].classList.remove("selected")
    }
    var selectedTableElement = document.getElementById(selectedElementId)
    selectedTableElement.classList.add("selected") 
}
//Auto fills the searchresult
function autoFill(x){
    var field = document.getElementById("inputs");
    field.value = x.innerHTML;
}
//Dragging system 
/*
function drag(e){
    document.selection ? document.selection.empty() : window.getSelection().removeAllRanges();
    left.style.width = (e.pageX - bar.offsetWidth / 2) + 'px';
}
var bar
var left
var right
function mouseDown(x) {
    document.addEventListener('mousemove', drag);
    return bar = x,
    left = bar.previousElementSibling,
    right = bar.nextElementSibling
    
}
function mouseUp() {
    document.removeEventListener('mousemove', drag);
}*/