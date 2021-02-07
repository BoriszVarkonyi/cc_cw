<?php include "includes\db.php"; ?>
<?php

$xml = simplexml_load_file("5700.xml");

//print_r($xml->[0]);

$query_text = "INSERT INTO `cptrs_559`(`id`, `name`, `nationality`, `rank`) VALUES ";

foreach($xml->Tireurs->children() as $fencers) {
    //echo $fencers['ID'] . ", " . $fencers["Prenom"] . ", " . $fencers["Nom"];

    $query_text .= "('" . $fencers['ID'] . "','" . $fencers["Nom"] . " " .  $fencers["Prenom"] . "','" .  $fencers["Club"] . "',";
    if($fencers["Classement"] == ""){

    $query_text .= "999" ."),";

    }else{

      $query_text .= $fencers["Classement"] ."),";

    }
  }
echo rtrim($query_text, ",");
  $query_text_do = mysqli_query($connection, rtrim($query_text, ","));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

</body>
</html>