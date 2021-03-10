<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

//get competitors
$qry_get_data = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
$do_get_data = mysqli_query($connection, $qry_get_data);

if ($row = mysqli_fetch_assoc($do_get_data)) {
    $json_string = $row['data'];
    $json_table = json_decode($json_string);
} else {
    $json_table = [];
}

//Sorting fencers by nations(ABC)

function cmp($a, $b) {
    return strcmp($a->nation, $b->nation);
}

usort($json_table, "cmp");

//Count who is ready and who is not

$ready = 0;
$notready = 0;

foreach($json_table as $object){

    if ($object->reg == true) {
        $ready++;
    }
    else{
        $notready++;
    }

}

echo $ready . "<br>";
echo $notready;

//Counting

foreach($json_table as $object){

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Statistics</title>
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/print_registration.min.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
                <div id="title_stripe">
                    <p class="page_title">Weapon Control Statistics</p>
                    <div class="stripe_button_wrapper">
                        <button class="stripe_button primary" type="button" onclick="printPage()">
                            <p>Print Statistics</p>
                            <img src="../assets/icons/print-black-18dp.svg"/>
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
                </div>
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
                                <div class="overview_wrapper">
                                    <p class="label">OVERVIEW</p>
                                    <div class="grid_table">
                                        <div class="grid_header breakpoint">
                                            <div class="grid_header_text">SECTION NAME</div>
                                            <div class="grid_header_text">QUANTITY</div>
                                            <div class="grid_header_text">PERCENTAGE</div>
                                        </div>
                                        <div class="grid_row_wrapper breakpoint_inside">
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">All Fencers</div>
                                                <div class="grid_item">252</div>
                                                <div class="grid_item">-</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">Fencers Registered in</div>
                                                <div class="grid_item">128</div>
                                                <div class="grid_item">45.9%</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">Fencers not Registered in</div>
                                                <div class="grid_item">156</div>
                                                <div class="grid_item">66.454%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overview_wrapper">
                                    <p class="label">REGISTERED AND NOT REGISTERED FENCERS BY NATIONS</p>
                                    <div class="grid_table">
                                        <div class="grid_header breakpoint">
                                            <div class="grid_header_text">NATIONALITY</div>
                                            <div class="grid_header_text">ALL FENCERS</div>
                                            <div class="grid_header_text">REGISTERED IN</div>
                                            <div class="grid_header_text">NOT REGISTERED IN</div>
                                        </div>
                                        <div class="grid_row_wrapper breakpoint_inside">
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HUN</div>
                                                <div class="grid_item">120</div>
                                                <div class="grid_item">52 (15%)</div>
                                                <div class="grid_item">663 (82%)</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HUN</div>
                                                <div class="grid_item">120</div>
                                                <div class="grid_item">52 (15%)</div>
                                                <div class="grid_item">663 (82%)</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HUN</div>
                                                <div class="grid_item">120</div>
                                                <div class="grid_item">52 (15%)</div>
                                                <div class="grid_item">663 (82%)</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overview_wrapper">
                                    <p class="label">FENCERS SORTED BY NATIONS</p>
                                    <p class="nat_label">HUN</p>
                                    <div class="grid_table">
                                        <div class="grid_header breakpoint">
                                            <div class="grid_header_text">NAME</div>
                                            <div class="grid_header_text">STATUS</div>
                                        </div>
                                        <div class="grid_row_wrapper breakpoint_inside">
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">NAME</div>
                                                <div class="grid_item">LOL</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HT</div>
                                                <div class="grid_item">BAS</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overview_wrapper">
                                    <p class="label">ALL FENCERS</p>
                                    <div class="grid_table">
                                        <div class="grid_header breakpoint">
                                            <div class="grid_header_text">NAME</div>
                                            <div class="grid_header_text">NATIONALITY</div>
                                            <div class="grid_header_text">STATUS</div>
                                        </div>
                                        <div class="grid_row_wrapper breakpoint_inside">
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">NAME</div>
                                                <div class="grid_item">nat</div>
                                                <div class="grid_item">LOL</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HT</div>
                                                <div class="grid_item">NAME</div>
                                                <div class="grid_item">BAS</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                                <div class="grid_item">NAME</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                                <div class="grid_item">NAME</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                                <div class="grid_item">NAME</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                                <div class="grid_item">NAME</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                                <div class="grid_item">NAME</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                                <div class="grid_item">NAME</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">NAME</div>
                                                <div class="grid_item">nat</div>
                                                <div class="grid_item">LOL</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HT</div>
                                                <div class="grid_item">NAME</div>
                                                <div class="grid_item">BAS</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                                <div class="grid_item">NAME</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                                <div class="grid_item">NAME</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                                <div class="grid_item">NAME</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                                <div class="grid_item">NAME</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                                <div class="grid_item">NAME</div>
                                            </div>
                                            <div class="grid_row breakpoint">
                                                <div class="grid_item">HRT</div>
                                                <div class="grid_item">GOOF</div>
                                                <div class="grid_item">NAME</div>
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
    <script src="../js/controls.js"></script>
    <script src="../js/print.js"></script>
</body>
</html>