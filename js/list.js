//Auto width

var table = document.querySelector(".table");
window.addEventListener("resize", automaticWidth);
window.addEventListener("DOMContentLoaded", automaticWidth);
var columnCounter = table.querySelectorAll(".table_row:last-of-type > div").length;
var notElementNumbers;
function automaticWidth(){
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

//Arrow system

var hiddenin = document.getElementsByClassName("selected_list_item_input");
var table = document.querySelector(".table");

document.onkeydown = (keyDownEvent) => {

    if(keyDownEvent.key == "ArrowUp"){


        var kijelolt = document.getElementsByClassName("selected");

        var elem = kijelolt[0];
        var kovielem = elem.previousElementSibling;

        if(elem != tabla.children[1]){

            elem.classList.remove("selected");
            kovielem.classList.add("selected");
            hiddenin.value = kovielem.id;

        }else
        {

            console.log("First");
        }
    }


    if(keyDownEvent.key == "ArrowDown"){


        var kijelolt = document.getElementsByClassName("selected");

        var elem = kijelolt[0];
        var kovielem = elem.nextElementSibling;

        if(elem != tabla.lastElementChild){

            elem.classList.remove("selected");
            kovielem.classList.add("selected");
            hiddenin.value = kovielem.id;

        }else
        {

            console.log("LAST");
        }
    }
}
