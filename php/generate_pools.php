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
    <title>Pools of <?php echo $comp_name ?></title>
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
</head>

<body>
    <!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Generate Pools</p>
                <div class="stripe_button_wrapper">
                    <button name="" form="" class="stripe_button primary" type="submit" shortcut="SHIFT+G">
                        <p>Generate Pools</p>
                        <img src="../assets/icons/save-black-18dp.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="basic_information_wrapper" class="db_panel form_page_flex">
                    <div class="db_panel_title_stripe">
                        <img src="../assets/icons/build-black-18dp.svg">
                        <p>Set propeties of Pools</p>
                    </div>
                    <div class="db_panel_main">

                    <form id="" action="" class="form_wrapper" method="POST">
                        <div>
                            <div>
                                <label for="starting_time">STRIVE FOR</label>
                                <div class="option_container">
                                    <input type="text" class="hidden" id="fencer_quantity" value="10">

                                    <input type="radio" class="option_button" name="pools_of" id="7" value=""/>
                                    <label for="7" class="complex">Pools of 7 <p id="p_7"></p></label>

                                    <input type="radio" class="option_button" name="pools_of" id="6" value=""/>
                                    <label for="6" class="complex">Pools of 6 <p id="p_6"></p></label>

                                    <input type="radio" class="option_button" name="pools_of" id="5" value=""/>
                                    <label for="5" class="complex">Pools of 5 <p id="p_5"></p></label>

                                    <input type="radio" class="option_button" name="pools_of" id="4" value=""/>
                                    <label for="4" class="complex">Pools of 4 <p id="p_4"></p></label>

                                </div>
                            </div>
                            <div>
                                <label for="interval_of_match">NUMBER OF QUALIFIERS</label>
                                <input type="number" placeholder="#" class="number_input centered">
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="pistes_type">STATISTICS</label>
                                <table class="pools_stat_table">
                                    <thead>
                                        <th>Percent</th>
                                        <th>Number of Fencers</th>
                                    </thead>
                                    <tr>
                                        <td>All</td>
                                        <td>Fencer count</td>
                                    <tr>
                                    <tr>
                                        <td>80%</td>
                                        <td>Fencer count * 0.8</td>
                                    <tr>
                                    <tr>
                                        <td>70%</td>
                                        <td>Fencer count * 0.7</td>
                                    <tr>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/pools.js"></script>
<script src="../js/overlay_panel.js"></script>
<script src="../js/generate_pools.js"></script>
</html>