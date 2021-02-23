<!--<?php include "cw_comp_getdata.php"; ?>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rankings</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="rankings">
    <?php include "cw_header.php"; ?>
    <div id="main">
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">Rankings</p>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close-black-18dp.svg"></button>
                    </div>
                </form>
                <div class="table cw">
                    <div class="table_header">
                        <div class="table_header_text">RANKINGS NAME</div>
                        <div class="table_header_text">PLACEHOLDER</div>
                    </div>
                    <div class="table_row_wrapper alt">

                        <?php
                        //get comp_
                        $qry_get_rankings = "SELECT * FROM `ranking` WHERE `ass_comp_id` <> '0'";
                        $do_get_rankings = mysqli_query($connection, $qry_get_rankings);
                        echo mysqli_error($connection);
                        while ($row =  mysqli_fetch_assoc($do_get_rankings)) {

                            $ranking_name = $row['name'];
                            $ranking_id = $row['id'];
                            $ass_comp_id = $row['ass_comp_id'];
                            $ranking_password = $row['password'];

                            ?>
                            <div class="table_row" onclick="window.location.href='ranking.php?comp_id=<?php echo $ass_comp_id ?>'">
                                <div class="table_item"><p><?php echo $ranking_name ?></p></div>
                                <div class="table_item"><p><?php echo $ranking_id ?></p></div>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>