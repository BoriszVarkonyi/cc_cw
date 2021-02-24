<?php include '../includes/db.php' ?>
<?php include '../includes/sortfunction.php' ?>
<?php

$comp_id = $_GET["comp_id"];

$qry_check_row = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
$do_check_row = mysqli_query($connection, $qry_check_row);
if ($row = mysqli_fetch_assoc($do_check_row)) {
    $json_string = $row['data'];
    $json_table = json_decode($json_string);
} else {
    echo mysqli_error($connection);
}


//KICSI SORTOLÓ FUNKCIÓKA//KICSI SORTOLÓ FUNKCIÓKA//KICSI SORTOLÓ FUNKCIÓKA//KICSI SORTOLÓ FUNKCIÓKA

$objects = new ObjSorter($json_table,'classement');
//if ($objects->sorted)
//{
$objects_array  = $objects->sorted;

echo count($objects_array) . " VÍVÓ";

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
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
</head>
<body>
    <?php include "../includes/headerburger.php"; ?>
    <!-- header -->
        <div id="flexbox_container">
            <?php include "../includes/navbar.php"; ?>
            <!-- navbar -->
        <div class="page_content_flex">
            <form id="title_stripe" method="POST" action="">
                <p class="page_title">Temporary Ranking</p>
                <input type="text" class="hidden selected_list_item_input" name="fencer_ids" id="fencer_ids" value="">
            </form>
            <div id="page_content_panel_main">
                <div class="table wrapper first_column_centered">
                <div class="table_header">
                    <div class="table_header_text">TEMPORARY RANK</div>
                    <button class="resizer" onmousedown="mouseDown(this)" onmouseup="mouseUp(this)"></button>
                    <div class="table_header_text">NAME</div>
                    <button class="resizer" onmousedown="mouseDown(this)" onmouseup="mouseUp(this)"></button>
                    <div class="table_header_text">NATION / CLUB</div>
                </div>
                        <div class="table_row_wrapper">
                        <?php

                        foreach ($objects_array as $key => $value) {

                        ?>

                        <div class="table_row" id="<?php echo $value->temp_rank ?>" onclick="selectRow(this)" tabindex="0">
                            <div class="table_item"><p><?php echo $value->temp_rank ?></p></div>
                            <div class="table_item"><p><?php echo $value->prenom . " " . $value->nom ?></p></div>
                            <div class="table_item"><p><?php echo $value->nation ?></p></div>
                        </div>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/registration.js"></script>
    <script src="../js/controls.js"></script>
</body>
</html>