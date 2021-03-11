<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

error_reporting(E_ERROR | E_PARSE);

//get competitors
$qry_get_data = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
$do_get_data = mysqli_query($connection, $qry_get_data);

if ($row = mysqli_fetch_assoc($do_get_data)) {
    $json_string = $row['data'];
    $json_table = json_decode($json_string);
} else {
    $json_table = [];
}


$tablearray = json_decode(json_encode($json_table), true);;

//Sorting fencers by nations(ABC)

function arrayOrderBy(array &$arr, $order = null)
{
    if (is_null($order)) {
        return $arr;
    }
    $orders = explode(',', $order);
    usort($arr, function ($a, $b) use ($orders) {
        $result = array();
        foreach ($orders as $value) {
            list($field, $sort) = array_map('trim', explode(' ', trim($value)));
            if (!(isset($a[$field]) && isset($b[$field]))) {
                continue;
            }
            if (strcasecmp($sort, 'desc') === 0) {
                $tmp = $a;
                $a = $b;
                $b = $tmp;
            }
            if (is_numeric($a[$field]) && is_numeric($b[$field])) {
                $result[] = $a[$field] - $b[$field];
            } else {
                $result[] = strcmp($a[$field], $b[$field]);
            }
        }
        return implode('', $result);
    });
    return $arr;
}

arrayOrderBy($tablearray, 'reg asc,nation asc');

// foreach($tablearray as $fencer){

//     echo $fencer["nation"] . " " . $fencer["reg"] . "<br>";

// }

// foreach ($json_table as $object) {

//     echo $object->nom . " ";
//     echo $object->nation  . " ";
//     echo $object->reg  . "<br>";
// }













//Counting each country's registered and not registered fencers



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
                        <img src="../assets/icons/print-black-18dp.svg" />
                    </button>
                </div>
                <div class="view_button_wrapper zoom">
                    <button class="view_button" onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out-black-18dp.svg" />
                    </button>
                    <button class="view_button" onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in-black-18dp.svg" />
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="paper_wrapper hidden">
                    <div class="paper">
                        <div class="title_container">
                            <div>
                                <p class="title">REGISTRATION REPORT</p>
                            </div>
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
                                    </div>

                                    <?php

                                    //Count who is ready and who is not

                                    $ready = 0;
                                    $notready = 0;

                                    foreach ($json_table as $object) {

                                        if ($object->reg == true) {
                                            $ready++;
                                        } else {
                                            $notready++;
                                        }
                                    }


                                    ?>

                                    <div class="grid_row_wrapper breakpoint_inside">
                                        <div class="grid_row breakpoint">
                                            <div class="grid_item">All Fencers</div>
                                            <div class="grid_item"><?php echo ($ready + $notready) ?></div>
                                        </div>
                                        <div class="grid_row breakpoint">
                                            <div class="grid_item">Fencers Registered in</div>
                                            <div class="grid_item"><?php echo $ready ?></div>
                                        </div>
                                        <div class="grid_row breakpoint">
                                            <div class="grid_item">Fencers not Registered in</div>
                                            <div class="grid_item"><?php echo $notready ?></div>
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

                                        <?php

                                        $ccode = "";

                                        $nations = new stdClass;

                                        foreach ($json_table as $object) {

                                            $actualNation = $object->nation;

                                            $nations->$actualNation->ready = 0;
                                            $nations->$actualNation->notready = 0;
                                        }

                                        foreach ($json_table as $object) {

                                            $actualNation = $object->nation;

                                            if ($object->reg == true) {
                                                $nations->$actualNation->ready += 1;
                                            } else {
                                                $nations->$actualNation->notready += 1;
                                            }
                                        }

                                        foreach ($nations as $country_code => $country_value) { ?>


                                            <div class="grid_row breakpoint">
                                                <div class="grid_item"><?php echo $country_code ?></div>
                                                <div class="grid_item"><?php echo ($country_value->ready + $country_value->notready) ?></div>
                                                <div class="grid_item"><?php echo $country_value->ready ?></div>
                                                <div class="grid_item"><?php echo $country_value->notready ?></div>
                                            </div>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="overview_wrapper">
                            <p class="label">FENCERS SORTED BY NATIONS</p>


                            <?php

                            function cmp($a, $b)
                            {
                                return strcmp($a->nation, $b->nation);
                            }

                            usort($json_table, "cmp");

                            $toCompare = "";

                            $firstrun = 1;

                            foreach ($json_table as $fencer) {

                                if ($fencer->nation == $toCompare) { ?>

                                    <div class="grid_row breakpoint">
                                        <div class="grid_item"><?php echo $fencer->prenom . " " . $fencer->nom ?></div>
                                        <div class="grid_item"><?php if ($fencer->reg == true) {
                                                                    echo "Registered";
                                                                } else {
                                                                    echo "Not registered";
                                                                } ?></div>
                                    </div>

                                <?php
                                } else {

                                    $toCompare = $fencer->nation;

                                ?>

                                    <?php

                                    if ($firstrun == 1) {

                                        $firstrun = 0;
                                    } else {

                                        echo "</div></div>";
                                    }

                                    ?>


                                    <p class="nat_label"><?php echo $fencer->nation ?></p>
                                    <div class="grid_table">
                                        <div class="grid_header breakpoint">
                                            <div class="grid_header_text">NAME</div>
                                            <div class="grid_header_text">STATUS</div>
                                        </div>
                                        <div class="grid_row_wrapper breakpoint_inside">


                                            <div class="grid_row breakpoint">
                                                <div class="grid_item"><?php echo $fencer->prenom . " " . $fencer->nom ?></div>
                                                <div class="grid_item"><?php if ($fencer->reg == true) {
                                                                            echo "Registered";
                                                                        } else {
                                                                            echo "Not registered";
                                                                        } ?></div>
                                            </div>


                                    <?php
                                }
                            }


                                    ?>


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

                                                    <?php

                                                    arrayOrderBy($tablearray, 'reg desc,nation asc');

                                                    foreach ($tablearray as $fencer2) { ?>

                                                        <div class="grid_row breakpoint">
                                                            <div class="grid_item"><?php echo $fencer2["nom"] . " " . $fencer2["prenom"] ?></div>
                                                            <div class="grid_item"><?php echo $fencer2["nation"] ?></div>
                                                            <div class="grid_item"><?php if ($fencer2["reg"] != NULL) {
                                                                            echo "Registered";
                                                                        } else {
                                                                            echo "Not registered";
                                                                        } ?></div>
                                                        </div>

                                                    <?php }

                                                    ?>


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