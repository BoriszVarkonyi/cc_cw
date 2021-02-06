<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
$query = "SELECT *
FROM `information_schema`.`tables`
WHERE table_schema = 'ccdatabase'
    AND table_name = 'cptrs_$comp_id'
LIMIT 1;";
$query_do = mysqli_query($connection, $query);

if(mysqli_num_rows($query_do) == 0){

$query = "CREATE TABLE cptrs_$comp_id ( `id` VARCHAR(255) NOT NULL , `name` VARCHAR(255) NOT NULL , `nationality` VARCHAR(255) NOT NULL , `reg` INT NOT NULL , `wc` INT NOT NULL , `rank` INT NOT NULL , `comp_rank` INT NOT NULL, `temporary_rank` INT NOT NULL, `final_rank` INT NOT NULL, `ass_match` INT NOT NULL ) ENGINE = InnoDB;";
$query_do = mysqli_query($connection, $query);

}


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
                <input type="text" class="selected_list_item_input">
                <div class="stripe_button_wrapper">
                    <button class="stripe_button disabled" type="button">
                        <p>Message Fencer</p>
                        <img src="../assets/icons/message-black-18dp.svg"/>
                    </button>
                    <a class="stripe_button primary" href="import_competitors.php?comp_id=<?php echo $comp_id ?>">
                        <p>Import Competitors from XML</p>
                        <img src="../assets/icons/get_app-black-18dp.svg"/>
                    </a>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper table w90 first_column_centered">
                    <div class="table_header">
                        <div class="table_header_text">POSITION</div>
                        <div class="table_header_text">NAME</div>
                        <div class="table_header_text">NATION / CLUB</div>
                        <div class="table_header_text">REGISTRATION</div>
                        <div class="small_status_header"></div>
                        <div class="table_header_text">WEAPON CONTROL</div>
                        <div class="small_status_header"></div>
                    </div>
                    <div class="table_row_wrapper">
                        <?php
                        $query = "SELECT * FROM cptrs_$comp_id ORDER BY rank";
                        $query_do = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($query_do)){

                            $pos = $row["rank"];
                            $name = $row["name"];
                            $nat = $row["nationality"];
                            $reg = $row["reg"];
                            $wc = $row["wc"];?>

                            <div class="table_row" onclick="selectRow(this)" tabindex="0">
                                <div class="table_item"><p><?php echo $pos ?></p></div>
                                <div class="table_item"><p><?php echo $name ?></p></div>
                                <div class="table_item"><p><?php echo $nat ?></p></div>
                                <div class="table_item">
                                    <p>
                                    <?php

                                        if($reg == 0){

                                            echo "Not ready";
                                        }else{

                                            echo "Ready";
                                        }
                                    ?>
                                    </p>
                                </div>
                                <div class="small_status_item <?php
                                    if($reg == 0){

                                        echo "red";
                                    }else{

                                        echo "green";
                                    }
                                    ?>">
                                </div>
                                <div class="table_item"><?php
                                    if($wc == 0){

                                        echo "Not ready";
                                    }else{

                                        echo "Ready";
                                    }
                                    ?>
                                </div>
                                <div class="small_status_item <?php
                                    if($wc == 0){

                                        echo "red";
                                    }else{

                                        echo "green";
                                    }
                                    ?>">
                                </div>
                            </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/controls.js"></script>
</html>