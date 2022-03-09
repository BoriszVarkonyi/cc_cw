<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

//make table
$qry_make_table = "CREATE TABLE `ccdatabase`.`pistes` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
if (!$do_make_table = mysqli_query($connection, $qry_make_table)) {
    echo mysqli_error($connection);
}

//get data / make new row
$qry_get_data = "SELECT data FROM pistes WHERE assoc_comp_id = '$comp_id'";
$do_get_data = mysqli_query($connection, $qry_get_data);

if ($row = mysqli_fetch_assoc($do_get_data)) {
    $data = $row['data'];

    print_r($json_table = json_decode($data));
} else {
    $json_table = [];

    $qry_new_row = "INSERT INTO pistes (assoc_comp_id, data) VALUES ('$comp_id', '[ ]')";
    if (!$do_new_row = mysqli_query($connection, $qry_new_row)) {
        echo mysqli_error($connection);
    }
}

if (isset($_POST["create_piste"])) {

    class piste
    {
        public $name;
        public $color;
        public $available;
        public $url;
        public $connectable;

        function __construct($name, $color)
        {
            $this->name = $name;
            $this->color = $color;
            $this->available = true;
            $this->url = "";
            $this->connectable = 0;
        }
    }

    $issue = false;

    if ($_POST["piste_type"] == "main") {

        $p_name = $_POST["one_piste_name"];

        foreach ($json_table as $value) {

            if ($p_name == $value->name) {

                $issue = true;
            }
        }

        $piste_obj = new piste($p_name, 0);

        array_push($json_table, $piste_obj);
    } else if ($_POST["piste_type"] == "colored") {

        $p_name = $_POST["colored_piste_name"];
        $p_color = $_POST["piste_color"];

        foreach ($json_table as $value) {

            if ($p_name == $value->name) {

                $issue = true;
            }
        }

        $piste_obj = new piste($p_name, $p_color);

        echo array_push($json_table, $piste_obj);
    } else if ($_POST["piste_type"] == "numbered") {

        $quantity = $_POST["quantity"];
        $startnum = $_POST["start_num"];

        for ($i = 0; $i < $quantity; $i++) {

            foreach ($json_table as $value) {

                if ($startnum == $value->name) {

                    $issue = true;
                }
            }

            $piste_obj = new piste($startnum, 0);

            array_push($json_table, $piste_obj);

            $startnum++;
        }
    }

    if ($issue == false) {
        $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
        $qry_update = "UPDATE pistes SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
        if (!$do_update = mysqli_query($connection, $qry_update)) {
            echo mysqli_error($connection);
        }

        header("Location: pistes.php?comp_id=$comp_id");
    } else {

        echo "ERROR_ERROR";

        header("Location: pistes.php?comp_id=$comp_id");
    }
}

if (isset($_POST["delete_piste"])) {

    $piste_name = $_POST["id_to_change"];

    $counter = 0;
    foreach ($json_table as $key => $value) {

        if ($value->name == $piste_name) {

            if (count($json_table) == 1) {
                $json_table = [];
            } else {
                unset($json_table[$counter]);
            }
        }
        $counter++;
    }

    $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
    $qry_update = "UPDATE pistes SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
    if (!$do_update = mysqli_query($connection, $qry_update)) {
        echo mysqli_error($connection);
    }

    header("Location: pistes.php?comp_id=$comp_id");
}

if (isset($_POST["add_live"])) {

    echo "WORKING";

    $piste_name = $_POST["id_to_change"];
    $url = $_POST["piste_link"];

    foreach ($json_table as $key => $value) {

        if ($piste_name == $value->name) {

            $value->url = $url;
        }
    }
    $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
    $qry_update = "UPDATE pistes SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
    if (!$do_update = mysqli_query($connection, $qry_update)) {
        echo mysqli_error($connection);
    }
    header("Location: pistes.php?comp_id=$comp_id");
}

print_r($_POST);

if (isset($_POST["allow_connect"])) {

    echo "ASD";

    $piste_name = $_POST["id_to_change"];

    foreach ($json_table as $key => $value) {

        if ($piste_name == $value->name) {

            if ($value->connectable == 1) {
                $value->connectable = 0;
            } else {
                $value->connectable = 1;
            }
        }
    }
    $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);
    $qry_update = "UPDATE pistes SET data = '$json_string' WHERE assoc_comp_id = '$comp_id'";
    if (!$do_update = mysqli_query($connection, $qry_update)) {
        echo mysqli_error($connection);
    }
    header("Location: pistes.php?comp_id=$comp_id");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pistes</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/piste_style.min.css">
</head>

<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Pistes</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" onclick="toggleAddPistePanel()" id="addPisteBt" shortcut="SHIFT+A">
                        <p>Add Piste</p>
                        <img src="../assets/icons/add_black.svg" />
                    </button>
                </div>

                <div class="overlay_panel hidden" id="add_piste_panel">
                    <button class="panel_button" name="Close panel" onclick="toggleAddPistePanel()">
                        <img src="../assets/icons/close_black.svg">
                    </button>

                    <form action="pistes.php?comp_id=<?php echo $comp_id ?>" id="create_piste" autocomplete="off" class="overlay_panel_form flex" method="POST">
                        <label for="username">TYPE</label>
                        <div class="option_container row">
                            <input type="radio" onclick="mainPiste()" name="piste_type" id="main" value="main" />
                            <label for="main">Single</label>

                            <input type="radio" onclick="coloredPiste()" name="piste_type" id="colored" value="colored" />
                            <label for="colored">Colored</label>

                            <input type="radio" onclick="numberedPiste()" name="piste_type" id="numbered" value="numbered" />
                            <label for="numbered">Multiple</label>
                        </div>

                        <!--Main-->
                        <label for="piste_number" id="mainpiste_num_label" class="label_text hidden main_group">PISTE NAME</label>
                        <input type="text" id="mainpiste_num_input" class="number_input centered hidden main_group" placeholder="Main, 1, 2, 3, 4" name="one_piste_name">

                        <!--Colored-->
                        <label for="piste_number" class="label_text hidden colored_group">PISTE COLOR</label>
                        <div class="color_select hidden colored_group" id="colored_color_select">

                            <input type="radio" class="blue" id="blue" name="piste_color" value="1">
                            <label for="blue"></label>
                            <input type="radio" class="yellow" id="yellow" name="piste_color" value="2">
                            <label for="yellow"></label>
                            <input type="radio" class="green" id="green" name="piste_color" value="3">
                            <label for="green"></label>
                            <input type="radio" class="red" id="red" name="piste_color" value="4">
                            <label for="red"></label>
                        </div>

                        <label for="piste_number" class="label_text hidden colored_group">PISTE NAME</label>
                        <input type="text" class="number_input centered hidden colored_group" placeholder="e.g. 2" name="colored_piste_name">

                        <!--Numbered-->
                        <label for="piste_quanitity" class="label_text hidden numbered_group">PISTE QUANTITY</label>
                        <input type="number" class="number_input centered hidden numbered_group" placeholder="e.g. 2" name="quantity">

                        <label for="piste_quanitity" class="label_text hidden numbered_group">PISTE START NUMBER</label>
                        <input type="number" class="number_input centered hidden numbered_group" placeholder="e.g. 2" name="start_num">

                    </form>
                    <button type="submit" name="create_piste" class="panel_submit" form="create_piste" value="Import">Create</button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="pistes_wrapper">

                    <div id="colored_pistes_wrapper" class="piste_wrapper">

                        <?php

                        foreach ($json_table as $key => $value) {

                            if ($value->color == 0) {
                                continue;
                            }

                        ?>

                            <div id="<?php echo $value->name ?>" class="piste <?php echo pisteColor($value->color); ?>">
                                <div><p><?php echo pisteColorLetter($value->color); ?></p></div>
                                <div>
                                    <p>Piste</p>
                                    <p><?php echo $value->name ?></p>
                                    <div class="piste_status_indicator <?php

                                                                        if ($value->available == true) {

                                                                            echo "green";
                                                                        } else {

                                                                            echo "red";
                                                                        }


                                                                        ?>"></div>
                                </div>
                                <div>
                                    <button class="piste_config_button" onclick="togglePisteSettings(this)">
                                        <img src="../assets/icons/settings_black.svg">
                                    </button>
                                </div>
                                <form method="POST" class="piste_settings_panel">
                                    <div class="link_wrapper hidden">
                                        <input type="text" name="id_to_change" class="hidden" value="<?php echo $value->name ?>" />
                                        <input type="text" class="link_input" name="piste_link" value="<?php echo $value->url ?>">
                                        <button type="button" onclick="closeLinkWrapper(this)">
                                            <img src="../assets/icons/close_black.svg">
                                        </button>
                                        <button name="add_live" type="submit">
                                            <img src="../assets/icons/send_black.svg">
                                        </button>
                                    </div>
                                    <div class="settings_wrapper">
                                        <div>
                                            <p>Control</p>
                                            <button class="selected">
                                                <img src="../assets/icons/smartphone_black.svg">
                                            </button>
                                            <button name="allow_connect" type="submit" class="<?php if ($value->connectable == 1) {
                                                                                                    echo "selected";
                                                                                                } ?>">
                                                <img src="../assets/icons/laptop_black.svg">
                                            </button>
                                        </div>
                                        <div>
                                            <p>Live</p>
                                            <button type="button" name="add_link" onclick="liveButton(this)">
                                                <img src="../assets/icons/live_tv_black.svg">
                                            </button>
                                        </div>
                                        <div>
                                            <p>Delete</p>
                                            <button name="delete_piste" id="delete_piste" type="submit">
                                                <img src="../assets/icons/delete_black.svg">
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        <?php
                        }
                        ?>

                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                    </div>



                    <div id="numbered_pistes_wrapper" class="piste_wrapper">


                        <?php

                        foreach ($json_table as $key => $value) {

                            if ($value->color != 0) {
                                continue;
                            }

                        ?>


                            <div id="<?php echo $value->name ?>" class="piste numbered">
                                <div><p><?php echo $value->name ?></p></div>
                                <div>
                                    <p>Piste</p>
                                    <p>No.: <?php echo $value->name ?></p>
                                    <div class="piste_status_indicator <?php

                                                                        if ($value->available == true) {

                                                                            echo "green";
                                                                        } else {

                                                                            echo "red";
                                                                        }


                                                                        ?>"></div>
                                </div>
                                <div>
                                    <button class="piste_config_button" onclick="togglePisteSettings(this)">
                                        <img src="../assets/icons/settings_black.svg">
                                    </button>
                                </div>
                                <form method="POST" class="piste_settings_panel">
                                    <div class="link_wrapper hidden">
                                        <input name="id_to_change" class="hidden" value="<?php echo $value->name; ?>" />
                                        <input type="text" class="link_input" name="piste_link" value="<?php echo $value->url ?>">
                                        <button type="button" onclick="closeLinkWrapper(this)">
                                            <img src="../assets/icons/close_black.svg">
                                        </button>
                                        <button name="add_live" type="submit">
                                            <img src="../assets/icons/send_black.svg">
                                        </button>
                                    </div>
                                    <div class="settings_wrapper">
                                        <div>
                                            <p>Control</p>
                                            <button class="selected">
                                                <img src="../assets/icons/smartphone_black.svg">
                                            </button>
                                            <button name="allow_connect" type="submit" class="<?php if ($value->connectable == 1) {
                                                                                                    echo "selected";
                                                                                                } ?>">
                                                <img src="../assets/icons/laptop_black.svg">
                                            </button>
                                        </div>
                                        <div>
                                            <p>Live</p>
                                            <button type="button" onclick="liveButton(this)">
                                                <img src="../assets/icons/live_tv_black.svg">
                                            </button>
                                        </div>
                                        <div>
                                            <p>Delete</p>
                                            <button name="delete_piste" id="delete_piste" type="submit">
                                                <img src="../assets/icons/delete_black.svg">
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        <?php
                        }
                        ?>
                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                        <div class="piste ghost"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/pistes.js"></script>
    <script src="javascript/overlay_panel.js"></script>
</body>

</html>