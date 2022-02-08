<?php 
include "db.php";

    $comp_id = filter_input(INPUT_GET, "comp_id");

    session_start();
    if(!isset($_SESSION['fencer_name'])) {
        header("Location: competition.php?comp_id=$comp_id");
    }

    $qry_get_weapon_control = "SELECT data FROM weapon_control WHERE assoc_comp_id = $comp_id;";
    $do_get_weapon_control = mysqli_query($connection, $qry_get_weapon_control);


    $weapon_control_set = false;
    $checked_out = false;
    $weapons = array();

    if($do_get_weapon_control) {
        $json_data = mysqli_fetch_assoc($do_get_weapon_control)["data"];
        $data = json_decode($json_data);
        if(property_exists($data, $_SESSION['fencer_id'])) {
            $fencer_id = $_SESSION['fencer_id'];
            var_dump($data->$fencer_id);
            $checked_out = $data->$fencer_id->checked_out;
            $weapon_control_set = true;
            $weapons = $data->{$fencer_id}->array_of_issues;
        }
    } else {
        echo mysqli_error($connection);
    }

    //copied from cw/fencers_weapon_control.php
    $array_issues = array(
        "FIE mark on blade",
        "Arm gap and weight",
        "Arm lenght",
        "Blade lenght",
        "Grip lenght",
        "Form and depth of the guard",
        "Guard oxydation/ deformation",
        "Excentricity of the blade",
        "Blade flexibility",
        "Curve on the blade",
        "Foucault current device",
        "point and arm size",
        "spring of the point",
        "total travel of the point",
        "residual travel of the point",
        "isolation of the point",
        "resistance of the arm",
        "length/ condition of body/ mask wire",
        "resistance of body/ mask wire",
        "mask: FIE mark",
        "mask: condition and insulation",
        "mask: resistance (sabre, foil)",
        "metallic jacket condition",
        "metallic jacket resistance",
        "sabre glove/ overlay condition",
        "sabre glove/ overlay resistance",
        "glove condition",
        "jacket condition",
        "breeches condition",
        "under-plastron condition",
        "foil chest protector",
        "socks",
        "incorrect name printing",
        "incorrect national logo",
        "commercial",
        "other items",
    );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finished competitions</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="finished_competitions">
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>My Weapon Control Report</h1>
            </div>
            <div id="content_wrapper">
                <div id="weapon_control_info" class="red">
                    <p id="fencer_name"><?php echo $_SESSION['fencer_name'] ?>'s Weapon Control</p>
                    <p id="wc_status">Status: <?php if($weapon_control_set) echo "Set"; else echo "Unset"; ?></p>
                    <p><?php if($checked_out) echo "Checked Out"; else echo "Not checked out"; ?></p>
                </div>

                <!-- only if administrated weapo control -->
                <h1>EQUIPMENT GIVEN FOR CONTROL</h1>
                <table class="no_interaction">
                    <thead>
                        <tr>
                            <th><p>EQUIPMENT</p></th>
                            <th><p>QUANTITY</p></th>
                        </tr>
                    </thead>
                    <tbody class="alt">
                        <?php if(property_exists($data, $_SESSION['fencer_id'])): ?>
                            <?php foreach($data->$fencer_id->equipment as $key => $quantity): ?>
                                <tr>
                                    <td>
                                        <p><?php echo $array_issues[$key]; ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $quantity; ?></p>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">Nothing found</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>

                <h1>WEAPON CONTROL RESULTS</h1>
                <table class="no_interaction">
                    <thead>
                        <tr>
                            <th><p>ISSUES</p></th>
                            <th><p>QUANTITY</p></th>
                        </tr>
                    </thead>
                    <tbody class="alt">
                        <tr>
                            <td>
                                <p>Issue name</p>
                            </td>
                            <td>
                                <p>quantritxy</p>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="../js/cookie_monster.js"></script>
    <script src="javascript/bookmark_competition.js"></script>
    <script src="javascript/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/competitions.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>