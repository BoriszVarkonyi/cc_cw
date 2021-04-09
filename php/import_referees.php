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
    <title>Import Referees from XML</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
<!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Import Referees from XML</p>
                <div class="stripe_button_wrapper">
                    <button class="stripe_button primary" type="submit" form="import_competitors_from_xml_form" id="import_button">
                        <p>Import</p>
                        <img src="../assets/icons/get_app-black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper">
                    <div class="db_panel other">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/build-black.svg">
                            <p>Import Competitors</p>
                        </div>
                        <div class="db_panel_main">
                            <form method="POST" id="delete_logo">
                                <button id="delete_logo" class="panel_button">
                                    <img src="../assets/icons/delete-black.svg">
                                </button>
                            </form>
                            <form action="../uploads/uploadxml.php?comp_id=<?php echo $comp_id ?>" method="POST" id="import_competitors_from_xml_form" enctype="multipart/form-data" class="invitation_file_wrapper">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <label for="fileToUpload">Upload XML File</label>
                                <p id="file_text">Fájl neve ide</p>
                                <input type="text" name="type" class="hidden" value="referees">
                            </form>
                        </div>
                    </div>
                    <div class="table">
                        <div class="table_header">
                            <div class="table_header_text"><p>ID</p></div>
                            <div class="table_header_text"><p>First name</p></div>
                            <div class="table_header_text"><p>Last name</p></div>
                            <div class="table_header_text"><p>Nation</p></div>
                            <div class="table_header_text"><p>Club</p></div>
                            <div class="table_header_text"><p>Categorie</p></div>
                        </div>
                        <div class="table_row_wrapper">
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/controls.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/import_referees.js"></script>
</body>
</html>