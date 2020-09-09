<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
$comp_org = $_COOKIE["org_id"];

$exist = mysqli_query($connection, "SELECT 1 FROM fencers_$comp_org");

if($exist){

echo "KUTYA";

}
else{

    $create_table = "CREATE TABLE `ccdatabase`.`fencers_$comp_org` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `position` INT(11) NOT NULL , `name` VARCHAR(255) NOT NULL , `dob` DATE NOT NULL  , `nationality` VARCHAR(255) NOT NULL , `licence` INT(11) NOT NULL , `pre_registered` INT(11) NOT NULL DEFAULT '0' , `competition` INT(11) NOT NULL, `allowed` INT NOT NULL , `registered` INT NOT NULL , `weapon_control` INT NOT NULL , `temp_position` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $create_table_do = mysqli_query($connection, $create_table);

}



$target_dir = "uploads/";
$target_file = $target_dir . $_FILES["ranking_excel"]["name"];

if(isset($_POST["submit"])) {

move_uploaded_file($_FILES["ranking_excel"]["tmp_name"], $target_file);

}

$path = realpath($target_file);
$path_real = str_replace("\\","/",$path);


$query = "LOAD DATA INFILE '$path_real' INTO TABLE fencers_$comp_org FIELDS TERMINATED BY ','LINES TERMINATED BY '\n'(position,name,nationality,licence) ";
$query_do = mysqli_query($connection, $query);

unlink($path);

$query = "UPDATE fencers_$comp_org SET competition = $comp_id WHERE competition = 0";
$query_do = mysqli_query($connection, $query);

header("Location: ranking.php?comp_id=$comp_id");
?>