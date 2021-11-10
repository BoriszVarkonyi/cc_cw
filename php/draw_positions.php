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
    <title>Draw Positions</title>
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
                <p class="page_title">Draw Positions</p>
                <div class="stripe_button_wrapper">
                    <form action="" method="POST" id="IDE KELL A FORM IDJE">
                        <input type="text" class="selected_list_item_input hidden" name="selected_id" readonly>
                    </form>

                    <a class="stripe_button bold" href="team_order_reports.php?comp_id=<?php echo $comp_id ?>">
                        <p>Go back to Team Order Reports</p>
                        <img src="../assets/icons/arrow_back_ios_black.svg"/>
                    </a>
                </div>

            </div>
            <div id="page_content_panel_main">

                <div class="wrapper" id="team_order_report_panel">
                    <div id="team_order_report_header">
                        <div class="team_order_report_select green">
                            <p>T32</p>
                        </div>
                        <div class="team_order_report_select green">
                            <p>T16</p>
                        </div>
                        <div class="team_order_report_select current">
                            <p>R1</p>
                        </div>
                        <div class="team_order_report_select gray">
                            <p>R2</p>
                        </div>
                        <div class="team_order_report_select gray">
                            <p>R3</p>
                        </div>
                    </div>
                    <form action="" id="team_positions_wrapper">

                    <?php
                    
                    if (!isset($_GET['draw_table'])) {
                        # code...
                    }
                    else {

                        $draw_table_id = $_GET['draw_table'];

                    ?>

                        <div id="t32" class="team_positions">
                            <div class="rounds_container">
                                <p class="round_text"><span>T32</span> Contains:</p>
                                <p>1 - 16</p>
                            </div>

                            <div class="positions_button_wrapper">
                                <button class="draw_button" type="button" id="draw_positions_butto" onclick="drawPositions()">Draw</button>
                                <button class="save_draw_positions hidden" id="save_positions_butto" type="submit">Save</button>
                            </div>

                            <div class="positions_wrapper">
                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 22222222 zjgjfghffgh fdh</div>
                                    <div>4 - 6</div>
                                </div>

                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 2</div>
                                    <div>4 - 6</div>
                                </div>

                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 2</div>
                                    <div>4 - 6</div>
                                </div>

                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 2</div>
                                    <div>4 - 6</div>
                                </div>

                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 2</div>
                                    <div>4 - 6</div>
                                </div>

                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 2</div>
                                    <div>4 - 6</div>
                                </div>

                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 2</div>
                                    <div>4 - 6</div>
                                </div>
                            </div>

                        </div>
                        <div id="r1" class="team_positions hidden">
                            <div class="rounds_container">
                                <p class="round_text"><span>R1</span> Contains:</p>
                                <p>1 - 8, 4 - 6, 4 - 8, 8 - 4, 6 - 7</p>
                            </div>

                            <div class="positions_button_wrapper">
                                <button class="draw_button" type="button" id="draw_positions_button" onclick="drawPositions()">Draw</button>
                                <button class="save_draw_positions hidden" id="save_positions_button" type="submit">Save</button>
                            </div>

                            <div class="positions_wrapper">
                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 22222222 zjgjfghffgh fdh</div>
                                    <div>4 - 6</div>
                                </div>

                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 2</div>
                                    <div>4 - 6</div>
                                </div>

                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 2</div>
                                    <div>4 - 6</div>
                                </div>

                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 2</div>
                                    <div>4 - 6</div>
                                </div>

                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 2</div>
                                    <div>4 - 6</div>
                                </div>

                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 2</div>
                                    <div>4 - 6</div>
                                </div>

                                <div class="positions_grid">
                                    <div>NAME</div>
                                    <div>1 - 3</div>
                                    <div>NAME 2</div>
                                    <div>4 - 6</div>
                                </div>
                            </div>

                        </div>

                        <?php
                        
                    }
                   //close check if else statement 
                        
                        ?>

                    </form>
                </div>

            </div>
        </div>
    </main>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/controls.js"></script>
    <script src="../js/draw_positions.js"></script>
</body>
</html>