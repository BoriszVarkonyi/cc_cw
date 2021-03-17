<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

//Get table object for further USAGE


$qry_get_table = "SELECT * FROM tables WHERE ass_comp_id = $comp_id";
$qry_get_table_do = mysqli_query($connection, $qry_get_table);

if ($row = mysqli_fetch_assoc($qry_get_table_do)) {

    $out_table = json_decode($row["data"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table Pistes & Time setup</title>
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
                <p class="page_title">Table Pistes & Time setup</p>
                <div class="stripe_button_wrapper">
                    <button name="submit_form" form="save_form" class="stripe_button primary" type="submit" shortcut="SHIFT+S">
                        <p>Save</p>
                        <img src="../assets/icons/save-black-18dp.svg" />
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="" class="wrapper full margin">
                    <div id="table_select_wrapper">
                        <div class="search_wrapper wide">
                            <button type="button" class="search select alt" tabindex="3" onfocus="isOpen(this)" onblur="isClosed(this)">
                                <input type="text" name="" placeholder="" value="<?php echo 'Table of ' . ltrim($_GET["table_round"], 't_') ?>">
                            </button>
                            <button type="button"><img src="../assets/icons/arrow_drop_down-black-18dp.svg"></button>
                            <div class="search_results">


                                <?php

                                foreach ($out_table as $round_name => $tableround) { ?>

                                    <a type="button" id="gr" href="table_pistes_and_time.php?comp_id=<?php echo $comp_id . "&table_round=" . $round_name ?>"><?php echo "Table of " . ltrim($round_name, "t_") ?></a>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>

                    <?php
                    //Only shows panels if he had already chosen tableround

                    if (isset($_GET["table_round"])) {

                        $table_round = $_GET["table_round"];
                    ?>

                        <div id="table_piste_time_wrapper">
                            <div class="db_panel full" id="pistes_and_time_panel">
                                <div class="db_panel_title_stripe">
                                    <img src="../assets/icons/build-black-18dp.svg">
                                    <p>Set Time and Piste for table</p>
                                </div>
                                <div class="db_panel_main full">
                                    <form id="" action="" class="form_wrapper" method="POST">
                                        <div>
                                            <div>
                                                <label for="">STARTING TIME</label>
                                                <input type="time">
                                            </div>
                                            <div>
                                                <label for="">INTERVAL OF MATCHES</label>
                                                <input type="number" class="number_input centered" placeholder="#">
                                            </div>
                                            <div>
                                                <label for="">USAGE OF PISTES</label>
                                                <div class="option_container row">
                                                    <input type="radio" name="piste_usage" id="all" value=""/>
                                                    <label for="all">Use all</label>
                                                    <input type="radio" name="piste_usage" id="not_all" value=""/>
                                                    <label for="not_all">Don't use all</label>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="">PISTE & TIME RELATION</label>
                                                <div class="option_container">
                                                    <input type="radio" name="piste_time_relation" id="diff_time" value=""/>
                                                    <label for="diff_time">Same piste different time</label>
                                                    <input type="radio" name="piste_time_relation" id="diff_piste" value=""/>
                                                    <label for="diff_piste">Different piste same time</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="">USED PISTES</label>
                                            <div id="pistes_wrapper">
                                                <div class="piste_type_wrapper">
                                                    <div class="piste_wrapper">
                                                        <div class="piste">
                                                            <div class="piste_number">1</div>
                                                            <div class="piste_name">Main</div>
                                                            <div class="piste_order">
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_up-black-18dp.svg">
                                                                </button>
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_down-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                            <div class="piste_button">
                                                                <button type="button">
                                                                    <img src="../assets/icons/remove-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="piste">
                                                            <div class="piste_number">1</div>
                                                            <div class="piste_name">Red</div>
                                                            <div class="piste_order">
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_up-black-18dp.svg">
                                                                </button>
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_down-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                            <div class="piste_button">
                                                                <button type="button">
                                                                    <img src="../assets/icons/remove-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="piste">
                                                            <div class="piste_number">1</div>
                                                            <div class="piste_name">Red</div>
                                                            <div class="piste_order">
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_up-black-18dp.svg">
                                                                </button>
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_down-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                            <div class="piste_button">
                                                                <button type="button">
                                                                    <img src="../assets/icons/remove-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="piste">
                                                            <div class="piste_number">1</div>
                                                            <div class="piste_name">Red</div>
                                                            <div class="piste_order">
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_up-black-18dp.svg">
                                                                </button>
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_down-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                            <div class="piste_button">
                                                                <button type="button">
                                                                    <img src="../assets/icons/remove-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="piste">
                                                            <div class="piste_number">1</div>
                                                            <div class="piste_name">Main</div>
                                                            <div class="piste_order">
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_up-black-18dp.svg">
                                                                </button>
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_down-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                            <div class="piste_button">
                                                                <button type="button">
                                                                    <img src="../assets/icons/remove-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="piste">
                                                            <div class="piste_number">1</div>
                                                            <div class="piste_name">Red</div>
                                                            <div class="piste_order">
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_up-black-18dp.svg">
                                                                </button>
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_down-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                            <div class="piste_button">
                                                                <button type="button">
                                                                    <img src="../assets/icons/remove-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="piste">
                                                            <div class="piste_number">1</div>
                                                            <div class="piste_name">Red</div>
                                                            <div class="piste_order">
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_up-black-18dp.svg">
                                                                </button>
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_down-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                            <div class="piste_button">
                                                                <button type="button">
                                                                    <img src="../assets/icons/remove-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="piste">
                                                            <div class="piste_number">1</div>
                                                            <div class="piste_name">Red</div>
                                                            <div class="piste_order">
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_up-black-18dp.svg">
                                                                </button>
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_down-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                            <div class="piste_button">
                                                                <button type="button">
                                                                    <img src="../assets/icons/remove-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="piste">
                                                            <div class="piste_number">1</div>
                                                            <div class="piste_name">Red</div>
                                                            <div class="piste_order">
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_up-black-18dp.svg">
                                                                </button>
                                                                <button type="button">
                                                                    <img src="../assets/icons/keyboard_arrow_down-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                            <div class="piste_button">
                                                                <button type="button">
                                                                    <img src="../assets/icons/remove-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="piste_controls">
                                                        <button type="button" onclick="">Deselect all</button>
                                                    </div>
                                                </div>
                                                <div class="piste_type_wrapper">
                                                <div class="piste_wrapper">
                                                        <div class="piste">
                                                            <div class="piste_number">1</div>
                                                            <div class="piste_name">Red</div>
                                                            <div class="piste_button">
                                                                <button type="button">
                                                                    <img src="../assets/icons/add-black-18dp.svg">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="piste_controls">
                                                        <button type="button" onclick="">Select all</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="db_panel full" id="matches_preview_panel">
                                <div class="db_panel_title_stripe">
                                    <img src="../assets/icons/build-black-18dp.svg">
                                    <p>Preview matches</p>
                                </div>
                                <div class="db_panel_main full">
                                    <div class="table fixed">
                                        <div class="table_header">
                                            <div class="table_header_text">Match ID</div>
                                            <div class="table_header_text">Piste</div>
                                            <div class="table_header_text">Starting time</div>
                                        </div>
                                        <div class="table_row_wrapper">

                                            <?php

                                            foreach ($out_table->$table_round as $matchkey => $matches) { ?>

                                                <div class="table_row">
                                                    <div class="table_item"><?php echo $matchkey ?></div>
                                                    <div class="table_item"><?php echo $matches->pistetime->pistename ?></div>
                                                    <div class="table_item"><?php echo $matches->pistetime->time ?></div>
                                                </div>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
</body>
<script src="../js/main.js"></script>
<script src="../js/search.js"></script>

</html>