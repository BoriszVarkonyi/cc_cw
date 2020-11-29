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
        if(removeall.length != 0) {
            for (let index = 0; index < removeall.length; index++) {
                removeall[index].classList.remove("selected");
            }
        }
    }
    x.classList.add("selected");
    selectedRowInput.value = x.id;
}



//Arrow system
/*
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
*/
//Dragging system 
