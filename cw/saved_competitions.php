<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>

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
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>Saved competitions</h1>
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
                <table>
                    <thead>
                        <tr>
                            <th><p>COMPETITION'S NAME</p></th>
                            <th><p>STARTING AND ENDING DATE</p></th>
                            <th><p>STATUS</p></th>
                            <th class="square"></th>
                        </tr>
                    </thead>
                    <tbody class="alt">

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
                            <tr>
                                <td onclick="window.location.href='competition.php?comp_id=<?php echo $current_comp_id ?>'">
                                    <p><?php echo $comp_name ?></p>
                                </td>
                                <td onclick="window.location.href='competition.php?comp_id=<?php echo $current_comp_id ?>'">
                                    <p><?php echo $comp_start ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $comp_end ?></p>
                                </td>
                                <td onclick="window.location.href='competition.php?comp_id=<?php echo $current_comp_id ?>'">
                                    <p><?php echo statusConverter($comp_status) ?></p>
                                </td>
                                <td class="square">
                                    <button value="<?php echo $current_comp_id ?>" class="bookmark_button" onclick="favButton(this)">
                                        <img src="../assets/icons/bookmark_border_black.svg" alt="Save Competition">
                                    </button>
                                </td>
                            </tr>
                            <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4">
                                            <p>You have no Competitions bookmarked</p>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="4">
                                        <p>You have no Competitions bookmarked</p>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/bookmark_competition.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list.js"></script>
</body>
</html>