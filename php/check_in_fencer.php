<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php
    $fencer_id = $_GET['fencer_id'];

    //get base table
    $qry_get_wc = "SELECT `data` FROM `weapon_control` WHERE `assoc_comp_id` = '$comp_id'";
    $do_get_wc = mysqli_query($connection, $qry_get_wc);

    if ($row = mysqli_fetch_assoc($do_get_wc)) {
        $wc_string = $row['data'];
        $wc_table = json_decode($wc_string);
    }

    class wc {
        public $checked_out = false;
        public $issues = NULL;
        public $equipment = NULL;
        public $notes;
        public $id;

        public function __construct($id){
            $this -> id = $id;
        }
    }

    //get fencers data
    $qry_get_name = "SELECT `data` FROM `competitors` WHERE `assoc_comp_id` = '$comp_id'";
    $do_get_name = mysqli_query($connection, $qry_get_name);

    if ($row = mysqli_fetch_assoc($do_get_name)) {
        $compet_string = $row['data'];
        $compet_table = json_decode($compet_string);

        if ($id_to_find = findObject($compet_table, $fencer_id, "id") !== false) {
            $name =  $compet_table[$id_to_find] -> prenom . " " . $compet_table[$id_to_find] -> nom;
        }

    }

    //search for existing equipment turned in
    if ($id_to_find = searchObject($wc_table, $fencer_id, "id") !== false) {
        //get data from existing check in
    } else {
        //make new check in
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check in <?php echo $name ?></title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_check_out_fencer_style.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Check in <?php echo $name ?></p>
                <div class="stripe_button_wrapper">
                    <button name="" id="" class="stripe_button" shortcut="SHIFT+P" onclick="printPage()">
                        <p>Print Check In</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                    <button name="" class="stripe_button primary" type="submit" form="" shortcut="SHIFT+S" onclick="location.href='weapon_control_administrated.php?comp_id=<?php echo $comp_id ?>'">
                        <p>Save Check In</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
                <div class="view_button_wrapper first">
                    <button onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out_black.svg"/>
                    </button>
                    <button onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in_black.svg"/>
                    </button>
                </div>
                <div class="view_button_wrapper fourth">
                    <button onclick="viewButton(this)" id="panelViewButton">
                        <img src="../assets/icons/view_grid_black.svg"/>
                    </button>
                    <button onclick="viewButton(this)" id="printViewButton">
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper">
                    <form action="" id="" method="POST" class="db_panel">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/backpack_black.svg"/>
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
            <?php
                //get comp_data for printing
                $qry_get_comp_data = "SELECT * FROM `competitions` WHERE `comp_id` = '$comp_id'";
                $do_get_comp_data = mysqli_query($connection, $qry_get_comp_data);

                if ($row = mysqli_fetch_assoc($do_get_comp_data)) {
                    $sex = $row['comp_sex'];
                    $w_type = $row['comp_weapon'];
                }

                //from basic info
                $qry_get_bi = "SELECT data FROM basic_info WHERE assoc_comp_id = '$comp_id'";
                $do_get_bi = mysqli_query($connection, $qry_get_bi);

                if ($row = mysqli_fetch_assoc($do_get_bi)) {
                    $json_string = $row['data'];
                    $json_table = json_decode($json_string);
                    echo "asdasdasdasda";
                    $start_time = $json_table -> starting_date;
                } else {
                    $start_time = "start time: Not defined!";
                }
            ?>
                <div class="paper_wrapper hidden">
                    <div class="paper">
                        <div class="title_container">
                            <div><p class="title"><?php echo $name ?>'S CHECKING IN CERTIFICATE</p></div>
                            <div class="comp_info small">
                                <p class="info_label"><?php echo $comp_name ?></p>
                                <div>
                                    <p><?php echo sexConverter($sex) ?></p>
                                    <p><?php echo weaponConverter($w_type) ?></p>
                                </div>
                                <p><?php echo $start_time ?></p>
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
                                                <div class="grid_item"><?php echo $name ?></div>
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
        </main>
    </div>
<script src="../js/cookie_monster.js"></script>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/print.js"></script>
<script src="../js/check_fencer.js"></script>
</body>
</html>