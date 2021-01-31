<?php include "../includes/functions.php"; ?>

<?php
error_reporting(E_ERROR | E_PARSE);

$tables = [1,2,4,8,16,32,64,128,256,512,1024];

$fencernum = 16;

foreach($tables as $x){

    if($x >= $fencernum){
        $tablesize = $x;
        break;
    }

}



// while($tablesize > 1){

// $table = tableArrays($tablesize);

// echo "<h1>" . $tablesize . "</h1>";

//     $midc = 0;

//     for ($i=0; $i < count($table); $i++) { 
        
//         if($midc == 0){
    
//             if($i != 0){
//                 echo "<br><br><br>";
//             }
    
       
//         echo $table[$i] . "-----------------------";
//         echo "<br>" . "VS" . "<br>";
    
//         $midc++;
    
//         }
//         else{
//         echo $table[$i] . "-----------------------";
//         $midc = 0;
//         }
    
//     }

//     $tablesize = $tablesize / 2;

// }

$jsontest = new stdClass();

while($tablesize > 1){

$table = tableArrays($tablesize);

$namevariable = "t_" . $tablesize;

$matchcounter = 1;
$midc = 0;
for ($i=0; $i < count($table); $i++) { 
    
    if($midc == 2){
    
    $matchcounter++;
    $midc = 0;

    }
    $matchwriteout = "m_" . $matchcounter;
    $postowrite = $table[$i];
    $jsontest->$namevariable->$matchwriteout->$postowrite = "vivo";


    $midc++;
}

$tablesize = $tablesize/2;
}

// print_r($jsontest);

// echo "<br><br><br><br><br>";

// echo json_encode($jsontest);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
* {
  box-sizing: border-box;
}

.row {
  display: flex;
}

/* Create two equal columns that sits next to each other */
.column {
  flex: 50%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}
</style>
</head>
<body>
<div class="row">
    <?php
    

    foreach($jsontest as $key=>$tableturn){

    $fencersintr = $key;

    echo "<div class='column'>";
    echo $fencersintr;

    print_r($ac_table = tableArrays(ltrim($fencersintr, "t_")));

    $m_counter = 0;

      foreach($tableturn as $matches){

        echo "<br><br>";

        echo $matches->{$ac_table[$m_counter]} . "<br>";
        $m_counter++;
        echo "VS" . "<br>";
        echo $matches->{$ac_table[$m_counter]};
        $m_counter++;
        

        

      }
    


    echo "</div>";
    }
    
    
    
    
    
    ?>
</div>
</body>
</html>