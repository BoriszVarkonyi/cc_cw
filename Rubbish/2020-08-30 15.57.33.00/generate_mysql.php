<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php

$query = "SELECT comp_wc_info FROM competitions WHERE comp_id = $comp_id";
$query_do = mysqli_query($connection, $query);

if($row = mysqli_fetch_assoc($query_do)){

$string_from_database = $row["comp_wc_info"];

}
//echo $string_from_database;

$allwc = explode("//",$string_from_database);

print_r($allwc);

for ($i=0; $i < count($allwc); $i++) { 
    
    $dayscontrolon = explode(";",$allwc[$i]);


    $query = "CREATE TABLE `ccdatabase`.`WC_$dayscontrolon[0]_$comp_id` ( `hour` INT(11) NOT NULL , /*in_hour INT(11) NOT NULL ,*/ `period` INT(11) NOT NULL , `ids` VARCHAR($dayscontrolon[1]*2) NOT NULL ) ENGINE = InnoDB;";
    $query_do = mysqli_query($connection, $query);


    if(count($dayscontrolon) == 3){

        $one = explode("=>", $dayscontrolon[2]);
        $two = "";
        $three = "";

    }
    if(count($dayscontrolon) == 4){

        $one = explode("=>", $dayscontrolon[2]);
        $two = explode("=>", $dayscontrolon[3]);
        $three = "";

    }
    if(count($dayscontrolon) == 5){

        $one = explode("=>", $dayscontrolon[2]);
        $two = explode("=>", $dayscontrolon[3]);
        $three = explode("=>", $dayscontrolon[4]);

    }

    $values_hour_minus = str_replace(":","",$one[1]) - str_replace(":","",$one[0]);
    $values = "";

for ($s=0; $s < str_replace("0", "", $values_hour_minus); $s++) { 
    
$period = "";

    for ($h=1; $h < 7; $h++) { 
        
    $period .= $one[0] . "," . $h;
    
    }


}

    $query = "INSERT INTO `WC_$dayscontrolon[0]_$comp_id`(`hour`, `period`, `ids`) VALUES ([value-1],[value-2],[value-3])";

    //print_r($dayscontrolon);
    echo $period;
    //print_r($one);

}










?>