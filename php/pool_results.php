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
    <title>{Pool}'s results</title>
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
                <p class="page_title">{Pool number}'s results</p>
                <button class="stripe_button disabled" type="button">
                    <p>Send message to Fencer</p>
                    <img src="../assets/icons/message-black-18dp.svg"></img>
                </button>

                <button class="stripe_button red disabled" type="button" onclick="disqualifyToggle()">
                    <p>Disqualify</p>
                    <img src="../assets/icons/highlight_off-black-18dp.svg"></img>
                </button>

                <button class="stripe_button orange" type="submit">
                    <p>Save Pool</p>
                    <img src="../assets/icons/save-black-18dp.svg"></img>
                </button>

                <div id="disqualify_panel" class="overlay_panel hidden">
                    <p class="panel_title">Disqualify {Fencer's name}</p>
                    <button class="panel_button" onclick="disqualifyToggle()">
                        <img src="../assets/icons/close-black-18dp.svg" >
                    </button>
                    <form action="" method="post"  autocomplete="off" class="overlay_panel_form">
                        <label for="ref_type" class="label_text">REASON OF DISQUALIFICATION</label>
                        <div class="option_container">
                            <input type="radio" name="ref_type" id="medical" value=""/>
                            <label for="medical">Medical</label>

                            <input type="radio" name="ref_type" id="surrender" value=""/>
                            <label for="surrender">Surrender</label>

                            <input type="radio" name="ref_type" id="exclusion" value=""/>
                            <label for="exclusion">Exclusion</label>
                        </div>

                        <button type="submit" name="submit" class="submit_button" value="Disqualify">Disqualify</button>
                    </form>
                </div>

            </div>

            <div id="page_content_panel_main">
                <div class="wrapper width_80 entry_table_row_wrapper" id="pool_results">

                    <div class="entry" >
                        <div class="table_row start">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                            </div>
                            <div class="entry_panel gray results">
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
                                        <div class="table_item"><p>Name</p></div>
                                        <div class="table_item">Nat</div>
                                        <div class="table_item square row_title">1</div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">2</div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">3</div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">4</div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                    </div>

                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">5</div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square filled"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                    </div>

                                    
                                    <div class="table_row">
                                        <div class="table_item">Name</div>
                                        <div class="table_item">Name</div>
                                        <div class="table_item square row_title">6</div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square  filled"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                        <div class="table_item square"><input type="text" class="pool_result_input" placeholder="#"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
</html>