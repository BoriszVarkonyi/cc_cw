<?php


//status converter (converts status from DB to string status)
function statusConverter($statusin) {

$statusout = "";

switch ($statusin) {

    case 1:
    $statusout = "Scheduled";
    break;
    case 2:
    $statusout = "Published";
    break;
    case 3:
    $statusout = "Ongoing";
    break;
    case 4:
    $statusout = "Finished";
    break;

}

return $statusout;

}


//role converter (converts role from DB to string role)
function roleConverter($rolein) {

    $roleout = "";

    switch ($rolein) {

        case 1:
        $roleout = "Semi";
        break;
        case 2:
        $roleout = "DT";
        break;
        case 3:
        $roleout = "Weapon Control";
        break;
        case 4:
        $roleout = "Registration";
        break;

    }

    return $roleout;

}


//check competition
function checkComp($connectionin){

    $lastlogin = $_COOKIE["lastlogin"];

    $comp_id = $_GET["comp_id"];

    if($lastlogin == "1"){
        $org_id = $_COOKIE["org_id"];
    }
    else{
        $tech_id = $_COOKIE["tech_id"];
    }

    $query = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $check_comp_query = mysqli_query($connectionin, $query);

    if($row = mysqli_fetch_assoc($check_comp_query)){

    $check_id = $row["comp_organiser_id"];
    $comp_name = $row["comp_name"];

    }

    if($lastlogin == "2"){
    $query_tech = "SELECT * FROM technicians WHERE id = '$tech_id'";
    $check_comp_tech_query = mysqli_query($connectionin, $query_tech);

    if($row = mysqli_fetch_assoc($check_comp_tech_query)){

        $check_tech_id = $row["ass_comp_id"];
        $tech_name = $row["username"];
        $tech_role = $row["role"];

        $check_tech_id_list = explode(" ",$check_tech_id);

    }
}


    if($check_id != $org_id && $lastlogin == 1){

        header("Location: ../index.php");

    }
    elseif ($lastlogin == 2 && !in_array($comp_id, $check_tech_id_list)){

        header("Location: ../index.php");

    }
    else{

    echo "MINDEN JÓ";

    }

}

function setOnline($connectionin) {

    $lastlogin = $_COOKIE["lastlogin"];

    if($lastlogin == 2){
        $tech_id = $_COOKIE["tech_id"];


$querysetonline = "UPDATE technicians SET online = 1 WHERE id = $tech_id";
$querysetonline_do = mysqli_query($connectionin, $querysetonline);

    }

}

//sex converter (converts sex from DB to string sex)
function sexConverter($sexin) {

    $sexout = "";

    if ($sexin == 1) {
        $sexout = "Men";
    } else {
        $sexout = "Women";
    }

    return $sexout;

}

//find object with same id from json_table
function findObject(array $table_of_objects, $id_to_find, string $attribute_name) {
    foreach ($table_of_objects as $object) {
        if ($object -> {$attribute_name} == $id_to_find) {
            $ob_to_find = $object;
            break;
        }
    }

    if (isset($ob_to_find)) {
        return array_search($ob_to_find, $table_of_objects);
    } else {
        return FALSE;
    }
}

//weapon type converter nem tom melyik melyik kell borsiz
function weaponConverter($weaponin) {

    $weaponout = "";

    switch ($weaponin) {

        case 1:
            $weaponout = "Epee";
        break;
        case 2:
            $weaponout = "Foil";
        break;
        case 3:
            $weaponout = "Sabre";
        break;
        default:
            $weaponout = "Unidentified weapon";
        break;

    }

    return $weaponout;

}


//weponConenverterReversed
function weaponConenverterReversed($weapon_name_in) {
    switch ($weapon_name_in) {
        case "Epee":
            $output = 1;
        break;
        case "Foil":
            $output = 2;
        break;
        case "Sabre":
            $output = 3;
        break;
        default:
            $output = "Unidentified weapon";
        break;
    }

    return $output;
}

//test fav_comps star (filled or not)
function getStar($comp_id) {

    $cookie_name = "fav_comp";

    if (isset($_COOKIE[$cookie_name])) {
        $cookie_value = $_COOKIE[$cookie_name];
    } else {
        $cookie_value = "%";
    }

    $contains = strrpos($cookie_value, $comp_id . "%");

    if ($contains != FALSE) {
        $contains = TRUE;
    }

    if ($contains) {
        $star = "../assets/icons/star-black.svg";
    } else {
        $star = "../assets/icons/star_border-black.svg";
    }

    return $star;
}

function sexConverterReversed($sex_name_in) {
    switch ($sex_name_in) {
        case "Male":
            $output = "1";
        break;
        case "Female":
            $output = "2";
        break;
        default:
            $output = "Wrong sex!";
        break;
    }

    return $output;
}

function pisteColor($color_id) {

    switch ($color_id) {

        case 1:
        $colortext = "blue";
        break;
        case 2:
        $colortext = "yellow";
        break;
        case 3:
        $colortext = "green";
        break;
        case 4:
        $colortext = "red";
        break;

    }

    return $colortext;

}

function pisteColorLetter($color_id) {

    switch ($color_id) {

        case 1:
        $colortext = "B";
        break;
        case 2:
        $colortext = "Y";
        break;
        case 3:
        $colortext = "G";
        break;
        case 4:
        $colortext = "R";
        break;

    }

    return $colortext;

}

function tableArrays($tableid){

    switch ($tableid) {

        case 128:
        $tablearray = [1,128,65,64,33,96,97,32,17,112,81,48,49,80,113,16,9,120,73,56,41,88,105,24,25,104,89,40,57,72,121,8,5,124,69,60,37,92,101,28,21,108,85,44,53,76,117,12,13,116,77,52,45,84,109,20,29,100,93,36,61,68,125,4,3,126,67,62,35,94,99,30,19,110,83,46,51,78,115,14,11,118,75,54,43,86,107,22,27,102,91,38,59,70,123,6,7,122,71,58,39,90,103,26,23,106,87,42,55,74,119,10,15,114,79,50,47,82,111,18,31,98,95,34,63,66,127,2];
        break;
        case 64:
        $tablearray = [1,64,33,32,17,48,49,16,9,56,41,24,25,40,57,8,5,60,37,28,21,44,53,12,13,52,45,20,29,36,61,4,3,62,35,30,19,46,51,14,11,54,43,22,27,38,59,6,7,58,39,26,23,42,55,10,15,50,47,18,31,34,63,2];
        break;
        case 32:
        $tablearray = [1,32,17,16,9,24,25,8,5,28,21,12,13,20,29,4,3,30,19,14,11,22,27,6,7,26,23,10,15,18,31,2];
        break;
        case 16:
        $tablearray = [1,16,9,8,5,12,13,4,3,14,11,6,7,10,15,2];
        break;
        case 8:
        $tablearray = [1,8,5,4,3,6,7,2];
        break;
        case 4:
        $tablearray = [1,4,3,2];
        break;
        case 2:
        $tablearray = [1,2];
        break;

    }

    return $tablearray;



}

function tablecolor($colorcode){

    switch ($colorcode) {

        case 1:
        $colorwrite = "Blue";
        break;
        case 2:
        $colorwrite = "Yellow";
        break;
        case 3:
        $colorwrite = "Green";
        break;
        case 4:
        $colorwrite = "Red";
        break;

    }

    return $colorwrite;


}
?>