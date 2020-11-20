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

                

                STATE: 0

                <button class="stripe_button orange" onclick="generatePanel()" type="submit">
                    <p>Generate Pools</p>
                    <img src="../assets/icons/add_box-black-18dp.svg"></img>
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
                        <button type="submit" name="submit" value="Save" class="panel_submit">Create</button>
                    </form>
                </div>

                
<!--
                STATE: 1 

                <button class="stripe_button" type="button">
                    <p>Open CC Match Control</p>
                    <img src="../assets/icons/pages-black-18dp.svg"></img>
                </button>

                <button class="stripe_button disabled" type="button">
                    <p>Send Message to Fencer</p>
                    <img src="../assets/icons/message-black-18dp.svg"></img>
                </button>

                <button class="stripe_button bold" type="button" onclick="refPisTimePanel()">
                    <p>Referees & Pistes & Time</p>
                    <img src="../assets/icons/ballot-black-18dp.svg"></img>
                </button>
                
                <button class="stripe_button orange" type="submit">
                    <p>Start Pools</p>
                    <img src="../assets/icons/outlined_flag-black-18dp.svg"></img>
                </button>

                <div id="ref_pis_time_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="refPisTimePanel()">
                        <img src="../assets/icons/close-black-18dp.svg" >
                    </button>
                    <form action="" method="post"  autocomplete="off" class="overlay_panel_form dense flex">
                        <label for="ref_type" >REFEREES</label>
                        <div class="option_container row">
                            <input type="radio" name="ref_type" id="auto" checked value=""/>
                            <label for="auto">Automatic</label>

                            <input type="radio" name="ref_type" id="manual" value=""/>
                            <label for="manual">Manual</label>
                        </div>
                        <label for="starting_time" >STARTING TIME</label>
                        <input type="time">

                        <label for="interval_of_match" >INTERVAL OF MATCH:</label>
                        <div id="interval_of_match_wrapper">
                            <input type="number" class="number_input small">
                            <p>Min.</p>
                        </div>

                        <label for="pistes_type" >PISTES</label>
                        <div class="option_container row">
                            <input type="radio" name="pistes_type" checked id="all" onclick="useAll()" value=""/>
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

                
                

                STATE: 2
                
                <button class="stripe_button" type="button">
                    <p>Open CC Match Control</p>
                    <img src="../assets/icons/pages-black-18dp.svg"></img>
                </button>
-->
                

            </div>
            <div id="page_content_panel_main">

             

                STATE: 0

                <div id="no_something_panel">
                    <p>You have no pools generated!</p>
                </div>

                -->
<!--
                <div id="pools_wrapper">

                    STATE: 1
                    <div id="pool_listing" class="with_drag entry_table_row_wrapper"> 
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
                                        <div class="table_item" ondrop="drop(event)" ondragover="allowDrop(event)"><p class="drag_fencer" draggable="true" ondragstart="drag(event)" id="1">Name</p></div>
                                        <div class="table_item">Nat</div>
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
                    </div>
                    <div id="pools_drag_panel" ondrop="drop(event)" ondragover="allowDrop(event)">
                    </div>

                    

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
<script src="../js/pools.js"></script>
</html>