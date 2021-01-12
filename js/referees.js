//Toggles technician and import technician panel
function toggle_add_technician() {
    var element = document.getElementById("add_technician_panel");
    element.classList.toggle("hidden");
}

function toggle_import_technician() {
    var element = document.getElementById("import_technician_panel");
    element.classList.toggle("hidden");
    //importOverlayClosed is a var. from importoverlay.js
    if(element.classList.contains("hidden")){
        importOverlayClosed = true;
        canAutoValidate = true;
    }
    else{
        importOverlayClosed = false;
        canAutoValidate = false;
    }
}


//Generates a random password with 10 character to the password field of new technician

function randomPassword(){

    var alphabet = "abcdefghijklmnopqrstuvwxyz" + 'abcdefghijklmnopqrstuvwxyz'.toUpperCase() + "0123456789";
    var randompasswordarray = [];
    
    for (i = 0;i < 10; i++) {
        
        var randomnumber = Math.floor(Math.random() * 62);
        var randomletter = alphabet.charAt(randomnumber);
        randompasswordarray.push(randomletter);
    
    }
    
    randompassword = randompasswordarray.join("");
    var passfield = document.getElementById("password_input");
    passfield.value = randompassword;
    }


//Counts the characters of technician's passwords and replaces with as many stars as many characters the password had

var visib = 1;
var sajtos = [];
var change_id = document.getElementsByClassName("password_table_item");
for(i = 0; i < change_id.length; i++) {

   var sajt = change_id.item(i).innerHTML;
   sajtos.push(sajt);

}
var test = [];

    sajtos.forEach(element => test.push(element.length));

var star = "*";

    for(i = 0; i < change_id.length; i++) {

        change_id.item(i).innerHTML = star.repeat(test[i]);
 
     }


//Changes between the shown end the hidden password.

function hidePasswords(x) {

    var buttonIcon = document.querySelector("#visibility_button > img");

    buttonIcon.src = "../assets/icons/visibility_off-black-18dp.svg";

    if (visib == 1){
    
        buttonIcon.src = "../assets/icons/visibility_off-black-18dp.svg";

    for(i = 0; i < change_id.length; i++) {

        change_id.item(i).innerHTML = sajtos[i];
     
    }

    visib = 2;


    }
    else{

        for(i = 0; i < change_id.length; i++) {

            change_id.item(i).innerHTML = star.repeat(test[i]);
     
         }

         buttonIcon.src = "../assets/icons/visibility-black-18dp.svg";

         visib = 1;
    }
}

//Selects the competition that the technicians will be imported from

function importTechnicians(x) {
    var selectedComp = x;
    var selectedCompInput = document.getElementById("selected_comp_input")
    selectedCompInput.value= selectedComp.id;
}

var setNationInput = document.getElementById("set_nation_input");
 function setNation(x){
    setNationInput.value = x.innerHTML;
}
//Table resizer
var table = document.querySelector(' .table');
var rows = document.querySelectorAll(".table_row")
for(k=0; k<rows.length; k++){
    resizableGrid(table);
}
resizableGrid(table);
function resizableGrid(table) {
    var row = table.querySelectorAll(".table_row")[k],
    cols = row ? row.children : undefined;
    console.log(table.getElementsByTagName('div'))
    if (!cols) return;
    for (var i=0;i<cols.length-2;i++){
        var div = createDiv(table.offsetHeight);
        cols[i].appendChild(div);
        cols[i].style.position = 'relative';
        setListeners(div);
    }
    function createDiv(height){
        var div = document.createElement('div');
        div.style.top = 0;
        div.style.right = 0;
        div.style.width = '5px';
        div.style.position = 'absolute';
        div.style.cursor = 'col-resize';
        /* remove backGroundColor later */
        div.style.backgroundColor = 'red';
        div.style.userSelect = 'none';
        /* table height */
        div.style.height = height+'px';
        return div;
    }
    function setListeners(div){
        var pageX,curCol,nxtCol,curColWidth,nxtColWidth;
        div.addEventListener('mousedown', function (e) {
        curCol = e.target.parentElement;
        nxtCol = curCol.nextElementSibling;
        pageX = e.pageX;
        curColWidth = curCol.offsetWidth
        if (nxtCol)
        nxtColWidth = nxtCol.offsetWidth
        });
    
        document.addEventListener('mousemove', function (e) {
        if (curCol) {
        var diffX = e.pageX - pageX;
        
        if (nxtCol)
        nxtCol.style.width = (nxtColWidth - (diffX))+'px';
    
        curCol.style.width = (curColWidth + diffX)+'px';
        }
       
        });
    
    document.addEventListener('mouseup', function (e) { 
        curCol = undefined;
        nxtCol = undefined;
        pageX = undefined;
        nxtColWidth = undefined;
        curColWidth = undefined;
        });
    }  
}  