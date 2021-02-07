<?php include "cw_comp_getdata.php"; ?>
<?php
    $WHERE_CLAUSE = "";

    if (isset($_POST['submit_search'])) {

        $WHERE_CLAUSE = "WHERE";
        $year = $_POST['year'];
        $name = $_POST['name'];


        if ($name != "") {
            $WHERE_CLAUSE .= " `name` LIKE '%$name%' AND";
        }
        if ($year != "") {
            $WHERE_CLAUSE .= " $year = YEAR(`comp_start`) AND";
        }

        if ($WHERE_CLAUSE == "WHERE") {
            $WHERE_CLAUSE = "";
        } else {
            $WHERE_CLAUSE = substr($WHERE_CLAUSE, 0, -3);
        }
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s competitors</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="competitions">
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content">
                <div id="title_stripe">
                    <p class="stripe_title">
                        <button type="button" class="back_button" onclick="window.history.back();">
                            <img src="../assets/icons/arrow_back_ios-black-18dp.svg">
                        </button>
                        Competitors of <?php echo $comp_name ?>
                    </p>
                </div>
                <form method="POST" id="browsing_bar">
                    <input name="" type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
                    <div>
                        <button type="button" class="clear_search_button"><img src="../assets/icons/close-black-18dp.svg"></button>
                        <input type="text" name="name" placeholder="Search by Name" class="search">
                    </div>

                    <div class="select_input dense">
                        <input type="number" name="year" placeholder="-Year-Of-Birth-" onkeyup="selectSystemWithSearch(this)">
                        <div id="year_select_dropdown">
                            <?php
                                for ($i = +3; $i <= 100; $i++) {

                                    $year = date("Y") - $i;

                                    ?><button type="button" onclick="selectSystem(this)"><?php echo $year ?></button><?php
                                }
                            ?>
                        </div>
                    </div>
                    <input name="submit_search" type="submit" value="Search">
                </form>

                <div class="table cw">

                    <?php
                        $qry = "SELECT * FROM `cptrs_$comp_id` " . $WHERE_CLAUSE . " ORDER BY `rank` ASC";
                        $do = mysqli_query($connection, $qry);
                        if ($do == FALSE || mysqli_num_rows($do) == 0) {
                            ?>
                                <p>You have no competitors set up or the search criteria is too narrow!</p>
                            <?php
                        } else {
                        ?>
                            <div class="table_header">
                                <div class="table_header_text"><p>POSITION</p></div>
                                <div class="table_header_text"><p>NAME</p></div>
                                <div class="table_header_text"><p>NATION / CLUB</p></div>
                            </div>
                            <div class="table_row_wrapper alt">
                        <?php
                            while ($row = mysqli_fetch_assoc($do)) {

                                $id = $row['id'];
                                $pos = $row['rank'];
                                $name = $row['name'];
                                $nat = $row['nationality'];
                        ?>

                                <div class="table_row">
                                    <div class="table_item bold">
                                        <p><?php echo $pos ?></p>
                                    </div>
                                    <div class="table_item">
                                        <p><?php echo $name ?></p>
                                    </div>
                                    <div class="table_item">
                                        <p><?php echo $nat ?></p>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                    ?>
                </div>
                </div>
                </div>
            <?php include "cw_footer.php"; ?>
        </div>
    </div>
<script src="../js/cw_main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/competitions.js"></script>
</body>
</html>