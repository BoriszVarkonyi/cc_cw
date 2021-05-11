<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saved Competitions</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="saved_competitions">
    <?php include "cw_header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">Saved competitions</p>
            </div>
            <div id="content_wrapper">
                <div id="page_info_wrapper">
                    <div class="help_icon">
                        <img src="../assets/icons/help_black.svg" alt="Page Information and Help Icon">
                    </div>
                    <div class="page_info">
                        <p>You can bookmark competitions by clicking the <strong>bookmark button</strong><span><img src="../assets/icons/bookmark_border_black.svg" alt="Bookmark Icon"></span>.</p>
                        <p>These are only stored in your browser and will be deleted after the removal of <a href="https://www.allaboutcookies.org/cookies/">cookies</a>.</p>
                    </div>
                </div>
                <div class="table cw middle">
                    <div class="table_header">
                        <div class="table_header_text"><p>COMPETITION'S NAME</p></div>
                        <div class="table_header_text"><p>STARTING AND ENDING DATE</p></div>
                        <div class="table_header_text"><p>STATUS</p></div>
                        <div class="big_status_header"></div>
                    </div>
                    <div class="table_row_wrapper alt">

                        <?php
                            if (isset($_COOKIE['bookmarks'])) {
                                $value = $_COOKIE['bookmarks'];
                                if ($value != "") {
                                    $comp_array  = explode(",", $value);

                                    foreach($comp_array as $current_comp_id) {
                                        //get comp_data
                                        $qry_comp_data = "SELECT `comp_name`,`comp_start`,`comp_end`,`comp_status` FROM `competitions` WHERE `comp_id` = '$current_comp_id'";
                                        $do_comp_data = mysqli_query($connection, $qry_comp_data);
                                        if ($row = mysqli_fetch_assoc($do_comp_data)) {
                                            $comp_name = $row['comp_name'];
                                            $comp_end = $row['comp_end'];
                                            $comp_start = $row['comp_start'];
                                            $comp_status = $row['comp_status'];
                                        } else {
                                            echo mysqli_error($connection);
                                        }

                            ?>
                            <!-- Ezten kell loopba tenni -->
                            <div class="table_row">
                                <div class="table_item" onclick="window.location.href='competition.php?comp_id=<?php echo $comp_id ?>'">
                                    <p><?php echo $comp_name ?></p>
                                </div>
                                <div class="table_item" onclick="window.location.href='competition.php?comp_id=<?php echo $comp_id ?>'">
                                    <p><?php echo $comp_start ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $comp_end ?></p>
                                </div>
                                <div class="table_item" onclick="window.location.href='competition.php?comp_id=<?php echo $comp_id ?>'">
                                    <p><?php echo statusConverter($comp_status) ?></p>
                                </div>
                                <div class="big_status_item">
                                    <button value="<?php echo $current_comp_id ?>" class="bookmark_button" onclick="favButton(this)">
                                        <img src="../assets/icons/bookmark_border_black.svg" alt="Save Competition">
                                    </button>
                                </div>
                            </div>
                            <?php
                                    }
                                } else {
                                    ?>
                                    <div class="table_row">
                                        <div class="table_item">
                                            <p>You have no Competitions bookmarked.</p>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="table_row">
                                    <div class="table_item">
                                        <p>You have no Competitions bookmarked.</p>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/cw_bookmark_competition.js"></script>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
</body>
</html>