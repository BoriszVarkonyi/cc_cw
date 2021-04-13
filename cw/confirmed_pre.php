<?php include "cw_header.php"; ?>
<?php include "../cw/db.php"; ?>
<?php include "../includes/functions.php"; ?>

<?php

echo $f_name = $_GET["f_name"];
echo $f_country = $_GET["f_country"];
echo $f_email = $_GET["f_email"];
echo $f_phone = $_GET["f_phone"];

echo $c_name = $_GET["c_name"];
echo $c_email = $_GET["c_email"];
echo $c_phone = $_GET["c_phone"];

echo $fencer_ids = $_GET["fencer_ids"];

echo $compet_id = $_GET["compet_id"];



$query = "SELECT *
FROM `information_schema`.`tables`
WHERE table_schema = 'ccdatabase'
    AND table_name = 'pre_$compet_id'
LIMIT 1;";

$query_do = mysqli_query($connection, $query);

if(mysqli_num_rows($query_do) == 0){

    $query_create_table = "CREATE TABLE pre_$compet_id( id INT(11) NOT NULL AUTO_INCREMENT , fed_name VARCHAR(255) NOT NULL , country_club VARCHAR(255) NOT NULL , fed_mail VARCHAR(255) NOT NULL , fed_phone VARCHAR(255) NOT NULL , con_name VARCHAR(255) NOT NULL , con_mail VARCHAR(255) NOT NULL , con_phone VARCHAR(255) NOT NULL , reg_fencers VARCHAR(255) NOT NULL, stat INT(5) NOT NULL  , PRIMARY KEY (id)) ENGINE = InnoDB;";
    $query_create_table_do = mysqli_query($connection, $query_create_table);

}


$query = "INSERT INTO `pre_$compet_id`(fed_name, country_club, fed_mail, fed_phone, con_name, con_mail, con_phone, reg_fencers) VALUES ('$f_name', '$f_country', '$f_email', $f_phone, '$c_name', '$c_email', '$c_phone', '$fencer_ids')";
$query_do = mysqli_query($connection, $query);

if(!$query_do){

echo mysqli_error($connection);

echo "KISGECI";
// Na ne beszélj csúnyán mert megmondalak 😎😎

}

?>