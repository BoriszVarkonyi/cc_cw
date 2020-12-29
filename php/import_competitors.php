<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import Competitiors from XML</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Import Competitiors from XML</p>
                <button class="stripe_button orange" type="submit" form="import_competitors_from_xml_form" id="import_button">
                    <p>Import</p>
                    <img src="../assets/icons/get_app-black-18dp.svg"/>
                </button>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper">
                    <div class="inv_panel">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/build-black-18dp.svg"  class="db_panel_stripe_icon">
                            <p>Import Competitors</p>
                        </div>
                        <div class="db_panel_main">
                            <form action="../includes/delete_logo.php?comp_id=<?php echo $comp_id ?>" method="POST" id="delete_logo">
                                <button id="delete_logo" class="panel_button">
                                    <img src="../assets/icons/delete-black-18dp.svg" >
                                </button>
                            </form>
                            <form action="../uploads/uploads.php?comp_id=<?php echo $comp_id ?>" method="POST" id="import_competitors_from_xml_form" enctype="multipart/form-data" class="invitation_file_wrapper">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <label for="fileToUpload">Upload XML File</label>
                                <p id="fileText">Fájl neve ide</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../js/main.js"></script>
<script src="../js/controls.js"></script>
<script src="../js/import_competitors.js"></script>
</html>