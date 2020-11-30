<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php" ?>
<?php
    $id = $_GET['id'];

    $qry_get_data_by_id = "SELECT * FROM `cw_articles` WHERE id = '$id'";
    $do_get_data_by_id = mysqli_query($connection, $qry_get_data_by_id);

    if ($row = mysqli_fetch_assoc($do_get_data_by_id)) {
        $title = $row['title'];
        $author = $row['author'];
        $body = $row['body'];
        $date = $row['date'];
        $pic = "../article_pics/" . $id . ".png";
    }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="cw_main_full">
        <div class="cw_panel_title_wrapper">
            <p><?php echo $title ?></p>
        </div>

        <div class="cw_table_wrapper">

            <div id="article_wrapper">
                <p class="h1">Introduction</p>
                <p class="paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p class="paragraph"> <img src="<?php echo $pic ?>" > <p><?php echo "By:" . $author ?></p>
                <p><?php echo $date ?></p>
            </div>
            
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
</html>