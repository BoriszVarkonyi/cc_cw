<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
<?php include "includes/sortfunction.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>
<?php include 'barcode/barcode.php'; ?>

<?php

$qry_get_fencers = "SELECT `data` FROM `competitors` WHERE `assoc_comp_id` = '$comp_id'";
$do_get_fencers = mysqli_query($connection, $qry_get_fencers);
if ($row = mysqli_fetch_assoc($do_get_fencers)) {
    //get string
    $string = $row['data'];
    //make json
    $fencers_json_table = json_decode($string);

    $objects = new ObjSorter($fencers_json_table, 'nation');

    $fencers_json_table = $objects->sorted;
} else {
    echo "Couldn't get competitiors: " . mysqli_error($connection);
}

if (isset($_GET['fencer_id'])) {
    $fencer_id = $_GET['fencer_id'];

    if (($id_tf = findObject($fencers_json_table, $fencer_id, "id")) !== false) {
        $obj = $fencers_json_table[$id_tf];
        $fencers_json_table = [];
        $fencers_json_table[] = $obj;
    } else {
        //echo "could not find fencer with id: $fencer_id";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Barcodes</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/print_style.min.css" media="print">
    <link rel="stylesheet" href="../css/print_paper_style.min.css">
    <link rel="stylesheet" href="../css/print_barcode_style.min.css">
</head>

<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Print Fencer Barcodes</p>
                <div class="stripe_button_wrapper">
                    <a class="stripe_button bold" shortcut="SHIFT+C" href="registration.php?comp_id=<?php echo $comp_id; ?>">
                        <p>Back to Registration</p>
                        <img src="../assets/icons/close_black.svg" />
                    </a>
                    <button class="stripe_button primary" onclick="printPage()" shortcut="SHIFT+P">
                        <p>Print</p>
                        <img src="../assets/icons/print_black.svg" />
                    </button>
                </div>
                <!--
                <div class="view_button_wrapper first">
                    <button onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out_black.svg" />
                    </button>
                    <button onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in_black.svg" />
                    </button>
                </div>
                 -->
            </div>
            <div id="page_content_panel_main" class="loose">

                <?php

                $counter = 0;
                //Counter for page switch
                //Page changes every at 65 fencers

                foreach ($fencers_json_table as $fencer) {

                    //Paper change
                    if ($counter % 65 == 0 || $counter == 0) {
                ?>
                        <div class="paper barcodes">
                            <div>
                            <?php
                        }
                            ?>

                            <div class="barcode_print">
                                <div>
                                    <p class="barcode_nat"><?php echo $fencer->nation; ?></p>
                                    <?php echo bar128($fencer->id); ?>
                                    <p><?php echo $fencer->id; ?></p>
                                    <p><?php echo $fencer->prenom . " " . $fencer->nom; ?></p>
                                </div>
                            </div>

                            <?php
                            $counter++;
                            //Paper change
                            if ($counter % 65 == 0) {
                            ?>
                            </div>
                        </div>

                <?php
                        }
                    }
                ?>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/search.js"></script>
    <script src="javascript/print.js"></script>
</body>

</html>