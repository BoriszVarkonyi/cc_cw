<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formula</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Formula</p>
                <div class="stripe_button_wrapper">
                    <button name="submit_form" form="save_form" class="stripe_button primary" type="submit" shortcut="SHIFT+S">
                        <p>Save Formula</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="basic_information_wrapper" class="db_panel form_page_flex">
                    <div class="db_panel_title_stripe">
                        <img src="../assets/icons/build_black.svg">
                        <p>Set Formula of Table</p>
                    </div>
                    <div class="db_panel_main">

                    <form id="save_form" action="" class="form_wrapper" method="POST">
                        <div>

                            <div>
                                <label for="team_ranking">RANK TEAMS BY</label>
                                <div class="option_container">
                                    <input type="radio" name="team_ranking" id="team_ranking_class" value="" checked/>
                                    <label for="team_ranking_class">Classesment</label>

                                    <input type="radio" name="team_ranking" id="team_ranking_fencer_perf" value=""/>
                                    <label for="team_ranking_fencer_perf">Fencers' Performance</label>
                                </div>
                            </div>

                            <div>
                                <label for="third_place">USAGE OF CALL ROOM</label>
                                <div class="option_container row no_bottom">
                                    <input type="radio" name="call_room_usage" id="used" onclick="useOption()" value="true"/>
                                    <label for="used">Use</label>

                                    <input type="radio" name="call_room_usage" id="not_used" onclick="dontUseOption()" value="false" checked/>
                                    <label for="not_used">Don't use</label>
                                </div>
                                <div class="option_container" id="useOptionContainer">

                                    <input type="radio" name="call_room_number" id="T64" value="64"/>
                                    <label for="T64">T64</label>

                                </div>
                            </div>

                            <div>
                                <label for="callroom_type">CALLROOM TYPE</label>
                                <div class="option_container">
                                    <input type="radio" name="callroom_type" id="callroom_type_single" value="" checked/>
                                    <label for="callroom_type_single">Singe-Elimination Like</label>

                                    <input type="radio" name="callroom_type" id="callroom_type_complex" value=""/>
                                    <label for="callroom_type_complex">Complex Callroom</label>
                                </div>
                            </div>


                        </div>
                        <div>
                            <div>
                                <label for="team_ranking">MAX. POINTS IN BOUTS</label>
                                <!-- ALAP ÉRTÉK 5 -->
                                <input type="number" name="" id="" class="number_input centered" placeholder="exp. 5" value="5">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
<script src="../js/cookie_monster.js"></script>
<script src="../js/main.js"></script>
<script src="../js/formula.js"></script>
</html>
