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
                    <button type="button" class="stripe_button bold" onclick="toggleAddFencerPanel()">
                        <p>Add Fencer</p>
                        <img src="../assets/icons/add-black-18dp.svg"></img>
                    </button>
                    <button class="stripe_button orange" onclick="" name="reg_in" type="submit">
                        <p>Register in</p>
                        <img src="../assets/icons/how_to_reg-black-18dp.svg"></img>
                     </button>
                    <button class="stripe_button orange" onclick="" name="reg_out" type="submit">
                        <p>Register out</p>
                        <img src="../assets/icons/how_to_reg-black-18dp.svg"></img>
                    </button>
                    <input type="text" class="hidden" name="fencer_ids" id="fencer_ids" value="">
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
                                    <button type="button" class="clear_search_button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                                    <input type="text" name="f_nat" onkeyup="searchEngine(this)" id="inputs" placeholder="Search Country by Name" class="search cc">
                                    <div class="search_results">
                                    <?php include "../includes/nations.php"; ?>
                                    </div>
                                </div>
                                <label for="fencers_points" >POSITION</label>
                                <input type="number" placeholder="##" id="ranking_points" class="number_input extra_small" name="fencer_position">
                                <button type="submit" name="add_fencer" class="panel_submit">Save</button>
                            </form>
                        </div>
                <div id="page_content_panel_main">

                    <div class="wrapper table_row_wrapper">
                    <!--
                        <div id="no_something_panel">
                            <p>You have no referees set up!</p>
                        </div>
                    -->     
               <?php
               
               $query = "SELECT * FROM cptrs_$comp_id ORDER BY name";
               $query_do = mysqli_query($connection, $query);
               
               
               ?>
                        <div class="table_header">
                            <div class="table_header_text">NAME</div>
                            <div class="table_header_text">NATIONALITY</div>
                            <div class="table_header_text">STATUS</div>
                            <div class="big_status_header"></div>
                        </div>

                        <?php
                        
                        while($row = mysqli_fetch_assoc($query_do)){

                        $name = $row["name"];
                        $nat = $row["nationality"];
                        $stat = $row["reg"];
                        $id = $row["id"];
                        
                        ?>
                        
                        <div class="table_row" id="<?php echo $id ?>" onclick="selectRow(this)">
                            <div class="table_item"><?php echo $name ?></div>
                            <div class="table_item"><?php echo $nat ?></div>
                            <div class="table_item"><?php if($stat == 0){echo "Not registered";}else{echo "Registered";} ?></div>
                            <div class="big_status_item <?php if($stat == 0){echo "red";}else{echo "green";} ?>"></div> <!-- red or green style added to small_status item to inidcate status -->
                        </div>
                        <?php
                        }
                        ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/registration.js"></script>
</body>
</html>