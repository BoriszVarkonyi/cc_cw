<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    class wc {
        public $array_of_issues;
        public $notes;

        function  __construct($array_of_issues, $notes) {
            $this -> array_of_issues = $array_of_issues;
            $this -> notes = $notes;
        }
    }

    // array of all issues
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

    $fencer_id = $_GET['fencer_id'];

    $qry_get_fencers = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
    $do_get_f_data = mysqli_query($connection, $qry_get_fencers);

    if ($row = mysqli_fetch_assoc($do_get_f_data)) {
	    	$json_string = $row['data'];
		    $json_table = json_decode($json_string);
    }

    $id_to_find = findObject($json_table, $fencer_id, "id");
    $fencer_name = $json_table[$id_to_find] -> nom . " " . $json_table[$id_to_find] -> prenom;

    //check wc
    $qry_wc = "SELECT data FROM weapon_control WHERE assoc_comp_id = $comp_id";
    $do_wc = mysqli_query($connection, $qry_wc);

    if ($row = mysqli_fetch_assoc($do_wc)) {
        $json_string = $row['data'];

        $json_table = json_decode($json_string);

        $notes = "";
        $array_of_real_issues = [];

        if (isset($json_table -> $fencer_id)) {
            $notes = $json_table -> $fencer_id -> notes;
            $array_of_real_issues = $json_table -> $fencer_id -> array_of_issues;
        }
    }

    if (isset($_POST['submit_wc'])) {

        $notes = $_POST['wc_notes'];
        $array_to_push = [];
        for ($i = 0; $i < count($array_issues); $i++) {
            $error_count = $_POST["issue_n_$i"];

            if ($error_count == "") {
                $array_to_push[$i] = 0;
            } else {
                $array_to_push[$i] = $error_count;
            }
        }


        if (!isset($json_table -> $fencer_id)) {
            $json_object = new wc($array_to_push, $notes);
            $json_table -> $fencer_id = $json_object;
        } else {
            $json_table -> $fencer_id -> array_of_issues = $array_to_push;
            $json_table -> $fencer_id -> notes = $notes;
        }


        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);

        $qry_update = "UPDATE weapon_control SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
        $do_update = mysqli_query($connection, $qry_update);
        echo mysqli_error($connection);
        //header("Refresh: 0");
    }

    //get wc type and page
    $qry_get_wc_type = "SELECT comp_wc_type FROM competitions WHERE comp_id = '$comp_id'";
    $do_get_wc_type = mysqli_query($connection, $qry_get_wc_type);
    if ($row = mysqli_fetch_assoc($do_get_wc_type)) {
        $wc_type = $row['comp_wc_type'];

        switch ($wc_type) {
            case 1://immidiate
                $wc_page = "weapon_control_immediate";
            break;
            case 2://administrative
                $wc_page = "weapon_control_administrated";
            break;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $fencer_name ?>'s weapon control</title>
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
                <p class="page_title"><?php echo $fencer_name ?>'s weapon control</p>
                <div class="stripe_button_wrapper">
                    <a class="stripe_button" href="../php/<?php echo $wc_page?>.php?comp_id=<?php echo $comp_id ?>">
                        <p>Back</p>
                        <img src="../assets/icons/close_black.svg"/>
                    </a>
                    <button name="submit_wc" class="stripe_button primary" type="submit" form="fencers_weapon_control_wrapper">
                        <p>Save weapon control</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <form action="" id="fencers_weapon_control_wrapper" class="wrapper" method="POST">
                    <div id="issues_panel" class="table">
                        <div class="table_header">
                            <div class="table_header_text">ISSUE</div>
                            <div class="table_header_text">QUANTITY</div>
                            <div class="big_status_header"></div>
                        </div>
                        <div class="table_row_wrapper">

                            <?php
                                foreach ($array_issues as $issue) {

                                $issue_id = array_search($issue, $array_issues);
                                if (isset($array_of_real_issues[$issue_id]) && $array_of_real_issues[$issue_id] != 0) {
                                    $issue_numbers = $array_of_real_issues[$issue_id];
                                } else {
                                    $issue_numbers = "";
                                }
                            ?>

                            <div class="table_row">
                                <div class="table_item"><p><?php echo $issue ?></p></div>
                                <div class="table_item"><input value="<?php echo $issue_numbers?>" name="issue_n_<?php echo $issue_id ?>" type="number" placeholder="#"></div>
                                <div class="big_status_item"> <!-- The inputs's id has to be identical with the label's for attribute or it WILL NOT WORK-->
                                    <input type="checkbox" name="issue_<?php echo $issue_id ?>" id="<?php echo $issue_id ?>" value=""/>
                                    <label for="<?php echo $issue_id ?>"></label>
                                </div>
                            </div>

                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div id="notes_panel">
                        <div class="table_header">
                            <div class="table_header_text title">NOTES</div>
                        </div>
                        <textarea name="wc_notes" id="wc_notes" placeholder="Type the notes here"><?php echo $notes ?></textarea>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
</body>
</html>
