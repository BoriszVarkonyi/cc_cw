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
                <button class="stripe_button orange" type="submit" form="needed_equimpment_wrapper">
                    <p>Generate Pools</p>
                    <img src="../assets/icons/add_box-black-18dp.svg"></img>
                </button>
            </div>
            <div id="page_content_panel_main">
                <div id="pools_wrapper">
                    <div id="pool_listing">
                        <div class="entry" id="">
                            <div class="table_row start">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                                <button type="button" onclick="" class="pool_config">
                                    <img src="../assets/icons/settings-black-18dp.svg" alt="">
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
                        <div class="entry" id="">
                            <div class="table_row start">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                                <button type="button" onclick="" class="pool_config">
                                    <img src="../assets/icons/settings-black-18dp.svg" alt="">
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
                        <div class="entry" id="">
                            <div class="table_row start">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                                <button type="button" onclick="" class="pool_config">
                                    <img src="../assets/icons/settings-black-18dp.svg" alt="">
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
                        <div class="entry" id="">
                            <div class="table_row start">
                                <div class="table_item bold">No. 1</div>
                                <div class="table_item">Piste 1</div>
                                <div class="table_item">Ref: Név</div>
                                <div class="table_item">11:50</div>
                                <button type="button" onclick="" class="pool_config">
                                    <img src="../assets/icons/settings-black-18dp.svg" alt="">
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
                    </div>
                    <div id="pools_drag">
                        <div id="pools_drag_panel">
                            <p id="pools_drag_title">Drag fencers here</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/pools.js"></script>
</html>