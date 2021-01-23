<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check out {Fencer's name}</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
    <link rel="stylesheet" href="../css/check_out_fencer_style.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Check out {Fencer's name}</p>
                <div class="stripe_button_wrapper">
                    <button name="" id="" class="stripe_button" shortcut="SHIFT+P" onclick="printPage()">
                        <p>Print Check Out</p>
                        <img src="../assets/icons/print-black-18dp.svg"/>
                    </button>
                    <button name="" class="stripe_button orange" type="submit" form="" shortcut="SHIFT+S" onclick="location.href='weapon_control_administrated.php?comp_id=<?php echo $comp_id ?>'">
                        <p>Check Out</p>
                        <img src="../assets/icons/check_circle-black-18dp.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper">
                    <div class="db_panel  other">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/backpack-black-18dp.svg"/>
                            Contents of fencer's bag
                        </div>
                        <div class="db_panel_main">
                            <div class="table">
                                <div class="table_header">
                                    <div class="table_header_text">ISSUE</div>
                                    <div class="table_header_text">QUANTITY</div>
                                </div>
                                <div class="table_row_wrapper alt">
                                    <div class="table_row">
                                        <div class="table_item"><p>Epee</p></div>
                                        <div class="table_item"><p>2</p></div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item"><p>Epee</p></div>
                                        <div class="table_item"><p>2</p></div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item"><p>Epee</p></div>
                                        <div class="table_item"><p>2</p></div>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </div>
                    <div class="db_panel  other">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/backpack-black-18dp.svg"/>
                            Control of fencer's equipment
                        </div>
                        <div class="db_panel_main">
                            <div id="issues_panel" class="table">
                                <div class="table_header">
                                    <div class="table_header_text">ISSUE</div>
                                    <div class="table_header_text">QUANTITY</div>
                                </div>
                                <div class="table_row_wrapper alt">
                                    <div class="table_row">
                                        <div class="table_item"><p>Issue</p></div>
                                        <div class="table_item"><p>5</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
<script>
    function printPage() {
        window.print();
    }
</script>
</body>
</html>