<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check in {Fencer's name}</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
    <link rel="stylesheet" href="../css/print_check_out_fencer_style.css">
    <link rel="stylesheet" href="../css/print_style.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Check in {Fencer's name}</p>
                <div class="stripe_button_wrapper">
                    <button name="" id="" class="stripe_button" shortcut="SHIFT+P" onclick="printPage()">
                        <p>Print Check In</p>
                        <img src="../assets/icons/print-black-18dp.svg"/>
                    </button>
                    <button name="" class="stripe_button orange" type="submit" form="" shortcut="SHIFT+S" onclick="location.href='weapon_control_administrated.php?comp_id=<?php echo $comp_id ?>'">
                        <p>Save Check In</p>
                        <img src="../assets/icons/save-black-18dp.svg"/>
                    </button>
                </div>
                <div class="view_button_wrapper zoom">
                    <button class="view_button" onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out-black-18dp.svg"/>
                    </button>
                    <button class="view_button" onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in-black-18dp.svg"/>
                    </button>                      
                </div>
                <div class="view_button_wrapper view">
                    <button class="view_button" onclick="panelView.classList.toggle('hidden');printView.classList.toggle('hidden');" id="panelViewButton">
                        <img src="../assets/icons/view_grid-black-18dp.svg"/>
                    </button>
                    <button class="view_button" onclick="panelView.classList.toggle('hidden');printView.classList.toggle('hidden');" id="printViewButton">
                        <img src="../assets/icons/print-black-18dp.svg"/>
                    </button>                      
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper">
                    <form action="" id="" method="POST" class="db_panel">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/backpack-black-18dp.svg"/>
                            Contents of fencer's bag
                        </div>
                        <div class="db_panel_main">
                            <div class="table">
                                <div class="table_header">
                                    <div class="table_header_text">ISSUE</div>
                                    <div class="table_header_text">QUANTITY</div>
                                    <div class="big_status_header"></div>
                                </div>
                                <div class="table_row_wrapper alt">
                                    <div class="table_row">
                                        <div class="table_item"><p>Epee</p></div>
                                        <div class="table_item"><input value="" name="" type="number" placeholder="#"></div>
                                        <div class="big_status_item">
                                            <input type="checkbox" name="bag_content" id="epee" value=""/>
                                            <label for="epee"></label>
                                        </div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item"><p>Epee</p></div>
                                        <div class="table_item"><input value="" name="" type="number" placeholder="#"></div>
                                        <div class="big_status_item">
                                            <input type="checkbox" name="bag_content" id="foil" value=""/>
                                            <label for="foil"></label>
                                        </div>
                                    </div>
                                    <div class="table_row">
                                        <div class="table_item"><p>Epee</p></div>
                                        <div class="table_item"><input value="" name="" type="number" placeholder="#"></div>
                                        <div class="big_status_item">
                                            <input type="checkbox" name="bag_content" id="sabre" value=""/>
                                            <label for="sabre"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </form>
                </div>
                <div class="paper_wrapper hidden">
                    <div class="paper">
                        <div class="title_container">
                            <div><p class="title">{Fencer's name}'S CHECKING IN CERTIFICATE</p></div>
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
<script src="../js/list.js"></script>
<script src="../js/check_fencer.js"></script>
<script>
    var panelView = document.querySelector(".wrapper");
    var printView = document.querySelector(".paper_wrapper");

    function printPage() {
        window.print();
    }
</script>
</body>
</html>