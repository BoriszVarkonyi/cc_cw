var f_number_input = document.getElementById("fencer_quantity");
var f_number = f_number_input.value;


for (let index = 7; index > 3; index--) {

    var torekves = index;

    var szoveg = document.getElementById("p_" + torekves);

    inputka = document.getElementById(index);

    var fullpool = f_number / torekves;

    if(f_number % torekves == 0){

        szoveg.innerHTML = "(" + fullpool + " pool of " + torekves + ")";
        inputka.value = inputka.id + ";" + fullpool;

        }
    else
        {

            var teljescsop = Math.floor(f_number / torekves);


            var maradek = f_number % torekves;

            var ennyikell = (torekves - 1) - maradek;

            var nagyobb = teljescsop - ennyikell;
            var kisebb = 1 + ennyikell;

            var torekvesalatt = torekves - 1;

            if(nagyobb <= 0){

                szoveg.innerHTML = "(Not possible)";

            }else{

                szoveg.innerHTML = "(" + nagyobb + " pool of " + torekves + " and " + kisebb + " pool of " + torekvesalatt + ")";
                inputka.value = inputka.id + ";" + (nagyobb + kisebb);

            }

            }
}
