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
    <title>Registration Statistics</title>
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <form id="title_stripe" method="POST" action="">
                    <p class="page_title">Weapon Control Statistics</p>
                    <div class="stripe_button_wrapper">
                        <button class="stripe_button primary" type="button">
                            <p>Print Statistics</p>
                            <img src="../assets/icons/print-black-18dp.svg"/>
                        </button>
                    </div>
                </form>
                <div id="page_content_panel_main">
                    <div class="paper_wrapper hidden">
                        <div class="paper">
                            <div class="title_container">
                                <div><p class="title">REGISTRATION REPORT</p></div>
                                <div class="comp_info small">
                                    <p class="info_label"><?php echo $comp_name ?></p>
                                    <div>
                                        <p>SEX'S</p>
                                        <p>W TYPE</p>
                                    </div>
                                    <p>STARTTIME</p>
                                </div>
                            </div>
                            <div class="paper_content">
                                <div class="bag_content">
                                    <p class="label">BAG CONTENT</p>
                                    <div class="grid_table">
                                        <div class="grid_header">
                                            <div class="grid_header_text">EQIPMENT</div>
                                            <div class="grid_header_text">QUANTITY</div>
                                        </div>
                                        <div class="grid_row_wrapper">
                                            <div class="grid_row">
                                                <div class="grid_item">Name</div>
                                                <div class="grid_item">1</div>
                                            </div>
                                            <div class="grid_row">
                                                <div class="grid_item">Name</div>
                                                <div class="grid_item">1</div>
                                            </div>
                                            <div class="grid_row">
                                                <div class="grid_item">Name</div>
                                                <div class="grid_item">1</div>
                                            </div>
                                            <div class="grid_row">
                                                <div class="grid_item">Name</div>
                                                <div class="grid_item">1</div>
                                            </div>
                                            <div class="grid_row">
                                                <div class="grid_item">Name</div>
                                                <div class="grid_item">1</div>
                                            </div>
                                            <div class="grid_row">
                                                <div class="grid_item">Name</div>
                                                <div class="grid_item">1</div>
                                            </div>
                                            <div class="grid_row">
                                                <div class="grid_item">Name</div>
                                                <div class="grid_item">1</div>
                                            </div>
                                            <div class="grid_row">
                                                <div class="grid_item">Name</div>
                                                <div class="grid_item">1</div>
                                            </div>
                                            <div class="grid_row">
                                                <div class="grid_item">Name</div>
                                                <div class="grid_item">1</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="signatures">
                                    <p class="label">SIGNATURES</p>
                                    <div class="grid_table">
                                            <div class="grid_header">
                                                <div class="grid_header_text">NAME</div>
                                                <div class="grid_header_text signature">SIGNATURE</div>
                                            </div>
                                            <div class="grid_row_wrapper">
                                                <div class="grid_row">
                                                    <div class="grid_item">Name</div>
                                                    <div class="grid_item signature"></div>
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
        </div>
    <script src="../js/main.js"></script>
    <script src="../js/weapon_control.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/controls.js"></script>
    </body>
</html>