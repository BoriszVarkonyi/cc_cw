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
                <!-- STATE 0 -->
                <button class="stripe_button orange" type="button">
                    <p>Generate Table</p>
                    <img src="../assets/icons/add_box-black-18dp.svg"/>
                </button>
                <!-- STATE 1 -->
                <button class="stripe_button disabled" type="button">
                    <p>Send Message to Fencer</p>
                    <img src="../assets/icons/message-black-18dp.svg"/>
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
                    <p>Start next Round</p>
                    <img src="../assets/icons/next_plan-black-18dp.svg"/>
                </button>
            </div>
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

                        <label for="interval_of_match" >INTERVAL OF MATCH</label>
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
            <div id="page_content_panel_main">
                <!-- State 0 -->
                <!--
                <div id="no_something_panel">
                    <p>You have no table generated!</p>
                </div>-->
                <!-- State 1 -->
                <div id="call_room" class="cc">
                    <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                        <img src="../assets/icons/arrow_back_ios-black-18dp.svg" >
                    </div>
                    <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                        <img src="../assets/icons/arrow_forward_ios-black-18dp.svg" >
                    </div>
                    <div id="e_1" class="elimination">
                        <div class="elimination_label">Table of __</div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                    </div>
                    <div id="e_2" class="elimination">
                        <div class="elimination_label">Table of __</div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                    </div>
                    <div id="e_3" class="elimination">
                        <div class="elimination_label">Table of __</div>
                        <div class="table_round_wrapper finished blue">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished yellow">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished green">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished red">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                    </div>
                    <div id="e_4" class="elimination">
                        <div class="elimination_label">Table of __</div>
                        <div class="table_round_wrapper finished purple">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                        <div class="table_round_wrapper finished purple">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                    </div>
                    <div id="e_5" class="elimination">
                        <div class="elimination_label">Table of __</div>
                        <div class="table_round_wrapper finished purple">
                            <div>
                                <p>Ref: {Referee's Name}</p>
                                <p>12:00</p>
                            </div>
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bidafrg</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p>VRef: {Referee's Name}</p>
                                <p>Piste: Red</p>
                            </div>
                        </div>
                    </div>
                    <div id="e_5" class="elimination">
                        <div class="elimination_label">Table of __</div>
                        <div class="table_round_wrapper finished purple">
                            <div class="table_round" onclick="tableRoundConfig(this)">
                                <div class="table_fencer">
                                    <div class="table_fencer_number">
                                        <p>25</p>
                                    </div>
                                    <div class="table_fencer_name">
                                        <p>Bida Sergey Bida Sergey Bida</p>
                                    </div>
                                    <div class="table_fencer_nat">
                                        <p>rus</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="color_legend">
                    <div class="green">Finished</div>
                    <div class="yellow">Ongoing</div>
                    <div class="red">Haven't started</div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/main.js"></script>
<script src="../js/table.js"></script>
</html>