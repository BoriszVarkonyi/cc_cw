<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 

$poolnum = $_GET["poolid"];

if(isset($_POST["savepool"])){

print_r($_POST);

$get_matches_query = "SELECT * FROM pool_matches_$comp_id WHERE p_in = $poolnum ORDER BY oip ASC";
$get_matches_query_do = mysqli_query($connection, $get_matches_query);

while($row = mysqli_fetch_assoc($get_matches_query_do)){

$oip = $row["oip"];

$score1 = $_POST[$oip . "_1"];
$score2 = $_POST[$oip . "_2"];

if($score1 != NULL && $score2 != NULL){

    $update_query = "UPDATE pool_matches_$comp_id SET f1_sc = $score1, f2_sc = $score2 WHERE p_in = $poolnum AND oip = $oip";
    $update_query_do = mysqli_query($connection, $update_query);

}

}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pool No. <?php echo $poolnum ?> 's results</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Pool No. <?php echo $poolnum ?> 's results</p>
                <input type="text" name="" id="" class="selected_list_item_input">
                <div class="stripe_button_wrapper">
                    <button class="stripe_button disabled" type="button">
                        <p>Message Fencer</p>
                        <img src="../assets/icons/message-black-18dp.svg"/>
                    </button>

                    <button class="stripe_button red disabled" type="button" onclick="disqualifyToggle()">
                        <p>Disqualify</p>
                        <img src="../assets/icons/highlight_off-black-18dp.svg"/>
                    </button>

                    <button class="stripe_button orange" type="submit">
                        <p>Save Pool</p>
                        <img src="../assets/icons/save-black-18dp.svg"/>
                    </button>
                </div>
                <div id="disqualify_panel" class="overlay_panel hidden">
                    <p class="panel_title">Disqualify {Fencer's name}</p>
                    <button class="panel_button" onclick="disqualifyToggle()">
                        <img src="../assets/icons/close-black-18dp.svg" >
                    </button>
                    <form action="" method="post"  autocomplete="off" class="overlay_panel_form">
                        <label for="ref_type" >REASON OF DISQUALIFICATION</label>
                        <div class="option_container">
                            <input type="radio" name="ref_type" id="medical" value=""/>
                            <label for="medical">Medical</label>

                            <input type="radio" name="ref_type" id="surrender" value=""/>
                            <label for="surrender">Surrender</label>

                            <input type="radio" name="ref_type" id="exclusion" value=""/>
                            <label for="exclusion">Exclusion</label>
                        </div>

                        <button type="submit" name="submit" class="submit_button" value="Disqualify">Disqualify</button>
                    </form>
                </div>

            </div>

            <div id="page_content_panel_main">
                <div class="wrapper full" id="pool_results">
                    <div>


                    <?php
                    
                    $inside_query = "SELECT * FROM pools_$comp_id WHERE pool_number = $poolnum";
                        $inside_query_do = mysqli_query($connection,$inside_query);

                        if($row = mysqli_fetch_assoc($inside_query_do)){

                            $pool_f_in = $row["pool_of"];
                            $f[0] = $row['f1'];
                            $f[1] = $row['f2'];
                            $f[2] = $row['f3'];
                            $f[3] = $row['f4'];
                            $f[4] = $row['f5'];
                            $f[5] = $row['f6'];
                            $f[6] = $row['f7'];
                            $ref = $row["ref"];
                            $ref_2 = $row["ref2"];
                            $piste = $row["piste"];
                            $time = $row["time"];


                            $get_ref_name = "SELECT * FROM ref_$comp_id WHERE id = '$ref'";
                            $get_ref_name_do = mysqli_query($connection, $get_ref_name);

                            if($refrow = mysqli_fetch_assoc($get_ref_name_do)){

                                $refname = $refrow["full_name"];
                                $refnat = $refrow["nat"];

                            }

                            $get_ref_name = "SELECT * FROM ref_$comp_id WHERE id = '$ref_2'";
                            $get_ref_name_do = mysqli_query($connection, $get_ref_name);

                            $ref2name = "";
                            $ref2nat = "";

                            if($refrow = mysqli_fetch_assoc($get_ref_name_do)){

                                $ref2name = $refrow["full_name"];
                                $ref2nat = $refrow["nat"];

                            }

                        }?>
                    <div>
                        <div class="entry" >
                            <div class="table_row start">
                                <div class="table_item bold">No. <?php echo $poolnum ?></div>
                                <div class="table_item">Piste <?php echo $piste ?></div>
                                <div class="table_item">Ref: <?php if (isset($refname)) {
                                        
                                        echo $refname;
                                        echo "(" . $refnat . ")"; 
                                    } else {
                                        echo "No ref assigned!";
                                    } ?></div>


                                <div class="table_item"><?php echo $time ?></div>
                            </div>
                            <div class="entry_panel">
                                <div class="pool_table_wrapper table">
                                    <div class="table_header">
                                        <div class="table_header_text">
                                            Fencers name
                                        </div>
                                        <div class="table_header_text square">
                                            No.
                                        </div>
                                        <?php 
                                        for ($k=0; $k < $pool_f_in; $k++) { ?>
                                            <div class="table_header_text square">
                                            <?php echo $k +1; ?>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        
                                    </div>
                                    <div class="table_row_wrapper">
                                    <?php
                                    for ($n=0; $n < $pool_f_in; $n++) { 
                                            $fx = $f[$n];
                                            $get_fencer_data = "SELECT * FROM cptrs_$comp_id WHERE id = '$fx'";
                                            $do_get_fencer_data = mysqli_query($connection, $get_fencer_data);

                                            if ($row = mysqli_fetch_assoc($do_get_fencer_data)) {
                                                $fencer_name = $row['name'];
                                            }?>
                                            

                                    <div class="table_row">
                                        <div class="table_item"><?php echo $fencer_name ?></div>
                                        <div class="table_item square row_title"><?php echo $n+1 ?></div>
                                        <?php
                                        $filled = "";
                                        for ($l=0; $l < $pool_f_in; $l++) { 
                                            
                                        if($l == $n){

                                        $filled = "filled";

                                        }?>
                                        
                                        <div class="table_item square <?php echo $filled ?>">
                                    
                                        <?php
                                        $front = 0;
                                        $back = 0;
                                            if($l > $n){
                                        
                                                $front = $n+1;
                                                $back = $l+1;

                                            }else{

                                                $front = $l +1 ;
                                                $back = $n+1;

                                            }
                                        if($l != $n){
                                            $scorenow = 0;
                                            $m_id = $front . "-" . $back;

                                            if($l > $n){
                                                $query_get_scores = "SELECT * FROM pool_matches_$comp_id WHERE m_id = '$m_id' AND p_in = $poolnum";
                                                $query_get_scores_do = mysqli_query($connection, $query_get_scores);

                                                while($row4 = mysqli_fetch_assoc($query_get_scores_do)){

                                                    $scorenow = $row4["f1_sc"];
                                                    
                                                }
                                                echo $scorenow;

                                            }
                                            elseif($n > $l){
                                                $query_get_scores = "SELECT * FROM pool_matches_$comp_id WHERE m_id = '$m_id' AND p_in = $poolnum";
                                                $query_get_scores_do = mysqli_query($connection, $query_get_scores);

                                                while($row4 = mysqli_fetch_assoc($query_get_scores_do)){

                                                    $scorenow = $row4["f2_sc"];
                                                    
                                                }
                                                echo $scorenow;
                                            }

                                            }

                                        ?>
                                        
                                        </div>
                                        
                                        <?php
                                        $filled = "";
                                        }

                                        ?>
                                    </div>
                                    <?php
                                        }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>







                    <div id="pool_matches">

                        <?php
                        
                        $get_matches_query = "SELECT * FROM pool_matches_$comp_id WHERE p_in = $poolnum ORDER BY oip ASC";
                        $get_matches_query_do = mysqli_query($connection, $get_matches_query);

                        while($row = mysqli_fetch_assoc($get_matches_query_do)){

                        $f1_id = $row["f1_id"];
                        $f2_id = $row["f2_id"];
                        $f1_sc = $row["f1_sc"];
                        $f2_sc = $row["f2_sc"];
                        $oip = $row["oip"];

                        
                        $get_fencer_names = "SELECT * FROM cptrs_$comp_id WHERE id = '$f1_id'";
                        $get_fencer_names_do = mysqli_query($connection, $get_fencer_names);

                        $get_fencer_names2 = "SELECT * FROM cptrs_$comp_id WHERE id = '$f2_id'";
                        $get_fencer_names_do2 = mysqli_query($connection, $get_fencer_names2);
                        


                        if($row2 = mysqli_fetch_assoc($get_fencer_names_do)){

                        $f1_n = $row2["name"];


                        }
                        if($row3 = mysqli_fetch_assoc($get_fencer_names_do2)){

                            $f2_n = $row3["name"];
    
    
                            }

                        
                        ?>


                        <div class="match <?php echo $szin = ($f1_sc == NULL ? "red" : "green") ?>">
                            <div class="match_number">
                                <p><?php echo $oip ?></p>
                            </div>
                            <div>
                                <p><?php echo $f1_n ?></p>
                                <input type="number" form="savepool" placeholder="#" name="<?php echo $oip ?>_1" id="" class="number_input" placeholder="<?php echo $f1_sc ?>">
                            </div>
                            <div class="vs">
                                <p>VS.</p>
                            </div>
                            <div>
                                <input type="number" form="savepool" placeholder="#" name="<?php echo $oip ?>_2" id="" class="number_input" placeholder="<?php echo $f2_sc ?>">
                                <p><?php echo $f2_n ?></p>
                            </div>
                        </div>


                        <?php
                        
                    }

                        ?>


                    </div>
                </div>
            </div>
        </div>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
</body>
</html>