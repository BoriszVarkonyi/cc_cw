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

            $query = "UPDATE cptrs_$comp_id SET reg = 1 WHERE id = $idtoregin";
            $query_do = mysqli_query($connection, $query);

            header("Location: registration.php?comp_id=$comp_id");

            }

            if(isset($_POST["reg_out"])){

                $idtoregin = $_POST["fencer_ids"];
    
                $query = "UPDATE cptrs_$comp_id SET reg = 0 WHERE id = $idtoregin";
                $query_do = mysqli_query($connection, $query);
    
                header("Location: registration.php?comp_id=$comp_id");
    
                }

        ?>





                <div id="title_stripe">
                        <p class="page_title">Registration</p>

                        <button class="stripe_button bold" onclick="toggleAddFencerPanel()">
                            <p>Add Fencer</p>
                            <img src="../assets/icons/add-black-18dp.svg"></img>
                        </button>


                        <form method="POST" action="">

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
                            <form action="ranking.php?comp_id=<?php echo $comp_id ?>&rankid=<?php echo $ranking_id ?>" method="post" id="new_fencer" autocomplete="off" class="overlay_panel_form">
                                <label for="fencers_name" >NAME</label>
                                <input type="text" placeholder="Type the fencers's name" class="username_input" name="fencer_name">

                                <label for="fencers_nationality">NATIONALITY / CLUB</label>
                                <input type="search" name="fencers_nationality" class="username_input" placeholder="Type the fencers's nationality">

                                <label for="fencers_points" >POSITION</label>
                                <input type="number" placeholder="##" id="ranking_points" class="number_input extra_small" name="fencer_position">

                                <label for="fencers_dob" >DATE OF BIRTH</label>
                                <input type="date" name="fencer_dob">
                                <button type="submit" name="submit" class="panel_submit">Save</button>
                            </form>
                        </div>
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
<script src="../js/main.js"></script>
<script src="../js/registration.js"></script>
</body>
</html>