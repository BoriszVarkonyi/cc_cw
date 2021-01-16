<?php

$stringJson = file_get_contents("test.json");

//var_dump($stringJson);

$jsonobj = json_decode($stringJson);

//var_dump($jsonobj);

$jsonobj->csalad[1] = "APUKA";
$jsonobj->csalad[2] = "Anyuka";

$jsonobj->baratok[1] = "Gecim";
$jsonobj->baratok[2] = "Kris";

echo $jsonobj->csalad[2];
echo "<br>";
echo $jsonobj->baratok[1];
echo "<br>";
echo "<br>";
echo json_encode($jsonobj);


?>