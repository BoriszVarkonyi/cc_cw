<?php include '../includes/db.php' ?>
<?php include '../includes/sortfunction.php' ?>
<?php

$comp_id = $_GET["comp_id"];

$qry_check_row = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
$do_check_row = mysqli_query($connection, $qry_check_row);
if ($row = mysqli_fetch_assoc($do_check_row)) {
    $json_string = $row['data'];
    $json_table = json_decode($json_string);
    $objects = new ObjSorter($json_table, 'temp_rank');

    $objects_array  = $objects->sorted;
} else {
    $objects_array = [];
    echo mysqli_error($connection);
}


//KICSI SORTOLÓ FUNKCIÓKA//KICSI SORTOLÓ FUNKCIÓKA//KICSI SORTOLÓ FUNKCIÓKA//KICSI SORTOLÓ FUNKCIÓKA



//echo count($objects_array) . " VÍVÓ";

//CHECK//CHECK//CHECK//CHECK//CHECK//CHECK

//foreach ($objects_array as $key=>$object) { print_r($object); echo "<br />"; }
//CHECK//CHECK//CHECK//CHECK//CHECK//CHECK
//}

//KICSI SORTOLÓ FUNKCIÓKA//KICSI SORTOLÓ FUNKCIÓKA//KICSI SORTOLÓ FUNKCIÓKA//KICSI SORTOLÓ FUNKCIÓKA

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Temporary Ranking</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_list_style.min.css" media="print">
</head>
<body>
    <?php include "../includes/headerburger.php"; ?>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <form id="title_stripe" method="POST" action="">
                <p class="page_title">Temporary Ranking</p>
                <input type="text" class="hidden selected_list_item_input" name="fencer_ids" id="fencer_ids" value="">
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" type="button" onclick="window.print()">
                        <p>Print Temporary Ranking</p>
                        <img src="../assets/icons/print_black.svg"/>
                    </button>
                </div>
            </form>
            <div id="page_content_panel_main">
                <table class="wrapper">
                    <thead>
                        <tr>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Temporary Position" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <div class="table_buttons_wrapper">
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>TEMPORARY RANK</p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </div>
                            </th>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Name" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <div class="table_buttons_wrapper">
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>NAME</p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </div>
                            </th>
                            <th>
                                <div class="search_panel">
                                    <div class="search_wrapper">
                                        <input type="text" onkeyup="searchInLists()" placeholder="Search by Nationality" class="search page">
                                        <button type="button" onclick="closeSearch(this)"><img src="../assets/icons/close_black.svg"></button>
                                    </div>
                                </div>
                                <div class="table_buttons_wrapper">
                                    <button type="button" onclick="sortButton(this)">
                                        <img src="../assets/icons/switch_full_black.svg">
                                    </button>
                                    <p>NATION / CLUB</p>
                                    <button type="button" onclick="searchButton(this)">
                                        <img src="../assets/icons/search_black.svg">
                                    </button>
                                </div>
                            </th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php

                    if (isset($objects_array[0])) {
                        foreach ($objects_array as $key => $value) {

                        ?>

                        <tr id="<?php echo $value->temp_rank ?>">
                            <td><p><?php echo $value->temp_rank ?></p></td>
                            <td><p><?php echo $value->prenom . " " . $value->nom ?></p></td>
                            <td><p><?php echo $value->nation ?></p></td>
                        </tr>
                        <?php
                        }
                    } else {
                        ?><p>No competitors set up yet!</p> <?php
                    }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/list_2.js"></script>
    <script src="../js/list_search_2.js"></script>
</body>
</html>