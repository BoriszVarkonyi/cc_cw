<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table of {Comp's name}</title>
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
                <p class="page_title">Table</p>
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
                    <p>Start next Round</p>
                    <img src="../assets/icons/next_plan-black-18dp.svg"></img>
                </button>
            </div>
            <div id="ref_pis_time_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="refPisTimePanel()">
                        <img src="../assets/icons/close-black-18dp.svg" alt="">
                    </button>
                    <form action="" method="post" id="" autocomplete="off" class="overlay_panel_form dense">
                        <label for="ref_type" class="label_text">REFEREES</label></br>
                        <div class="option_container row">
                            <input type="radio" name="ref_type" id="auto" checked value=""/>
                            <label for="auto">Automatic</label>

                            <input type="radio" name="ref_type" id="manual" value=""/>
                            <label for="manual">Manual</label>
                        </div>
                        <label for="starting_time" class="label_text">STARTING TIME</label></br>
                        <input type="time"></br>

                        <label for="interval_of_match" class="label_text">INTERVAL OF MATCH:</label></br>
                        <div id="interval_of_match_wrapper">
                            <input type="number" class="number_input small">
                            <p>Min.</p>
                        </div>

                        <label for="pistes_type" class="label_text">PISTES</label></br>
                        <div class="option_container row">
                            <input type="radio" name="pistes_type" checked id="all" value="" onclick="useAll()" />
                            <label for="all">Use all</label>

                            <input type="radio" name="pistes_type" id="manual_select" value="" onclick="selectPistes()"/>
                            <label for="manual_select">Select manually</label>
                        </div>

                        <div class="option_container grid piste_select disabled" id="select_pistes_panel">
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
            <div id="page_content_panel_main">
            <div id="call_room" class="cc">
            
            <div id="e_1" class="elimination first visible">
                <div class="elimination_label">Table of __</div>
                <div class="table_round red" onclick="location.href='cw_round_live.php'">
                    <div class="round_information">
                        <p>Ref: {Referee's Name}</p>
                        <p>20 / 12 / 2020 15:20</p>
                        <p>Piste No.: 5</p>
                        <p>Ref: {Referee's Name}</p>
                        <button>
                            <img src="../assets/icons/settings-black-18dp.svg" alt="">
                        </button>
                    </div>
                    
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="table_round yellow">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round green">
                    <div class="table_fencer dna">
                        <div class="table_fencer_number"> <!-- Not visible if dna-->
                        25
                        </div>
                        <div class="table_fencer_name"> <!-- Has to be rewritten to dna-->
                            DDA
                        </div>
                        <div class="table_fencer_nat"> <!-- Not visible if dna-->
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>

            <div id="e_2" class="elimination visible">
                <div class="elimination_label">Table of __</div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>

            <div id="e_3" class="elimination visible">
                <div class="elimination_label">Table of __</div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
                <div class="table_round">
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div id="e_4" class="elimination visible">
                <div class="elimination_label">Table of __</div>

                <div class="table_round">
                    <div class="round_information">
                        <p>Ref: {Referee's Name}</p>
                        <p>20 / 12 / 2020 15:20</p>
                        <p>Piste No.: 5</p>
                        <p>Ref: {Referee's Name}</p>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    <div class="table_fencer">
                        <div class="table_fencer_number">
                        25
                        </div>
                        <div class="table_fencer_name">
                            Szia Enber
                        </div>
                        <div class="table_fencer_nat">
                            NAT
                            <img src="../assets/icons/english.svg" alt="">
                        </div>
                    </div>
                    
                </div>
            </div>
            

        </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/table.js"></script>
</html>