<?php include "cw_comp_getdata.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s temporary ranking</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="competitions">
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content">
                <div id="title_stripe">
                    <p class="stripe_title">
                        <button type="button" class="back_button" onclick="window.history.back();" >
aria-label="Go back to previous page"                            <img src="../assets/icons/arrow_back_ios-black.svg">
                        </button>
                        Temporary Ranking of <?php echo $comp_name ?>
                    </p>
                </div>
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close-black.svg"></button>
                    </div>
                </form>
                <div id="competition_color_legend">
                    <button id="fencing_lengend" value="Registration Finished"></button>
                    <p>Still fencing</p>
                    <button id="eliminated_lengend" value="Ongoing Pools"></button>
                    <p>Eliminated</p>
                    <button id="passed_lengend" value="Ongoing Table"></button>
                    <p>Passed</p>
                </div>
                <div class="table cw">
                    <div class="table_header">
                        <div class="table_header_text">POSITION</div>
                        <div class="table_header_text">NAME</div>
                        <div class="table_header_text">NATION / CLUB</div>
                        <div class="small_status_header"></div>
                    </div>
                    <div class="table_row_wrapper alt">
                        <?php
                            //get competitors sorted by temp rank
                            $qry = "SELECT * FROM cptrs_$comp_id ORDER BY temporary_rank ASC";
                            $qry_do = mysqli_query($connection, $qry);
                            echo mysqli_error($connection);
                            while ($row = mysqli_fetch_assoc($qry_do)) {
                                $fencer_name = $row['name'];
                                $fencer_nat = $row['nationality'];
                                $fencer_id = $row['id'];
                                $fencer_temp_rank = $row['temporary_rank'];
                        ?>

                        <div class="table_row">
                            <div class="table_item">
                                    <p>
                                        <?php echo $fencer_temp_rank ?>
                                    </p>
                                </div>
                                <div class="table_item">
                                    <p>
                                        <?php echo $fencer_name ?>
                                    </p>
                                </div>
                                <div class="table_item">
                                    <p>
                                        <?php echo $fencer_nat ?>
                                    </p>
                                </div>
                                <div class="small_status_item red"></div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "cw_footer.php"; ?>
        </div>
    </div>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/competitions.js"></script>
    <script src="../js/cw_temporary_ranking.js"></script>
    <script src="../js/search.js"></script>
</html>