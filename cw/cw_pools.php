<?php include "cw_header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{Comp name}'s pools</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <div class="cw_panel_title_wrapper">
            <button type="button" class="back_button" onclick="location.href='choose_competition.php'">
                <img class="stripe_button_icon" src="../assets/icons/arrow_back_ios-black-18dp.svg"></img>
            </button>
            <p>POOLS OF {COMP NAME}</p>
        </div>

        <form id="browsing_bar">
            <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
            <input type="search" name="" id="" placeholder="Search for Fencer">
            <input type="submit" value="Search">
        </form>
        <div id="pools_wrapper">
            <div class="entry" id="">
                <div class="table_row start" onclick="togglePool(this)">
                    <div class="table_item bold">No. 1</div>
                    <div class="table_item">Piste 1</div>
                    <div class="table_item">Ref: Név</div>
                    <div class="table_item">11:50</div>
                </div>
                <div class="entry_panel gray collapsed">
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

            <div class="entry" id="">
                <div class="table_row start" onclick="togglePool(this)">
                    <div class="table_item bold">No. 1</div>
                    <div class="table_item">Piste 1</div>
                    <div class="table_item">Ref: Név</div>
                    <div class="table_item">11:50</div>
                </div>
                <div class="entry_panel gray collapsed">

                </div>
            </div>

            <div class="entry" id="">
                <div class="table_row start" onclick="togglePool(this)">
                    <div class="table_item bold">No. 1</div>
                    <div class="table_item">Piste 1</div>
                    <div class="table_item">Ref: Név</div>
                    <div class="table_item">11:50</div>
                </div>
                <div class="entry_panel gray collapsed">

                </div>
            </div>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/cw_pools.js"></script>
</html>