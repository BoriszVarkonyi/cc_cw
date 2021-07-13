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
    <title>Import Competitors from XML</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
<!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Import Competitors from XML</p>
                <div class="stripe_button_wrapper">
                    <a class="stripe_button bold" href="competitors_<?php echo $_GET["type"]?>.php?comp_id=<?php echo $comp_id ?>">
                        <p>Go back to Competitors</p>
                        <img src="../assets/icons/arrow_back_ios_black.svg"/>
                    </a>
                    <button class="stripe_button primary" type="submit" form="import_competitors_from_xml_form" id="import_button">
                        <p>Import</p>
                        <img src="../assets/icons/get_app_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div class="wrapper">
                    <div class="db_panel other">
                        <div class="db_panel_title_stripe">
                            <img src="../assets/icons/build_black.svg">
                            <p>Import Competitors</p>
                        </div>
                        <div class="db_panel_main">
                            <form method="POST" id="delete_logo">
                                <button id="delete_logo" class="panel_button">
                                    <img src="../assets/icons/delete_black.svg">
                                </button>
                            </form>
                            <form action="../uploads/uploadxml.php?comp_id=<?php echo $comp_id ?>&type=<?php echo $_GET["type"] ?>" method="POST" id="import_competitors_from_xml_form" enctype="multipart/form-data" class="invitation_file_wrapper">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <label for="fileToUpload">Upload XML File</label>
                                 <p id="file_text"></p>
                                <input type="text" name="type" class="hidden" value="competitors">
                            </form>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <p>ID</p>
                                </th>
                                <th>
                                    <p>FIRST NAME</p>
                                </th>
                                <th>
                                    <p>LAST NAME</p>
                                </th>
                                <th>
                                    <p>NATION</p>
                                </th>
                                <th>
                                    <p>CLUB</p>
                                </th>
                                <th>
                                    <p>RANK</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/controls.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/import_competitors.js"></script>
</body>
</html>