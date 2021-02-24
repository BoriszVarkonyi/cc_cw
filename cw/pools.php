<?php include "cw_comp_getdata.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s pools</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
</head>
<body class="competitions">
    <?php include "cw_header.php"; ?>
    <div id="main">
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">
                    <button type="button" class="back_button" onclick="window.history.back();">
                        <img src="../assets/icons/arrow_back_ios-black-18dp.svg">
                    </button>
                    Pools of <?php echo $comp_name ?>
                </p>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close-black-18dp.svg"></button>
                    </div>
                    <input type="submit" value="Search">
                </form>
                <div class="table cw">
                    <div class="table_header">
                        <div class="table_header_text">POOL'S NUMBER</div>
                        <div class="table_header_text">PISTE'S NUMBER</div>
                        <div class="table_header_text">REFEREE</div>
                        <div class="table_header_text">TIME</div>
                    </div>
                    <div class="table_row_wrapper alt">
                        <div class="entry">
                            <div class="table_row start" onclick="togglePool(this)">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                            </div>
                            <div class="entry_panel collapsed">
                                <div class="table">
                                    <div class="table_header">
                                        <div class="table_header_text">
                                            Fencers name
                                        </div>
                                        <div class="table_header_text">
                                            Fencers nation / club
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
                                    <div class="table_row_wrapper">
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
                        </div>
                        <div class="entry">
                            <div class="table_row start" onclick="togglePool(this)">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                            </div>
                            <div class="entry_panel collapsed">
                                <div class="pool_table_wrapper table">
                                    <div class="table_header">
                                        <div class="table_header_text">
                                            Fencers name
                                        </div>
                                        <div class="table_header_text">
                                            Fencers nation / club
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
                                    <div class="table_row_wrapper">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/cw_pools.js"></script>
    <script src="../js/entry_controls.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>