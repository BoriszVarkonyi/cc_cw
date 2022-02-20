<?php include "includes/headerburger.php"; ?>
<?php include "includes/db.php" ?>
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
    } else {
        echo "Couldn't get competitiors: " . mysqli_error($connection);
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
                    <button class="stripe_button bold" onclick="window.close()" shortcut="SHIFT+C">
                        <p>Close Page</p>
                        <img src="../assets/icons/close_black.svg" />
                    </button>
                    <button class="stripe_button primary" onclick="printPage()" shortcut="SHIFT+P">
                        <p>Print</p>
                        <img src="../assets/icons/print_black.svg" />
                    </button>
                </div>

                <div class="view_button_wrapper first">
                    <button onclick="zoomOut()" id="zoomOutButton">
                        <img src="../assets/icons/zoom_out_black.svg" />
                    </button>
                    <button onclick="zoomIn()" id="zoomInButton">
                        <img src="../assets/icons/zoom_in_black.svg" />
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main" class="loose">

                <div class="paper barcodes">
                    <div class="barcode_print">
                        <?php echo bar128("1"); ?>
                        <p>1</p>
                        <p>Nagyon de nagyon geci hosszú név xdxdxdxd</p>
                    </div>
                    <div class="barcode_print">
                        <?php echo bar128("22"); ?>
                        <p>22</p>
                        <p>Nagyon de nagyon geci hosszú név xdxdxdxd</p>
                    </div>
                    <div class="barcode_print">
                        <?php echo bar128("333"); ?>
                        <p>333</p>
                        <p>Nagyon de nagyon geci hosszú név xdxdxdxd</p>
                    </div>
                    <div class="barcode_print">
                        <?php echo bar128("4444"); ?>
                        <p>4444</p>
                        <p>Nagyon de nagyon geci hosszú név xdxdxdxd</p>
                    </div>
                    <div class="barcode_print">
                        <?php echo bar128("55555"); ?>
                        <p>55555</p>
                        <p>Nagyon de nagyon geci hosszú név xdxdxdxd</p>
                    </div>
                    <div class="barcode_print">
                        <?php echo bar128("666666"); ?>
                        <p>666666</p>
                        <p>Nagyon de nagyon geci hosszú név xdxdxdxd</p>
                    </div>
                    <div class="barcode_print">
                        <?php echo bar128("7777777"); ?>
                        <p>7777777</p>
                        <p>Nagyon de nagyon geci hosszú név xdxdxdxd</p>
                    </div>
                    <div class="barcode_print">
                        <?php echo bar128("88888888"); ?>
                        <p>88888888</p>
                        <p>Nagyon de nagyon geci hosszú név xdxdxdxd</p>
                    </div>
                    <div class="barcode_print">
                        <?php echo bar128("999999999"); ?>
                        <p>999999999</p>
                        <p>Nagyon de nagyon geci hosszú név xdxdxdxd</p>
                    </div>
                    <div class="barcode_print">
                        <?php echo bar128("0000000000"); ?>
                        <p>0000000000</p>
                        <p>Nagyon de nagyon geci hosszú név xdxdxdxd</p>
                    </div>

                </div>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/search.js"></script>
    <script src="javascript/print.js"></script>
</body>
</html>