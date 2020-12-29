<?php

$xml = simplexml_load_file("5699.xml");

//print_r($xml->[0]);


foreach($xml->Tireurs->children() as $fencers) {
    echo $fencers['ID'] . ", " . $fencers["Prenom"] . ", " . $fencers["Nom"];
    echo "<br>";
  }

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