<?php include "includes/headerburger.php"; ?>
<?php include "includes/db.php" ?>
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

$number_of_ready_fencers = 0;
$number_of_all_fencers = 0;

foreach ($json_table as $object) {

    if ($object->reg == true) {
        $number_of_ready_fencers++;
    }
    $number_of_all_fencers++;
}

$competition_query = "SELECT comp_sex AS sex, comp_weapon AS weapon, comp_start AS start_time FROM competitions WHERE comp_id = $comp_id";
$do_competition_query = mysqli_query($connection, $competition_query);
$competition_data = mysqli_fetch_assoc($do_competition_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Statistics</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_paper_style.min.css">
    <link rel="stylesheet" href="../css/print_list_style.min.css" media="print">
</head>

<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Registration Statistics</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" type="button" onclick="printPage()">
                        <p>Print Statistics</p>
                        <img src="../assets/icons/print_black.svg" />
                    </button>
                </div>
                <div class="view_button_wrapper first">
                    <button onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out_black.svg" />
                    </button>
                    <button onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in_black.svg" />
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
                                    <p>
                                        <?php if ($competition_data['sex'] == 2) : ?>
                                            Male
                                        <?php else : ?>
                                            Female
                                        <?php endif ?>
                                    </p>
                                    <p>
                                        <?php if ($competition_data['weapon'] == 1) : ?>
                                            Epee
                                        <?php endif ?>
                                        <?php if ($competition_data['weapon'] == 2) : ?>
                                            Foil
                                        <?php endif ?>
                                        <?php if ($competition_data['weapon'] == 3) : ?>
                                            Sabre
                                        <?php endif ?>
                                    </p>
                                </div>
                                <p><?php echo $competition_data['start_time'] ?></p>
                            </div>
                        </div>
                        <div class="paper_content">
                            <div class="overview_wrapper">
                                <p class="label">OVERVIEW</p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>SECTION NAME</th>
                                            <th>QUANTITY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>All Fencers</td>
                                            <td><?php echo ($number_of_all_fencers) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Fencers Registered in</td>
                                            <td><?php echo $number_of_ready_fencers ?></td>
                                        </tr>
                                        <tr>
                                            <td>Fencers not Registered in</td>
                                            <td><?php echo $number_of_all_fencers - $number_of_ready_fencers ?></td>
                                        </tr>
                                    </tbody>
                            </div>
                        </div>
                        <div class="overview_wrapper">
                            <p class="label">REGISTERED AND NOT REGISTERED FENCERS BY NATIONS</p>
                            <table>
                                <thead>
                                    <tr>
                                        <th>NATIONALITY</th>
                                        <th>ALL FENCERS</th>
                                        <th>REGISTERED IN</th>
                                        <th>NOT REGISTERED IN</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $ccode = "";

                                    $nations = new stdClass;

                                    foreach ($json_table as $object) {

                                        $actualNation = $object->nation;

                                        $nations->$actualNation->number_of_ready_fencers = 0;
                                        $nations->$actualNation->not_ready = 0;
                                    }

                                    foreach ($json_table as $object) {

                                        $actualNation = $object->nation;

                                        if ($object->reg == true) {
                                            $nations->$actualNation->number_of_ready_fencers += 1;
                                        } else {
                                            $nations->$actualNation->not_ready += 1;
                                        }
                                    }

                                    foreach ($nations as $country_code => $country_value) : ?>


                                        <tr>
                                            <td><?php echo $country_code ?></td>
                                            <td><?php echo ($country_value->number_of_ready_fencers + $country_value->not_ready) ?></td>
                                            <td><?php echo $country_value->number_of_ready_fencers ?></td>
                                            <td><?php echo $country_value->not_ready ?></td>
                                        </tr>

                                    <?php endforeach ?>
                                </tbody>
                            </table>
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
                                <tr>
                                    <td><?php echo $fencer->prenom . " " . $fencer->nom ?></td>
                                    <td>
                                        <?php if ($fencer->reg == true) : ?>
                                            Registered
                                        <?php else : ?>
                                            Not registered
                                        <?php endif ?>
                                    </td>
                                </tr>

                            <?php
                            } else {
                                $toCompare = $fencer->nation;
                            ?>

                                <?php
                                if ($firstrun == 1)
                                    $firstrun = 0;
                                else
                                    echo "</div></div>";
                                ?>
                                <p class="nat_label"><?php echo $fencer->nation ?></p>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $fencer->prenom . " " . $fencer->nom ?></td>
                                            <td>
                                                <?php if ($fencer->reg == true) : ?>
                                                    Registered
                                                <?php else : ?>
                                                    Not registered
                                                <?php endif ?>
                                            </td>
                                        </tr>


                                <?php
                            }
                        }


                                ?>


                    </div>
                    <div class="overview_wrapper">
                        <p class="label">ALL FENCERS</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>NATIONALITY</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                arrayOrderBy($tablearray, 'reg desc,nation asc');

                                foreach ($tablearray as $fencer2) : ?>

                                    <tr>
                                        <td><?php echo $fencer2["nom"] . " " . $fencer2["prenom"] ?></td>
                                        <td><?php echo $fencer2["nation"] ?></td>
                                        <td>
                                            <?php if ($fencer2["reg"] != NULL) : ?>
                                                Registered
                                            <?php else : ?>
                                                Not registered
                                            <?php endif ?>
                                        </td>
                                    </tr>

                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </div>
    </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/controls.js"></script>
    <script src="javascript/print.js"></script>
</body>

</html>