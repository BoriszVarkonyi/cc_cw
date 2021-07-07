<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php include '../includes/sortfunction.php' ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/table_style.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_table_style.min.css" media="print">
</head>

<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Table</p>

                    <!-- HA NINCS MÉG TÁBLA -->
                    <form class="stripe_button_wrapper" id="generate_table" method="POST" action="">
                        <button class="stripe_button primary" type="submit" name="generate_table" form="generate_table" onclick="document.cookie = 'index1=0'; document.cookie = 'index2=0'; document.cookie = 'index3=0'">
                            <p>Generate Table</p>
                            <img src="../assets/icons/add_box_black.svg" />
                        </button>
                    </form>

                    <!--HA VAN -->
                    <div class="stripe_button_wrapper">
                        <button class="stripe_button bold" type="button" onclick="printTable()">
                            <p>Print Table</p>
                            <img src="../assets/icons/print_black.svg" />
                        </button>
                        <a class="stripe_button bold" href="print_match_reports.php?comp_id=<?php echo $comp_id ?>" target="_blank">
                            <p>Print Match Reports</p>
                            <img src="../assets/icons/print_black.svg" />
                        </a>
                        <button class="stripe_button bold" type="button" onclick="toggleResetTable()">
                            <p>Reset Table</p>
                            <img src="../assets/icons/restart_alt_black.svg" />
                        </button>
                        <a class="stripe_button primary" type="button" href="table_pistes_and_time_team.php?comp_id=<?php echo $comp_id ?>">
                            <p>Pistes & Time</p>
                            <img src="../assets/icons/ballot_black.svg" />
                        </a>
                        <a class="stripe_button primary" type="button" href="table_referees_team.php?comp_id=<?php echo $comp_id ?>">
                            <p>Referees</p>
                            <img src="../assets/icons/ballot_black.svg" />
                        </a>
                        <a class="stripe_button primary" type="button" href="draw_positions.php?comp_id=<?php echo $comp_id ?>">
                            <p>Draw Positions</p>
                            <img src="../assets/icons/ballot_black.svg" />
                        </a>
                    </div>

                    <div class="search_wrapper">
                        <input type="text" name="" onfocus="resultChecker(this), isOpen(this)" onblur="isClosed(this)" id="" placeholder="Search Match by ID (exp: M152)" class="search page">
                        <button type="button"><img src="../assets/icons/close_black.svg"></button>
                        <div class="search_results">
                            <button id="jumpToButton" href="#" onclick="selectSearchedRound()" type="button">Jump to <span id="match_id_text">{Match id}</span></button>
                        </div>
                    </div>

                <div class="view_button_wrapper first">
                    <button onclick="tableZoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out_black.svg" />
                    </button>
                    <button onclick="tableZoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in_black.svg" />
                    </button>
                </div>

                <div class="view_button_wrapper second">
                    <button onclick="toggleThisPanel(this)" id="">
                        <img src="../assets/icons/list_alt_black.svg" />
                    </button>
                </div>

                <div class="view_panel second hidden" id="view_panel_1">
                    <div class="color_legend">
                        <div class="green">Finished</div>
                        <div class="yellow">Ongoing</div>
                        <div class="red">Haven't started</div>
                    </div>
                </div>

                <div class="view_button_wrapper third">
                    <button onclick="toggleThisPanel(this)" id="">
                        <img src="../assets/icons/settings_black.svg" />
                    </button>
                </div>

                <div class="view_panel third hidden" id="view_panel_2">
                    <label for="">DISPLAY FENCERS'</label>
                    <div class="option_container">
                        <input type="checkbox" name="fencer_type" id="club" value="1" />
                        <label for="club">Club</label>
                    </div>
                </div>

                <div id="reset_table_panel" class="overlay_panel hidden">
                    <button class="panel_button" onclick="toggleResetTable()">
                        <img src="../assets/icons/close_black.svg">
                    </button>
                    <form class="overlay_panel_form" autocomplete="off" action="" method="POST" id="" autocomplete="off">
                        <label for="name">SELECT TABLE</label>
                        <div id="table_select_wrapper">
                        <div class="search_wrapper wide">
                            <button type="button" class="search select altalt" onfocus="isOpen(this)" onblur="isClosed(this)">
                                <!-- Ebbe az inputba rakódik a kiválasztott tábla -->
                                <input type="text" readonly z-index="-1" name="" placeholder="Select a Table" value="" onchange="test()">
                            </button>
                            <button type="button"><img src="../assets/icons/arrow_drop_down_black.svg" alt="Dropdown Icon"></button>
                            <div class="search_results">
                                <button type="button" onclick="selectSystem(this), formValidation()">Table of 32</button>
                                <button type="button" onclick="selectSystem(this), formValidation()">Table of 16</button>
                                <button type="button" onclick="selectSystem(this), formValidation()">Table of 8</button>
                            </div>
                        </div>
                    </div>
                        <button type="submit" name="" class="panel_submit">Reset</button>
                    </form>
                </div>
            </div>
            <div id="page_content_panel_main">


                    <!-- HA NINCS
                    <div id="no_something_panel">
                        <p>You have no table generated!</p>
                    </div>
                    -->

                    <!-- HA van -->

                    <!-- STEP 1 -->
                    <div id="32_16" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">T32</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>


                        <div id="e_" class="elimination">
                            <div class="elimination_label">T16</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- STEP 2 -->
                    <div id="1_16" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">9-16</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">1-16</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">1-8</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- STEP 3 -->
                    <div id="1_8" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">5-8</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">1-8</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">1-4</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>


                    </div>

                    <div id="9_16" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">13-16</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">9-16</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">9-12</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- STEP 4 -->
                    <div id="1_4" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">3-4</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">1-4</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">1-2</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>


                    </div>

                    <div id="5_8" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">7-8</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">5-8</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">5-6</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>


                    </div>

                    <div id="9_12" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">11-12</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">9-12</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">9-10</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>


                    </div>

                    <div id="13_16" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">15-16</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">13-16</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">13-14</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- STEP 5 -->

                    <div id="1_2" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">2</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">1-2</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">1</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div id="3_4" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">4</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">3-4</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">3</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div id="5_6" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">6</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">5-6</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">5</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div id="8_9" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">8</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">7-8</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">7</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div id="9_10" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">10</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">9-10</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">9</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div id="11_12" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">12</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">11-12</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">11</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div id="13_14" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">14</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">13-14</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">13</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div id="15_16" class="call_room cc">
                        <div class="elimination_slider_button left" id="buttonLeft" onclick="buttonLeft()">
                            <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                        </div>
                        <div class="elimination_slider_button right" id="buttonRight" onclick="buttonRight()">
                            <img src="../assets/icons/arrow_forward_ios_black.svg">
                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">16</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">15-16</div>

                            <div class="table_round_wrapper blue" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                    <div class="table_round_info">
                                        <div>
                                            <p>Ref: </p>
                                            <p>TIME</p>
                                        </div>
                                        <div>
                                            <p>VRef:</p>
                                            <p>Piste:</p>
                                        </div>
                                    </div>

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div id="e_" class="elimination">
                            <div class="elimination_label">15</div>

                            <div class="table_round_wrapper purple" id="" tabindex="1" onclick="selectRound(this), window.location.href='match_results_team.php?comp_id=<?php echo $comp_id ?>'">
                                <div class="table_round">

                                    <div class="table_fencer">
                                        <div class="table_fencer_number">
                                            <p>NUM</p>
                                        </div>

                                        <div class="table_fencer_name">
                                            <p>NAME</p>
                                        </div>

                                        <div class="table_fencer_nat">
                                            <p>NAT</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/overlay_panel.js"></script>
    <script src="../js/table_team.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/print.js"></script>
</body>
</html>