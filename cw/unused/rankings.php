<!--<?php include "cw_comp_getdata.php"; ?>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rankings</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="rankings">
    <?php include "cw_header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>Rankings</h1>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>RANKINGS NAME</th>
                            <th>PLACEHOLDER</th>
                        </tr>
                    </thead>
                    <tbody class="alt">

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
                            <tr onclick="window.location.href='ranking.php?comp_id=<?php echo $ass_comp_id ?>'">
                                <td><p><?php echo $ranking_name ?></p></td>
                                <td><p><?php echo $ranking_id ?></p></td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>