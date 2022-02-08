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

    //get wc type and page
    $qry_get_wc_type = "SELECT comp_wc_type FROM competitions WHERE comp_id = '$comp_id'";
    $do_get_wc_type = mysqli_query($connection, $qry_get_wc_type);
    if ($row = mysqli_fetch_assoc($do_get_wc_type)) {
        $wc_type = $row['comp_wc_type'];

        switch ($wc_type) {
            case 1://immediate
                $wc_page = "weapon_control_immediate";
            break;
            case 2://administrative
                $wc_page = "weapon_control_administrated";
            break;
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

    // if fencer_id is not set go back to the last page
    if (findObject($json_table, $fencer_id, "id") === "") {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
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
        header("Location: ../cc/$wc_page.php?comp_id=$comp_id");
        

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
                    <a class="stripe_button" href="../cc/<?php echo $wc_page?>.php?comp_id=<?php echo $comp_id ?>">
                        <p>Go back to Weapon Control</p>
                        <img src="../assets/icons/arrow_back_ios_black.svg"/>
                    </a>
                    <button name="submit_wc" class="stripe_button primary" type="submit" form="fencers_weapon_control_wrapper">
                        <p>Save Weapon Control</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <form action="" id="fencers_weapon_control_wrapper" class="wrapper" method="POST">
                    <table id="issues_panel">
                        <thead>
                            <tr>
                                <th>
                                    <div class="search_panel">
                                        <div class="search_wrapper">
                                            <input type="text" onkeyup="searchInLists()" placeholder="Search by Name" class="search page">
                                            <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                        </div>
                                    </div>
                                    <div class="table_buttons_wrapper">
                                        <button type="button" onclick="sortButton(this)">
                                            <img src="../assets/icons/switch_full_black.svg">
                                        </button>
                                        <p>ISSUE</p>
                                        <button type="button" onclick="searchButton(this)">
                                            <img src="../assets/icons/search_black.svg">
                                        </button>
                                    </div>
                                </th>
                                <th>
                                    <p>QUANTITY</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                foreach ($array_issues as $issue) {

                                $issue_id = array_search($issue, $array_issues);
                                if (isset($array_of_real_issues[$issue_id]) && $array_of_real_issues[$issue_id] != 0) {
                                    $issue_numbers = $array_of_real_issues[$issue_id];
                                } else {
                                    $issue_numbers = "";
                                }
                            ?>

                            <tr>
                                <td><p><?php echo $issue ?></p></td>
                                <td><input value="<?php echo $issue_numbers?>" name="issue_n_<?php echo $issue_id ?>" type="number" placeholder="#"></td>
                            </tr>

                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <div id="notes_panel">
                        <p>NOTES</p>
                        <textarea name="wc_notes" id="wc_notes" placeholder="Type the notes here"><?php echo $notes ?></textarea>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list_search_2.js"></script>
</body>
</html>
