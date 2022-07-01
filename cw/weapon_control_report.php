<?php
include "includes/db.php";

    $comp_id = filter_input(INPUT_GET, "comp_id");

    session_start();

    $fencer_id = $_SESSION['fencer_id'];
    if(!isset($_SESSION['fencer_name'])) {
        header("Location: competition.php?comp_id=$comp_id");
    }

    $qry_get_weapon_control = "SELECT * FROM weapon_control WHERE assoc_comp_id = $comp_id AND fencer_id = $fencer_id;";
    $do_get_weapon_control = mysqli_query($connection, $qry_get_weapon_control);

    if($do_get_weapon_control) {
        $data = mysqli_fetch_assoc($do_get_weapon_control);
        $issues_array = json_decode($data['issues_array']) ?? [];
        $turned_in_array = json_decode($data['weapons_turned_in']);
    } else {
        echo mysqli_error($connection);
        $issues_array = [];
        $turned_in_array = [];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finished competitions</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/dv_mainstyle.min.css">
</head>
<body class="finished_competitions">
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>
                    <a class="back_button" href=".php" aria-label="Go back to Competition's page">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </a>
                    My Weapon Control Report
                </h1>
            </div>
            <div id="content_wrapper">
                <div id="weapon_control_info" class="red">
                    <p id="fencer_name"><?php echo $_SESSION['fencer_name'] ?>'s Weapon Control</p>
                    <p id="wc_status">Status: <?php if($issues_array !== []) echo "Set"; else echo "Unset"; ?></p>
                    <p><?php if($data['check_out_date'] !== null)  echo "Checked Out"; else echo "Not checked out"; ?></p>
                </div>

                <!-- only if administrated weapon control -->
                <?php if($turned_in_array !== null) : ?>
                <h1>EQUIPMENT GIVEN FOR CONTROL</h1>
                <table class="no_interaction">
                    <thead>
                        <tr>
                            <th><p>EQUIPMENT</p></th>
                            <th><p>QUANTITY</p></th>
                        </tr>
                    </thead>
                    <tbody class="alt">
                        <?php include "views/AdministeredWeaponControl.php" ?>
                    </tbody>
                </table>
                <?php endif ?>


                <h1>WEAPON CONTROL RESULTS</h1>
                <table class="no_interaction">
                    <thead>
                        <tr>
                            <th><p>ISSUES</p></th>
                            <th><p>QUANTITY</p></th>
                        </tr>
                    </thead>
                    <tbody class="alt">
                        <?php include "views/WeaponControl.php" ?>
                    </tbody>
                </table>


            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/bookmark_competition.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/competitions.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>