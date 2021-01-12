<?php include "cw_header.php"; ?>
<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
<?php $statusofpage = 4; ?>
<?php 

    if (isset($_COOKIE['fav_comp'])) {
        $saved_comps = $_COOKIE["fav_comp"];
    } else {
        $saved_comps = 0;
    }
    

    $saved_comps = str_replace("%", ", ", $saved_comps);
    $saved_comps = substr_replace($saved_comps, "", 0, 1);
    $saved_comps .= "0";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saved Competitions</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="saved_competitions">
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content" class="list">
                <div id="title_stripe">
                    <p class="stripe_title">Saved competitions</p>
                </div>
                <div class="table cw middle">
                    <div class="table_header">
                        <div class="table_header_text"><p>COMPETITION'S NAME</p></div>
                        <div class="table_header_text"><p>STARTING AND ENDING DATE</p></div>
                        <div class="table_header_text"><p>HOSTING COUNTRY</p></div>
                        <div class="big_status_header"></div>
                    </div>
                    <div class="table_row_wrapper alt">
                        <?php 
                        $qry_get_data = "SELECT * FROM competitions WHERE comp_id IN ($saved_comps);";
                        $do_get_data =  mysqli_query($connection, $qry_get_data);
                        echo mysqli_error($connection);

                        while ($row = mysqli_fetch_assoc($do_get_data)) {
                            $comp_name = $row['comp_name'];
                            $comp_id_table = $row['comp_id'];
                            $comp_status = $row['comp_status'];
                            ?>
                            <!-- outputting the table -->    
                            <div class="table_row">
                                <div class="table_item">
                                    <p><?php echo $comp_name ?></p>
                                </div>
                                <div class="table_item">
                                    <p><?php echo statusConverter($comp_status) ?></p>
                                </div>
                                <div class="big_status_item">
                                    <button class="favourite_button">
                                        <img src="../assets/icons/star_border-black-18dp.svg" >
                                    </button>
                                </div>
                            </div>
                        <?php 
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "cw_footer.php"; ?>
        </div>
    </div>
<script src="../js/cw_main.js"></script>
</body>
</html>