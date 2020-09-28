<?php

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
?>