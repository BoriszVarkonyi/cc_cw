<?php include "includes/header.php"; ?>
<?php include "includes/db.php" ?>
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
    <title>Import Teams from XML</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
    <?php include "includes/navigation.php"; ?>
    <main>
        <div id="title_stripe">
            <p class="page_title">Import Teams from XML</p>
            <div class="stripe_button_wrapper">
                <a class="stripe_button bold" href="teams.php?comp_id=<?php echo $comp_id ?>">
                    <p>Go back to Teams</p>
                    <img src="../assets/icons/arrow_back_ios_black.svg"/>
                </a>
                <button class="stripe_button primary" type="submit" form="import_teams_from_xml_form" id="import_button">
                    <p>Import</p>
                    <img src="../assets/icons/get_app_black.svg"/>
                </button>
            </div>
        </div>
        <div id="page_content_panel_main">
            <div class="wrapper">
                <div class="db_panel other">
                    <div class="db_panel_header">
                        <img src="../assets/icons/build_black.svg">
                        <p>Import Teams</p>
                    </div>
                    <div class="db_panel_main">
                        <form method="POST" id="delete_logo">
                            <button id="delete_logo" class="panel_button" name="Close panel">
                                <img src="../assets/icons/delete_black.svg">
                            </button>
                        </form>
                        <form action="../uploads/uploadxml.php?comp_id=<?php echo $comp_id ?>&type=team" method="POST" id="import_teams_from_xml_form" enctype="multipart/form-data" class="invitation_file_wrapper">
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <label for="fileToUpload">Upload XML File</label>
                                <p id="file_text"></p>
                            <input type="text" name="type" class="hidden" value="teams">
                        </form>
                    </div>
                </div>
                <table class="full">
                    <thead>
                        <tr>
                            <th>
                                <p>g</p>
                            </th>
                            <th>
                                <p>r</p>
                            </th>
                            <th>
                                <p>g</p>
                            </th>
                            <th>
                                <p>r</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>g</p>
                            </td>
                            <td>
                                <p>g</p>
                            </td>
                            <td>
                                <p>g</p>
                            </td>
                            <td>
                                <p>g</p>
                            </td>
                            <td>
                                <p>g</p>
                            </td>
                            <td>
                                <p>g</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>g</p>
                            </td>
                            <td>
                                <p>g</p>
                            </td>
                            <td>
                                <p>g</p>
                            </td>
                            <td>
                                <p>g</p>
                            </td>
                            <td>
                                <p>g</p>
                            </td>
                            <td>
                                <p>g</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/controls.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/import_teams.js"></script>
</body>
</html>