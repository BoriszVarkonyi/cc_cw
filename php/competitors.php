<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{Comp name}'s Competitiors</title>
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
                <p class="page_title">Competitors</p>
                <button class="stripe_button" type="button">
                    <p>Send message to Fencer</p>
                    <img src="../assets/icons/message-black-18dp.svg" />
                </button>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper table_row_wrapper w90">
                    <div class="table_header">
                        <div class="table_header_text small">POSITION</div>
                        <div class="table_header_text">NAME</div>
                        <div class="table_header_text">NATION / CLUB</div>
                        <div class="small_status_header"></div>
                        <div class="table_header_text">REGISTRATION</div>
                        <div class="small_status_header"></div>
                        <div class="table_header_text">WEAPON CONTROL</div>
                    </div>

                    <?php
                    
                    
                    $query = "SELECT * FROM cptrs_$comp_id ORDER BY rank";
                    $query_do = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($query_do)){

                        $pos = $row["rank"];
                        $name = $row["name"];
                        $nat = $row["nationality"];
                        $reg = $row["reg"];
                        $wc = $row["wc"];?>


                    <div class="table_row">
                        <div class="table_item"><?php echo $pos ?></div>
                        <div class="table_item"><?php echo $name ?></div>
                        <div class="table_item"><?php echo $nat ?></div>
                        <div class="small_status_item <?php
                        
                        if($reg == 0){

                            echo "red";
                        }else{

                            echo "green";
                        }
                        
                        
                        
                        ?>"></div>
                        <div class="table_item"><?php
                        
                        if($reg == 0){

                            echo "Not ready";
                        }else{

                            echo "Ready";
                        }
                        
                        
                        
                        ?></div>
                        <div class="small_status_item <?php
                        
                        if($wc == 0){

                            echo "red";
                        }else{

                            echo "green";
                        }
                        
                        
                        
                        ?>"></div>
                        <div class="table_item"><?php
                        
                        if($wc == 0){

                            echo "Not ready";
                        }else{

                            echo "Ready";
                        }
                        
                        
                        
                        ?></div>
                    </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
</html>