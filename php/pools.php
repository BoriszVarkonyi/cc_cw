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

$query_create_table = "CREATE TABLE `pools_$comp_id` ( id INT NOT NULL AUTO_INCREMENT , pool_number INT NOT NULL , pool_of INT NOT NULL , f1 VARCHAR(255) NOT NULL , f2 VARCHAR(255) NOT NULL , f3 VARCHAR(255) NOT NULL , f4 VARCHAR(255) NOT NULL , f5 VARCHAR(255) NOT NULL , f6 VARCHAR(255) NOT NULL , f7 VARCHAR(255) NOT NULL , ref INT NOT NULL , piste INT NOT NULL , time VARCHAR(255) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB;";
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
for ($s=0; $s < count($savefencerarray) + 1 ; $s++) { 
    
    if($savefencerarray[$s] == "OFF"){
        unset($savefencerarray[$s]);
        //$szamolo++;
    }

}
$xd = 0;
if(count($savefencerarray) > 0){

for ($h=0; $h < count($savefencerarray); $h++) { 



    $annalkisebb = count(${$xd . "_group_n"});

for ($c=0; $c < $poolsnum; $c++) { 
    
if($annalkisebb > count(${$c . "_group_n"}) && !in_array($all_fencers_n[$savefencerarray[$h]], ${$c . "_group_n"})){

    $annalkisebb = count(${$c . "_group_n"});

    $toplace = $c;

    $fencertoplace = $savefencerarray[$h];

    unset($savefencerarray[$h]);

}


}

array_push(${$toplace . "_group_id"}, $all_fencers_id[$fencertoplace /*+ $szamolo]*/]);
array_push(${$toplace . "_group_f"}, $all_fencers_f[$fencertoplace /*+ $szamolo]*/]);
array_push(${$toplace . "_group_n"}, $all_fencers_n[$fencertoplace /*+ $szamolo]*/]);
}
}

//REPEAT

$xd = 0;
if(count($savefencerarray) > 0){

for ($h=0; $h < count($savefencerarray); $h++) { 



    $annalkisebb = count(${$xd . "_group_n"});

for ($c=0; $c < $poolsnum; $c++) { 
    
if($annalkisebb > count(${$c . "_group_n"})){

    $annalkisebb = count(${$c . "_group_n"});

    $toplace = $c;

}


}

array_push(${$toplace . "_group_id"}, $all_fencers_id[$savefencerarray[$h /*+ $szamolo]*/]]);
array_push(${$toplace . "_group_f"}, $all_fencers_f[$savefencerarray[$h /*+ $szamolo]*/]]);
array_push(${$toplace . "_group_n"}, $all_fencers_n[$savefencerarray[$h /*+ $szamolo]*/]]);

}
}


print_r($all_fencers_id);
print_r($all_fencers_n);

for ($i=0; $i < $poolsnum; $i++) { 
  print_r(${$i . "_group_id"});
  print_r(${$i . "_group_f"});
  print_r(${$i . "_group_n"});
}

print_r($savegrouparray);
print_r($savefencerarray);

$querypart = "INSERT INTO `pools_$comp_id`(`pool_number`, `pool_of`, `f1`, `f2`, `f3`, `f4`, `f5`, `f6`, `f7`) VALUES ";
$poolserial = 1;

$comma = 0;

for ($n=0; $n < $poolsnum; $n++) {
    
    $poolof = count(${$n . "_group_id"});

    for ($z=0; $z < $poolof; $z++) { 

        ${"id_" . $z} = ${$n . "_group_id"}[$z];

    }
    
    for ($r=0; $r <= 6 - $poolof; $r++) { 
        
            $cunterka = $poolof + $r;
    
            //echo $cunterka;
    
            ${"id_" . $cunterka} = "";

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








?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pools of {Comp anme}</title>
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
                            <input type="checkbox" name="pistes_type" checked id="true" value=""/>
                            <label for="true">True</label>
                        </div>
                        <label for="pistes_type">SELECT REFEREES</label>
                        <div class="option_container row">
                            <input type="radio" name="pistes_type" checked id="all_ref" onclick="useAllReferees()" value=""/>
                            <label for="all_ref">Use all</label>

                            <input type="radio" name="pistes_type" id="manual_select_ref" onclick="selectReferees()" value=""/>
                            <label for="manual_select_ref">Select manually</label>
                        </div>

                        <div class="option_container grid piste_select disabled" id="select_referees_panel" >
                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value="" checked/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value="" checked/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value="" checked/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value="" checked/>
                                    <label for="piste_1">Piste 1</label>
                                </div>
                        </div>
                        <button type="submit" name="submit" value="Save" class="panel_submit">Save</button>
                    </form>
                </div>
                <div id="pist_time_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="togglePistTimePanel()">
                        <img src="../assets/icons/close-black-18dp.svg" >
                    </button>
                    <form action="" method="post"  autocomplete="off" class="overlay_panel_form dense flex">
                        <label for="starting_time" >STARTING TIME</label>
                        <input type="time">

                        <label for="interval_of_match" >INTERVAL OF MATCH:</label>
                        <div id="interval_of_match_wrapper">
                            <input type="number" class="number_input small">
                            <p>Min.</p>
                        </div>

                        <label for="pistes_type" >PISTES</label>
                        <div class="option_container row">
                            <input type="radio" name="pistes_type" checked id="all" onclick="useAllPistes()" value=""/>
                            <label for="all">Use all</label>

                            <input type="radio" name="pistes_type" id="manual_select" onclick="selectPistes()" value=""/>
                            <label for="manual_select">Select manually</label>
                        </div>

                        <div class="option_container grid piste_select disabled" id="select_pistes_panel" >
                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>
                                
                                <div class="piste_select ghost">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select ghost">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                                <div class="piste_select ghost">
                                    <input type="checkbox" name="piste_1" id="piste_1" value=""/>
                                    <label for="piste_1">Piste 1</label>
                                </div>

                        </div>

                        <button type="submit" name="submit" value="Save" class="panel_submit">Save</button>
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

                    STATE: 1
                    <div id="pool_listing" class="with_drag table_row_wrapper"> 


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

                        $get_group_fencers_query = "SELECT * FROM cptrs_$comp_id WHERE id IN ('$f1','$f2','$f3','$f4','$f5','$f6','$f7')";
                        $get_group_fencers_query_do = mysqli_query($connection, $get_group_fencers_query);

                        $cla = 0;
                        while($row = mysqli_fetch_assoc($get_group_fencers_query_do)){

                        ${$cla . "_f_n"} = $row["name"];
                        ${$cla . "_f_na"} = $row["nationality"];
                        $cla++;

                        }
                        
                        ?>


                        <div class="entry">
                            <div class="table_row start">
                                <div class="table_item bold">No.<?php echo $i ?></div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
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
                                            Fencers name
                                        </div>
                                        <div class="table_header_text">
                                            Fencers nationality
                                        </div>

                                        <div class="table_header_text square">
                                            No.
                                        </div>

                                        <?php 
                                        
                                        for ($e=1; $e <= $pool_f_in; $e++) {

                                        ?>

                                        <div class="table_header_text square">
                                            <?php echo $e ?>
                                        </div>

                                        <?php
                                        }
                                        ?>

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
                                    <div class="table_row_wrapper">
                                    <?php
                                    for ($n=0; $n < $pool_f_in; $n++) { 

                                    ?>
                                    
                                        <div class="table_row">
                                            <div class="table_item" ondrop="drop(event)" ondragover="allowDrop(event)"><p class="drag_fencer" draggable="true" ondragstart="drag(event)" id="1"><?php echo ${$n . "_f_n"} ?></p></div>
                                            <div class="table_item"><?php echo ${$n . "_f_na"} ?></div>
                                            <div class="table_item square row_title"><?php echo $n + 1 ?></div>
                                            
                                            <?php
                                        for ($g=0; $g < $pool_f_in; $g++) { 
                                        ?>

                                            <div class="table_item square <?php if($g == $n){echo "filled";} ?>"></div>
                                            
                                        <?php } ?>

                                            <div class="table_item square"></div>
                                            <div class="table_item square"></div>
                                            <div class="table_item square"></div>
                                        </div>

                                        <?php } ?>
                                        <!--
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
                                        -->
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