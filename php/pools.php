<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

$query_get_fencers = "SELECT * FROM cptrs_$comp_id";
$query_get_fencers_do = mysqli_query($connection, $query_get_fencers);


$fencers = mysqli_num_rows($query_get_fencers_do);


$checkreg = 0;
$checkwc = 0;


while($row = mysqli_fetch_assoc($query_get_fencers_do)){

$reg = $row["reg"];
$wc = $row["wc"];

if($reg == 0){

$checkreg++;

}
if($wc == 0){

$checkwc ++;

}

}

if(isset($_POST["create_pools"])){

$query_create_table = "CREATE TABLE `pools_$comp_id` ( id INT NOT NULL AUTO_INCREMENT , pool_number INT NOT NULL , pool_of INT NOT NULL , f1 VARCHAR(255) NOT NULL , f2 VARCHAR(255) NOT NULL , f3 VARCHAR(255) NOT NULL , f4 VARCHAR(255) NOT NULL , f5 VARCHAR(255) NOT NULL , f6 VARCHAR(255) NOT NULL , f7 VARCHAR(255) NOT NULL , ref INT NOT NULL , ref2 INT NOT NULL , piste INT NOT NULL , time VARCHAR(255) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB;";
$query_create_table_do = mysqli_query($connection,$query_create_table);

if(!$query_create_table_do){

echo mysqli_error($connection);

}

$poolsnum = $_POST["pools_of"];

for ($i = 0; $i < $poolsnum; $i++) {
    ${$i . "_group_id"} = array();
    ${$i . "_group_f"} = array();
    ${$i . "_group_n"} = array();
}

$all_fencers_id = [];
$all_fencers_f = [];
$all_fencers_n = [];

$query_get_fencers = "SELECT * FROM cptrs_$comp_id";
$query_get_fencers_do = mysqli_query($connection, $query_get_fencers);

while($row = mysqli_fetch_assoc($query_get_fencers_do)){
    
$fid = $row["id"];
$fname = $row["name"];
$fnat = $row["nationality"];

array_push($all_fencers_id, $fid);
array_push($all_fencers_f, $fname);
array_push($all_fencers_n, $fnat);
}

$y = 0;
$change = 0;
$savegrouparray = array();
$savefencerarray = array();
for($x=0;$x < count($all_fencers_id); $x++){

if(!in_array($all_fencers_n[$x], ${$y . "_group_n"})){


    array_push(${$y . "_group_id"}, $all_fencers_id[$x]);
    array_push(${$y . "_group_f"}, $all_fencers_f[$x]);
    array_push(${$y . "_group_n"}, $all_fencers_n[$x]);


}else {
    
    array_push($savefencerarray, $x);
    array_push($savegrouparray, $y);

}



if($y < $poolsnum -1 && $change == 0){

$y++;

}
elseif($y == $poolsnum-1 && $change == 0){

    $y = $poolsnum-1;
    $change = 1;

}
elseif($y == $poolsnum-1 && $change == 1){

$y --;

}
elseif($y > 0) {

$y --;

}
elseif($y == 0){

$change = 0;

}

}

for ($l=0; $l < count($savegrouparray); $l++) {
    
$doit = 0;

    for ($k=0; $k < count($savefencerarray); $k++) { 
        
        if(!in_array($all_fencers_n[$savefencerarray[$k]], ${$savegrouparray[$l] . "_group_n"}) && $doit == 0 && $savefencerarray[$k] != "OFF"){

            array_push(${$savegrouparray[$l] . "_group_id"}, $all_fencers_id[$savefencerarray[$k]]);
            array_push(${$savegrouparray[$l] . "_group_f"}, $all_fencers_f[$savefencerarray[$k]]);
            array_push(${$savegrouparray[$l] . "_group_n"}, $all_fencers_n[$savefencerarray[$k]]);
            $savefencerarray[$k] = "OFF";
        
            $doit = 1;
        }

    }
}



//$szamolo = 0;
// for ($s=0; $s < count($savefencerarray) + 1 ; $s++) { 
    
//     if($savefencerarray[$s] == "OFF"){
//         unset($savefencerarray[$s]);
//         //$szamolo++;
//     }

// }

$doornot = 0;

foreach ($savefencerarray as $check) {
    if($check != "OFF"){
 $doornot++;
    }
}



print_r($all_fencers_n);

$xd = 0;

if($doornot != 0){

print_r($savefencerarray);

foreach ($savefencerarray as $key) {
    
echo $key;

$getrekt = 0;

if($key == "OFF"){

    echo "//TOV//";
continue;

}
else{


    $h = array_search($key, $savefencerarray);

    echo($h);
    
    $annalkisebb = count(${$xd . "_group_n"});
    $toplace = 0;
    
    for ($c=0; $c < $poolsnum; $c++) { 
        
    if($annalkisebb > count(${$c . "_group_n"})){
    
        $annalkisebb = count(${$c . "_group_n"});
    
        $toplace = $c;
    
    }
    
    $fencertoplace = array_search($savefencerarray[$h], $all_fencers_n);

    }
    print_r($savefencerarray);
    
        array_push(${$toplace . "_group_id"}, $all_fencers_id[$key]);
        array_push(${$toplace . "_group_f"}, $all_fencers_f[$key]);
        array_push(${$toplace . "_group_n"}, $all_fencers_n[$key]);



}



}

print_r(${"0" . "_group_n"});
echo $toplace;
}

// $temp = count($savefencerarray);


// for ($h=0; $h < $temp; $h++) { 

// if(!isset($savefencerarray[$h]) || $savefencerarray[$h] == "OFF"){

// continue;

// }



//REPEAT

// $xd = 0;
// if(count($savefencerarray) > 0){

// for ($h=0; $h < count($savefencerarray); $h++) { 



//     $annalkisebb = count(${$xd . "_group_n"});

// for ($c=0; $c < $poolsnum; $c++) { 
    
// if($annalkisebb > count(${$c . "_group_n"})){

//     $annalkisebb = count(${$c . "_group_n"});

//     $toplace = $c;

// }


// }

// array_push(${$toplace . "_group_id"}, $all_fencers_id[$savefencerarray[$h /*+ $szamolo]*/]]);
// array_push(${$toplace . "_group_f"}, $all_fencers_f[$savefencerarray[$h /*+ $szamolo]*/]]);
// array_push(${$toplace . "_group_n"}, $all_fencers_n[$savefencerarray[$h /*+ $szamolo]*/]]);

// }
// }
// if(count($savefencerarray) > 0){

// for ($h=0; $h < count($savefencerarray); $h++) { 



//     $annalkisebb = count(${$xd . "_group_n"});

// for ($c=0; $c < $poolsnum; $c++) { 
    
// if($annalkisebb > count(${$c . "_group_n"})){

//     $annalkisebb = count(${$c . "_group_n"});

//     $toplace = $c;

// }


// }

// array_push(${$toplace . "_group_id"}, $all_fencers_id[$savefencerarray[$h /*+ $szamolo]*/]]);
// array_push(${$toplace . "_group_f"}, $all_fencers_f[$savefencerarray[$h /*+ $szamolo]*/]]);
// array_push(${$toplace . "_group_n"}, $all_fencers_n[$savefencerarray[$h /*+ $szamolo]*/]]);

// }
// }


//print_r($all_fencers_id);
//print_r($all_fencers_n);

for ($i=0; $i < $poolsnum; $i++) { 
  //print_r(${$i . "_group_id"});
  //print_r(${$i . "_group_f"});
  //print_r(${$i . "_group_n"});
}

//print_r($savegrouparray);
//print_r($savefencerarray);

$querypart = "INSERT INTO `pools_$comp_id`(`pool_number`, `pool_of`, `f1`, `f2`, `f3`, `f4`, `f5`, `f6`, `f7`) VALUES ";
$poolserial = 1;

$comma = 0;

for ($n=0; $n < $poolsnum; $n++) {
    
    //print_r(${$n . "_group_id"});

    $poolof = count(${$n . "_group_id"});

    for ($z=0; $z < $poolof; $z++) { 

        ${"id_" . $z} = ${$n . "_group_id"}[$z];

    }
    
    for ($r=0; $r <= 6 - $poolof; $r++) { 
        
            $cunterka = $poolof + $r;
    
            //echo $cunterka;
    
            ${"id_" . $cunterka} = "";

    }
    for ($u=0; $u < $poolsnum; $u++) { 
        
        for ($q=0; $q < count(${$n . "_group_id"}); $q++) { 

            if (${$u . "_group_id"}[$q] == "") {
                
                unset(${$u . "_group_id"}[$q]);

            }

        }

    }


    

    if($comma == 1){

    $querypart .= ",";

    }


    $querypart .= "($poolserial,$poolof,'$id_0','$id_1','$id_2','$id_3','$id_4','$id_5','$id_6')";

    $poolserial++;
    $comma = 1;

}

echo $querypart;


$query_do = mysqli_query($connection, $querypart);

if(!$query_do){

    echo mysqli_error($connection);

}

header("Location: pools.php?comp_id=$comp_id");

}


if(isset($_POST["piste_time"])){

$start =  $_POST["starting_time"];
$interval = $_POST["interval_of_match"];
$usage = $_POST["pistes_usage_type"];

if($usage == 1){

$pistes_query = "SELECT * FROM pistes_$comp_id";
$pistes_query_do = mysqli_query($connection, $pistes_query);

$p_number = mysqli_num_rows($pistes_query_do);

$pistes_available = [];

while($row = mysqli_fetch_assoc($pistes_query_do)){

$pistenum = $row["piste_number"];

array_push($pistes_available, $pistenum);

}


$pools_get_query = "SELECT * FROM pools_$comp_id";
$pools_get_query_do = mysqli_query($connection, $pools_get_query);

$pools_count = mysqli_num_rows($pools_get_query_do);

$cou = 0;
$rec = 0;

while($row = mysqli_fetch_assoc($pools_get_query_do)){

$id = $row["id"];

if(isset($pistes_available[$cou])){

$timevar = strtotime($start) + $rec * 60 * $interval;
$timevarend = date('H:i', $timevar);

$update_piste_query = "UPDATE pools_$comp_id SET piste = $pistes_available[$cou], time = '$timevarend' WHERE id = $id";
$update_piste_query_do = mysqli_query($connection, $update_piste_query);

    $cou++;

}
else {

    $cou = 0;
    $rec++;

    
$timevar = strtotime($start) + $rec * 60 * $interval;
$timevarend = date('H:i', $timevar);

$update_piste_query = "UPDATE pools_$comp_id SET piste = $pistes_available[$cou], time = '$timevarend' WHERE id = $id";
$update_piste_query_do = mysqli_query($connection, $update_piste_query);

$cou++;
}
}
}
header("Location: pools.php?comp_id=$comp_id");
}






$ARRAY_pool_nat = [];

//go through rows as pools
$query_get_pools = "SELECT * FROM `pools_$comp_id`";
$query_get_pools_do = mysqli_query($connection, $query_get_pools);

while($row = mysqli_fetch_assoc($query_get_pools_do)){
    $pool_of = $row['pool_of'];
    $pool_num = $row['pool_number'];

    $current_pool = "pool_" . $pool_num;
    $ARRAY_pool_nat[$current_pool] = [];

    //go through fencers (f{n} columns)
    for ($i = 1; $i <= $pool_of; $i++) {

        //get fencer id
        $qry_get_fencer_id = "SELECT `f$i` FROM `pools_$comp_id` WHERE `pool_number` = '$pool_num'";
        $do_get_fencer_id = mysqli_query($connection, $qry_get_fencer_id);

        if ($row1 = mysqli_fetch_assoc($do_get_fencer_id)) {
            $fencer_id = $row1["f$i"];
        } else {
            echo mysqli_error($connection) . "error on line 519!";
        }

        //get fencer nat by id
        $qry_get_fencer_nat = "SELECT `nationality` FROM `cptrs_$comp_id` WHERE `id` = '$fencer_id'";
        $do_get_fencer_id = mysqli_query($connection, $qry_get_fencer_nat);

        if ($row2 = mysqli_fetch_assoc($do_get_fencer_id)) {
            $fencer_nat = $row2['nationality'];

            //test if nat is already in the array
            if (array_search($fencer_nat, $ARRAY_pool_nat[$current_pool]) === FALSE) {
                array_push($ARRAY_pool_nat[$current_pool], $fencer_nat);
            }
        } else {
            echo mysqli_error($connection) . "error on line 529!";
        }
    }
}


//get refs from form

if(isset($_POST["draw_ref"])){

    if ($_POST['ref_select'] == 'all_ref') {
        $get_ref = "SELECT * FROM ref_$comp_id EXCEPT SELECT * FROM ref_$comp_id WHERE `online` = 1 ";
    } else {

        $where_clause = "";
        $ref_query = "SELECT * FROM ref_$comp_id EXCEPT SELECT * FROM ref_$comp_id WHERE `online` = 1 ";
        $ref_query_do = mysqli_query($connection, $ref_query);
        
        while($row =  mysqli_fetch_assoc($ref_query_do)) {

            $refid = $row["id"];

            if ($_POST["ref_$ref_id"] == 'checked') {
                $where += $refid . ", ";
            }
        
        }

        $where = substr($where, 0, -1);

        $get_ref = "SELECT * FROM `ref_$comp_id` WHERE `id` IN ('$where');";

    }

    $get_ref_do = mysqli_query($connection, $get_ref);

    $array_ref_nat = [];

    while ($row = mysqli_fetch_assoc($get_ref_do)) {

        $ref_id = $row['id'];
        $ref_nat = $row['nat'];
        $ref_online = 0;

        $array_ref_nat[$ref_id] = ["nat" => $ref_nat, "online" => $ref_online];
    }
    $ref_assigned_pools = [];
    //create array of pools to assign to refs
    for ($i = 1; $i <= $pool_num; $i++) {
        $ref_assigned_pools["pool_" . $i] = "";
    }
    
    //assign ref to the pools based on nat and pool nat
    foreach ($ref_assigned_pools as $pool => $assigned_ref) {

        if ($assigned_ref == "") {
            foreach ($array_ref_nat as $current_ref_id) {
                if ($current_ref_id['online'] == 0 && array_search($current_ref_id['nat'], $ARRAY_pool_nat[$pool]) === FALSE) {
                    $ref_assigned_pools[$pool] = ["ref_1" => key($current_ref_id), "ref_2" => ""];
                    $current_ref_id['online'] = 1;
                }
            }
        }
    }
    unset($pool, $current_ref_id, $assigned_ref);

    //assign ref and second ref to pools where there is no ref
    foreach ($ref_assigned_pools as $pool => $assigned_ref){
        if ($assigned_ref['ref_1'] == "") {
            foreach ($array_ref_nat as $current_ref_id) {
                if ($current_ref_id['online'] == 0) {
                    $ref_assigned_pools[$pool]['ref_1'] = key($current_ref_id);

                    //search for 2. ref
                    foreach ($array_ref_nat as $current_ref_id_sec) {
                        if ($current_ref['nat'] != $current_ref_id_sec['nat']) {
                            $current_ref_id_sec['online'] = 1;
                            $ref_assigned_pools['ref_2'] = key($current_ref_id_sec);
                        }
                    }
                }
            }
        }
    }

    //test for pool with no ref if true return not possible!


    
    echo "asdasdasd";
    print_r($ref_assigned_pools);
}

print_r($ARRAY_pool_nat);
print_r($array_ref_nat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pools of <?php echo $comp_name ?></title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Pools</p>


<?php


$query_ex = "SELECT * 
FROM `information_schema`.`tables`
WHERE table_schema = 'ccdatabase' 
    AND table_name = 'pools_$comp_id'
LIMIT 1;";
$query_ex_do = mysqli_query($connection, $query_ex);

$exist = mysqli_num_rows($query_ex_do);

if($exist == 0){

?>

                STATE: 0

                <button class="stripe_button orange" onclick="generatePanel()" type="submit">
                    <p>Generate Pools</p>
                    <img src="../assets/icons/add_box-black-18dp.svg" />
                </button>

                <div id="ref_pis_time_panel" class="overlay_panel">
                    <button class="panel_button" onclick="refPisTimePanel()">
                        <img src="../assets/icons/close-black-18dp.svg" >
                    </button>
                    <p class="panel_title <?php if($checkwc == 0 && $checkreg == 0){echo "green";}else{echo "red";} ?>"><?php if($checkwc == 0 && $checkreg == 0){echo "Everyone is ready to fence";}else{echo "Not everyone is ready to fence";} ?></p>
                    <form action="" method="post"  autocomplete="off" class="overlay_panel_form dense flex">
                        <label for="starting_time" >STRIVE FOR</label>
                        <div class="option_container">
                            <input type="text" class="hidden" id="fencer_quantity" value="<?php echo $fencers ?>">
                            <input type="radio" class="option_button" name="pools_of" id="7" value="" onclick=""/>
                            <label for="7" class="option_label">Pools of 7</label>
                            <p id="p_7"></p>
                            <input type="radio" class="option_button" name="pools_of" id="6" value="" onclick=""/>
                            <label for="6" class="option_label">Pools of 6</label>
                            <p id="p_6"></p>
                            <input type="radio" class="option_button" name="pools_of" id="5" value="" onclick=""/>
                            <label for="5" class="option_label">Pools of 5</label>
                            <p id="p_5"></p>
                            <input type="radio" class="option_button" name="pools_of" id="4" value="" onclick=""/>
                            <label for="4" class="option_label">Pools of 4</label>
                            <p id="p_4"></p>
                        </div>

                        <label for="interval_of_match">NUMBER OF QUALIFIERS</label>
                        <input type="number" placeholder="#" class="number_input extra_small">

                        <label for="pistes_type" >STATISTICS</label>

                        <table class="pools_stat_table">
                            <thead>
                                <th>Percent</th>
                                <th>Number of Fencers</th>
                            </thead>
                            <tr>
                                <td>All</td>
                                <td><?php echo $fencers ?></td>
                            <tr>
                            <tr>
                                <td>80%</td>
                                <td><?php echo round($fencers * 0.8) ?></td>
                            <tr>
                            <tr>
                                <td>70%</td>
                                <td><?php echo round($fencers * 0.7) ?></td>
                            <tr>
                        </table>
                        <button type="submit" name="create_pools" value="Save" class="panel_submit">Create</button>
                    </form>
                </div>

<?php
}
else
{

?>

                STATE: 1 

                <button class="stripe_button disabled" type="button">
                    <p>Send Message to Fencer</p>
                    <img src="../assets/icons/message-black-18dp.svg" />
                </button>

                <button class="stripe_button bold" type="button" onclick="toggleRefPanel()">
                    <p>Referees</p>
                    <img src="../assets/icons/ballot-black-18dp.svg"/>
                </button>

                <button class="stripe_button bold" type="button" onclick="togglePistTimePanel()">
                    <p>Pistes & Time</p>
                    <img src="../assets/icons/ballot-black-18dp.svg"/>
                </button>

                <button class="stripe_button orange" type="submit">
                    <p>Save Pools</p>
                    <img src="../assets/icons/save-black-18dp.svg" />
                </button>
                
                <button class="stripe_button orange" type="submit">
                    <p>Start Pools</p>
                    <img src="../assets/icons/outlined_flag-black-18dp.svg" />
                </button>
                <div id="ref_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="toggleRefPanel()">
                        <img src="../assets/icons/close-black-18dp.svg" >
                    </button>
                    <form action="" method="post"  autocomplete="off" class="overlay_panel_form dense flex">
                        <label for="ref_type">REFEREES CAN MATCH WITH SAME NATIONALITY / CLUB FENCER</label>
                        <div class="option_container row">
                            <input type="checkbox" name="pistes_type" id="true" value=""/>
                            <label for="true">True</label>
                        </div>
                        <label for="all_ref">SELECT REFEREES</label>
                        <div class="option_container row">
                            <input type="radio" name="ref_select" checked id="all_ref" onclick="useAllReferees()" value="all_ref"/>
                            <label for="all_ref">Use all</label>

                            <input type="radio" name="ref_select" id="manual_select_ref" onclick="selectReferees()" value="manual_select_ref"/>
                            <label for="manual_select_ref">Select manually</label>
                        </div>

                        <div class="option_container grid piste_select disabled" id="select_referees_panel" >
                                
                        <?php
                                
                                $ref_query = "SELECT * FROM ref_$comp_id EXCEPT SELECT * FROM ref_$comp_id WHERE online = 1";
                                $ref_query_do = mysqli_query($connection, $ref_query);
                            
                                while($row =  mysqli_fetch_assoc($ref_query_do)){

                                $refid = $row["id"];
                                $fullname = $row["full_name"];

                                
                                ?>
                                
                                <div class="piste_select">
                                    <input type="checkbox" name="ref_<?php echo $refid ?>" id="ref_<?php echo $refid ?>" value="value1"/>
                                    <label for="ref_<?php echo $refid ?>"><?php echo $fullname ?></label>
                                </div>

                                <?php
                                
                                }
                                
                                ?>
                        </div>
                        <button type="submit" name="draw_ref" value="Save" class="panel_submit" id="rfrsSaveButton">Save</button>
                    </form>
                </div>




                <div id="pist_time_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="togglePistTimePanel()">
                        <img src="../assets/icons/close-black-18dp.svg" >
                    </button>
                    <form action="" method="post"  autocomplete="off" class="overlay_panel_form dense flex">
                        <label for="starting_time" >STARTING TIME</label>
                        <input type="time" id="startingTimeInput" name="starting_time">

                        <label for="interval_of_match" >INTERVAL OF MATCH</label>
                        <div id="interval_of_match_wrapper">
                            <input type="number" class="number_input small" name="interval_of_match" id="timeInput">
                            <p>Min.</p>
                        </div>

                        <label for="pistes_type" >PISTES</label>
                        <div class="option_container row">
                            <input type="radio" name="pistes_usage_type" checked id="all" onclick="useAllPistes()" value="1"/>
                            <label for="all">Use all</label>

                            <input type="radio" name="pistes_usage_type" id="manual_select" onclick="selectPistes()" value="2"/>
                            <label for="manual_select">Select manually</label>
                        </div>

                        <div class="option_container grid piste_select disabled" id="select_pistes_panel" >
                                
                                <?php
                                
                                $pistes_query = "SELECT * FROM pistes_$comp_id EXCEPT SELECT * FROM pistes_$comp_id WHERE piste_activity = 1";
                                $pistes_query_do = mysqli_query($connection, $pistes_query);
                                
                                $r = 0;
                                while($row =  mysqli_fetch_assoc($pistes_query_do)){

                                $pistenum = $row["piste_number"];
                                $pistetype = $row["piste_type"];
                                $pistecolor = $row["piste_color"];

                                
                                ?>
                                

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_<?php echo $r ?>" id="piste_<?php echo $r ?>" value=""/>
                                    <label for="piste_<?php echo $r ?>">Piste <?php 
                                    
                                    if($pistetype == 1){

                                        echo "main";

                                    }elseif($pistetype == 2){

                                    echo  $pistenum . " (" . pisteColor($pistecolor) . ")";

                                    }
                                    else {
                                        echo $pistenum;
                                    }
                                    
                                    
                                     ?></label>
                                </div>

                                <?php
                                $r++;
                                }
                                ?>
                            
                                
                        </div>

                        <button type="submit" name="piste_time" value="Save" class="panel_submit" id="pNtSaveButton">Save</button>
                    </form>
                </div>






<?php } ?>
                
<!--
                STATE: 2
                
                <button class="stripe_button" type="button">
                    <p>Open CC Match Control</p>
                    <img src="../assets/icons/pages-black-18dp.svg" />
                </button>
-->
                

            </div>
            <div id="page_content_panel_main">

             <?php
             
             if($exist == 0){
             ?>

                STATE: 0

                <div id="no_something_panel">
                    <p>You have no pools generated!</p>
                </div>
<?php
}
else{
    ?>

                <div id="pools_wrapper">

                    nem finális verzió anim á ci ó
                    <div id="pool_listing" class="with_drag"> 


                        <?php
                        
                        $query_get_group_number = "SELECT * FROM pools_$comp_id";
                        $query_get_group_number_do = mysqli_query($connection, $query_get_group_number);
                        
                        $szor = mysqli_num_rows($query_get_group_number_do);

                        for ($i=1; $i <= $szor; $i++) { 
                            
                            $inside_query = "SELECT * FROM pools_$comp_id WHERE pool_number = $i";
                            $inside_query_do = mysqli_query($connection,$inside_query);

                            if($row = mysqli_fetch_assoc($inside_query_do)){

                            $pool_f_in = $row["pool_of"];
                            $f1 = $row["f1"];
                            $f2 = $row["f2"];
                            $f3 = $row["f3"];
                            $f4 = $row["f4"];
                            $f5 = $row["f5"];
                            $f6 = $row["f6"];
                            $f7 = $row["f7"];
                            $ref = $row["ref"];
                            $piste = $row["piste"];
                            $time = $row["time"];

                        }

                        $get_ref_name = "SELECT * FROM ref_$comp_id WHERE id = $ref";
                        $get_ref_name_do = mysqli_query($connection, $get_ref_name);

                        if($refrow = mysqli_fetch_assoc($get_ref_name_do)){

                            $refname = $refrow["full_name"];
                            $refnat = $refrow["nat"];

                        }


                        $get_group_fencers_query = "SELECT * FROM cptrs_$comp_id WHERE id IN ('$f1','$f2','$f3','$f4','$f5','$f6','$f7')";
                        $get_group_fencers_query_do = mysqli_query($connection, $get_group_fencers_query);

                        $cla = 0;
                        while($row = mysqli_fetch_assoc($get_group_fencers_query_do)){

                            ${$cla . "_f_n"} = $row["name"];
                            ${$cla . "_f_na"} = $row["nationality"];
                            ${$cla . "_f_id"} = $row["id"];
                            $cla++;

                        }
                        
                        ?>

                        <div>
                        <div class="entry">
                            <div class="table_row">
                                <div class="table_item bold">No.<?php echo $i ?></div>
                                <div class="table_item">Piste <?php echo $piste ?></div>
                                <div class="table_item">Ref: <?php echo $refname ?> (<?php echo $refnat ?>)</div>
                                <div class="table_item"><?php echo $time ?></div>
                                <div class="big_status_item">
                                    <button type="button" onclick="" class="pool_config">
                                        <img src="../assets/icons/settings-black-18dp.svg" >
                                    </button>
                                </div>
                            </div>
                            <div class="entry_panel gray">
                                <div class="pool_table_wrapper table">
                                    <div class="table_header">
                                        <div class="table_header_text">
                                            name
                                        </div>
                                        <div class="table_header_text">
                                            nation
                                        </div>

                                        <div class="table_header_text square">
                                            Cp
                                        </div>

                                        <div class="table_header_text square">
                                            rp
                                        </div>
                                        
                                    </div>
                                    <div class="table_row_wrapper" ondragover="tableWrapperHoverOn(this)" ondragleave="tableWrapperHoverOff(this)">
                                        <div class="table_row_drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"></div>
                                        <?php
                                        for ($n=0; $n < $pool_f_in; $n++) { 

                                            ?>
                                            
                                            <div class="table_row">
                                                <div class="table_item"><p class="drag_fencer" draggable="true" ondragstart="drag(event, this)" ondragend="dragEnd(this)" id="<?php echo ${$n . "_f_id"} ?>"><?php echo ${$n . "_f_n"} ?></p></div>
                                                <div class="table_item"><p><?php echo ${$n . "_f_na"} ?></p></div>
                                                <div class="table_item square"><p>1</p></div>
                                                <div class="table_item square"><p>1</p></div>
                                            </div>
                                            <div class="table_row_drop" ondragover="dropAreaHoverOn(this), allowDrop(event)" ondragleave="dropAreaHoverOff(this)" ondrop="drop2(event, this)"></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>


<?php
}
?>



                    </div>
                    <div id="pools_drag_panel" ondrop="drop(event)" ondragover="allowDrop(event)">
                    </div>

                    <?php } ?>
<!--
                    STATE: 2 
                    <div id="pool_listing"> 
                        <div class="entry" >
                            <div class="table_row start">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                                <button type="button" onclick="" class="pool_config">
                                    <img src="../assets/icons/settings-black-18dp.svg" >
                                </button>
                            </div>
                            <div class="entry_panel">
                                <div class="pool_table_wrapper">
                                    <div class="table_header">
                                        <div class="table_header_text">
                                            Fencers name
                                        </div>
                                        <div class="table_header_text">
                                            Fencers nationality
                                        </div>

                                        <div class="table_header_text square">
                                            No.
                                        </div>

                                        <div class="table_header_text square">
                                            1
                                        </div>

                                        <div class="table_header_text square">
                                            2
                                        </div>

                                        <div class="table_header_text square">
                                            3
                                        </div>

                                        <div class="table_header_text square">
                                            4
                                        </div>

                                        <div class="table_header_text square">
                                            5
                                        </div>

                                        <div class="table_header_text square">
                                            6
                                        </div>

                                        <div class="table_header_text square">
                                            W
                                        </div>

                                        <div class="table_header_text square">
                                            L
                                        </div>

                                        <div class="table_header_text square">
                                            TR
                                        </div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">1</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">2</div>
                                        <div class="table_item square">a</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">3</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">as</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>


                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">5</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">6</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">ge</div>
                                        <div class="table_item square  filled"></div>
                                        
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry" >
                            <div class="table_row start">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                                <button type="button" onclick="" class="pool_config">
                                    <img src="../assets/icons/settings-black-18dp.svg" >
                                </button>
                            </div>
                            <div class="entry_panel gray">
                                <div class="pool_table_wrapper">
                                    <div class="table_header">
                                        <div class="table_header_text">
                                            Fencers name
                                        </div>
                                        <div class="table_header_text">
                                            Fencers nationality
                                        </div>

                                        <div class="table_header_text square">
                                            No.
                                        </div>

                                        <div class="table_header_text square">
                                            1
                                        </div>

                                        <div class="table_header_text square">
                                            2
                                        </div>

                                        <div class="table_header_text square">
                                            3
                                        </div>

                                        <div class="table_header_text square">
                                            4
                                        </div>

                                        <div class="table_header_text square">
                                            5
                                        </div>

                                        <div class="table_header_text square">
                                            6
                                        </div>

                                        <div class="table_header_text square">
                                            W
                                        </div>

                                        <div class="table_header_text square">
                                            L
                                        </div>

                                        <div class="table_header_text square">
                                            TR
                                        </div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">1</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">2</div>
                                        <div class="table_item square">a</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">3</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">as</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>


                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">5</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">6</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">ge</div>
                                        <div class="table_item square  filled"></div>
                                        
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry" >
                            <div class="table_row start">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                                <button type="button" onclick="" class="pool_config">
                                    <img src="../assets/icons/settings-black-18dp.svg" >
                                </button>
                            </div>
                            <div class="entry_panel gray">
                                <div class="pool_table_wrapper">
                                    <div class="table_header">
                                        <div class="table_header_text">
                                            Fencers name
                                        </div>
                                        <div class="table_header_text">
                                            Fencers nationality
                                        </div>

                                        <div class="table_header_text square">
                                            No.
                                        </div>

                                        <div class="table_header_text square">
                                            1
                                        </div>

                                        <div class="table_header_text square">
                                            2
                                        </div>

                                        <div class="table_header_text square">
                                            3
                                        </div>

                                        <div class="table_header_text square">
                                            4
                                        </div>

                                        <div class="table_header_text square">
                                            5
                                        </div>

                                        <div class="table_header_text square">
                                            6
                                        </div>

                                        <div class="table_header_text square">
                                            W
                                        </div>

                                        <div class="table_header_text square">
                                            L
                                        </div>

                                        <div class="table_header_text square">
                                            TR
                                        </div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">1</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">2</div>
                                        <div class="table_item square">a</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">3</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">as</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>


                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">5</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">6</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">ge</div>
                                        <div class="table_item square  filled"></div>
                                        
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry" >
                            <div class="table_row start">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                                <button type="button" onclick="" class="pool_config">
                                    <img src="../assets/icons/settings-black-18dp.svg" >
                                </button>
                            </div>
                            <div class="entry_panel gray">
                                <div class="pool_table_wrapper">
                                    <div class="table_header">
                                        <div class="table_header_text">
                                            Fencers name
                                        </div>
                                        <div class="table_header_text">
                                            Fencers nationality
                                        </div>

                                        <div class="table_header_text square">
                                            No.
                                        </div>

                                        <div class="table_header_text square">
                                            1
                                        </div>

                                        <div class="table_header_text square">
                                            2
                                        </div>

                                        <div class="table_header_text square">
                                            3
                                        </div>

                                        <div class="table_header_text square">
                                            4
                                        </div>

                                        <div class="table_header_text square">
                                            5
                                        </div>

                                        <div class="table_header_text square">
                                            6
                                        </div>

                                        <div class="table_header_text square">
                                            W
                                        </div>

                                        <div class="table_header_text square">
                                            L
                                        </div>

                                        <div class="table_header_text square">
                                            TR
                                        </div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">1</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">2</div>
                                        <div class="table_item square">a</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">3</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">as</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>


                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">5</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">gr</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square">5a</div>

                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>

                                    
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">6</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">a4</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">ge</div>
                                        <div class="table_item square  filled"></div>
                                        
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                        <div class="table_item square">5a</div>
                                    </div>
                                </div>
                            </div>
-->
                        </div>
                    </div>

                    
                </div>

            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/pools.js"></script>
</html>