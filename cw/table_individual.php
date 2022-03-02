<?php include "includes/get_comp_data.php"; ?>
<?php

$qry_check_existance = "SELECT * FROM tables WHERE ass_comp_id = $comp_id";
$qry_check_existance_do = mysqli_query($connection, $qry_check_existance);

echo $existance = mysqli_num_rows($qry_check_existance_do);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s table</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/dv_mainstyle.min.css">
    <link rel="stylesheet" href="../css/table_style.min.css">
</head>
<body class="competitions">
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>
                    <a class="back_button" href="competition.php?comp_id=<?php echo $comp_id ?>" aria-label="Go back to competition's page">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </a>
                    Table of <?php echo $comp_name ?>
                </h1>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/main.js"></script>
    <script src="javascript/table.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>