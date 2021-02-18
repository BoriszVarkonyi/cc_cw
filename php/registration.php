<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <?php include "../includes/headerburger.php"; ?>
    <!-- header -->
        <div id="flexbox_container">
            <?php include "../includes/navbar.php"; ?>
            <!-- navbar -->
        <div class="page_content_flex">

        <?php

            if(isset($_POST["reg_in"])){

            $idtoregin = $_POST["fencer_ids"];

            $query = "UPDATE cptrs_$comp_id SET reg = 1 WHERE id = '$idtoregin'";
            $query_do = mysqli_query($connection, $query);

            header("Location: registration.php?comp_id=$comp_id");

            }

            if(isset($_POST["reg_out"])){

                $idtoregin = $_POST["fencer_ids"];

                $query = "UPDATE cptrs_$comp_id SET reg = 0 WHERE id = '$idtoregin'";
                $query_do = mysqli_query($connection, $query);

                header("Location: registration.php?comp_id=$comp_id");

                }

            if(isset($_POST["add_fencer"])){

                $n_fname = $_POST["fencer_name"];
                $f_nat = $_POST["f_nat"];
                $f_pos = $_POST["fencer_position"];


                $query_get_max = "SELECT * FROM cptrs_$comp_id";
                $query_get_max_do = mysqli_query($connection, $query_get_max);

                $add_id = "l" . rand(1, 500);

                $checkarray = [];

                while($row = mysqli_fetch_assoc($query_get_max_do)){

                    $idmatch = $row["id"];

                    if($idmatch != $add_id){

                    array_push($checkarray, "0");

                    }
                    else{

                        $row = mysqli_fetch_assoc($query_get_max_do);
                        $add_id = "l" . rand(1, 500);
                        continue;
                    }

                }

                if(count($checkarray) == mysqli_num_rows($query_get_max_do)){

                    $query = "INSERT INTO `cptrs_$comp_id`(`id`, `name`, `nationality`,`rank`) VALUES ('$add_id','$n_fname','$f_nat',$f_pos)";
                    $query_do = mysqli_query($connection, $query);

                    echo mysqli_error($connection);

                }

                header("Location: registration.php?comp_id=$comp_id");

            }

        ?>
                <form id="title_stripe" method="POST" action="">
                    <p class="page_title">Registration</p>
                    <div class="stripe_button_wrapper">
                        <button type="button" class="stripe_button" id="addFencer" onclick="toggleAddFencerPanel()" shortcut="SHIFT+A">
                            <p>Add Fencer</p>
                            <img src="../assets/icons/person_add_alt_1-black-18dp.svg"/>
                        </button>
                        <button class="stripe_button red" onclick="" name="reg_out" id="regOut" type="submit" shortcut="SHIFT+O">
                            <p>Register out</p>
                            <img src="../assets/icons/how_to_unreg-black-18dp.svg"/>
                        </button>
                        <button class="stripe_button green" onclick="" name="reg_in" id="regIn" type="submit" shortcut="SHIFT+I">
                            <p>Register in</p>
                            <img src="../assets/icons/how_to_reg-black-18dp.svg"/>
                        </button>
                    </div>
                    <input type="text" class="hidden selected_list_item_input" name="fencer_ids" id="fencer_ids" value="">
                    <div class="search_wrapper">
                        <button type="button" ><img src="../assets/icons/close-black-18dp.svg"></button>
                        <input type="text" name="" onfocus="resultChecker(this), isOpen()" onblur="isClosed()" onkeyup="searchEngine(this)" id="inputs" placeholder="Search by Name" class="search">
                        <div class="search_results">
                            <?php
                            foreach ($json_table as $json_object) {
                                $username = $json_object -> username;
                                $name = $json_object -> name;

                                ?>
                                <a id="<?php echo $username ?>A" href="#<?php echo $username ?>" onclick="selectSearch(this), autoFill(this)" tabindex="1"><?php echo $name ?></a>
                                <?php
                            }
                                ?>
                        </div>
                    </div>

                </form>
                <div id="add_fencer_panel" class="overlay_panel hidden">
                            <button class="panel_button" onclick="toggleAddFencerPanel()">
                                <img src="../assets/icons/close-black-18dp.svg" >
                            </button>
                            <!-- add fencers drop-down -->
                            <form action="registration.php?comp_id=<?php echo $comp_id ?>" method="post" id="new_fencer" autocomplete="off" class="overlay_panel_form">
                                <label for="fencers_name" >NAME</label>
                                <input type="text" placeholder="Type the fencers's name" class="username_input" name="fencer_name">
                                <label for="fencers_nationality">NATION / CLUB</label>
                                <div class="search_wrapper">
                                    <input type="text" name="f_nat" onfocus="resultChecker(this), isOpen()" onblur="isClosed()" onkeyup="searchEngine(this)" id="inputs" placeholder="Search Country by Name" class="search cc">
                                    <button type="button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                                    <div class="search_results">
                                        <?php include "../includes/nations.php"; ?>
                                    </div>
                                </div>
                                <label for="fencers_points" >POSITION</label>
                                <input type="number" placeholder="##" id="ranking_points" class="number_input centered" name="fencer_position">
                                <button type="submit" name="add_fencer" class="panel_submit">Save</button>
                            </form>
                        </div>
                <div id="page_content_panel_main">

                    <div class="table wrapper">

               <?php

               $query = "SELECT * FROM cptrs_$comp_id ORDER BY name";
               $query_do = mysqli_query($connection, $query);


               ?>
                        <div class="table_header">
                            <div class="table_header_text">NAME</div>
                            <button class="resizer" onmousedown="mouseDown(this)" onmouseup="mouseUp(this)" ></button>
                            <div class="table_header_text">NATION / CLUB</div>
                            <button class="resizer"></button>
                            <div class="table_header_text">STATUS</div>
                            <div class="big_status_header"></div>
                        </div>
                        <div class="table_row_wrapper">
                        <?php

                        while($row = mysqli_fetch_assoc($query_do)){

                        $name = $row["name"];
                        $nat = $row["nationality"];
                        $stat = $row["reg"];
                        $id = $row["id"];

                        ?>

                        <div class="table_row" id="<?php echo $id ?>" onclick="selectRow(this)" tabindex="0">
                            <div class="table_item"><p><?php echo $name ?></p></div>
                            <div class="table_item"><p><?php echo $nat ?></p></div>
                            <div class="table_item"><p><?php if($stat == 0){echo "Not registered";}else{echo "Registered";} ?></p></div>
                            <div class="big_status_item <?php if($stat == 0){echo "red";}else{echo "green";} ?>"></div>
                        </div>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/registration.js"></script>
    <script src="../js/controls.js"></script>
</body>
</html>