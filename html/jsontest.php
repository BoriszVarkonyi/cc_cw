<?php

// $stringJson = file_get_contents("test.json");

// //var_dump($stringJson);

// $jsonobj = json_decode($stringJson);

// //var_dump($jsonobj);

// //$actobj = $ja

// $testarray = [8, 4, 2, 1];


// foreach ($testarray as $numtouse) {

// if($numtouse == 1){

//     $headtext = "<h2 style='color:gold;background-color:brown;text-align:center'>☭☭☭☭☭☭☭☭☭☭☭☭☭☭☭     Winner:     ☭☭☭☭☭☭☭☭☭☭☭☭☭☭☭</h2>";

// }
// else{
//     $headtext = "<h2>table_of_" . $numtouse . "</h2>";
// }

// echo $headtext;

// if($numtouse != 1){

// echo "<br>";
// echo "<br>";
// }

// $usethis = "t_" . $numtouse;

//     foreach ($jsonobj->$usethis as $object) {

//         echo $object->f_1;

//         if($numtouse != 1){

//             echo "<br>";
//             echo "<b style='color:red;background-color:lightgrey'>VS";
//             echo "-----";
//             echo $object->time;
//             echo "-----";
//             echo $object->ref;
//             echo "-----";
//             echo "-----</b>";
//             echo "<br>";
//             echo $object->f_2;
//             echo "<br>";
//             echo "<br>";
//         }

//     }
// }

$anyad = new stdClass();

$anyad->picsaja = "nagy";
$anyad->melle = "kicsi";
$anyad->fia = "kagika";

print_r($anyad);


?>