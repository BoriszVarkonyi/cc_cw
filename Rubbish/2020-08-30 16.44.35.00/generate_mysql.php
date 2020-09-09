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

//print_r($allwc);

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


    if(substr($one[0], 0, 1) == 0){

        $kezd = str_replace("0","", str_replace(":","",$one[0]));
    

    }else{

        $kezd = substr($one[0], 0, 2);
    }
    if(substr($one[1], 0, 1) == 0){

     $fejez = str_replace("0","", str_replace(":","",$one[1]));

    }else{

        $fejez = substr($one[1], 0, 2);
    }

    $values_hour_minus = $fejez - $kezd;
    $values = "";

    $hourforperiod = "";
    $period = "";
for ($s=0; $s < $values_hour_minus; $s++) { 

while ($kezd < $fejez){

    for ($h=1; $h < 7; $h++) { 
        
        $period .= $kezd . "," . $h . ",";
        
        }
    $kezd++;
}





}

    $query = "INSERT INTO `WC_$dayscontrolon[0]_$comp_id`(`hour`, `period`, `ids`) VALUES ([value-1],[value-2],[value-3])";

    //print_r($dayscontrolon);
    //print_r($one);
    echo $period;


}










?>