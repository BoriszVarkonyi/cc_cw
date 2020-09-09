<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php

$query = "SELECT comp_wc_info FROM competitions WHERE comp_id = $comp_id";
$query_do = mysqli_query($connection, $query);

if($row = mysqli_fetch_assoc($query_do)){

$string_from_database = $row["comp_wc_info"];

}
echo $string_from_database;

$allwc = explode("//",$string_from_database);

print_r($allwc);

$separator = array();

for ($i=0; $i < count($allwc); $i++) { 
    
    $dayscontrolon = explode(";",$allwc);

}











?>