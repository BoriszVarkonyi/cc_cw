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
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
</head>
<body class="blog">
    <?php include "cw_header.php"; ?>
    <div id="main">
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title"><?php echo $title ?></p>
            </div>
            <div id="content_wrapper">
                <div class="article_info">
                    <p><?php echo "By:" . $author ?></p>
                    <p><?php echo $date ?></p>
                </div>
                <!--<img src="<?php echo $pic ?>">-->
                <img class="bg_fencers">
                <p class="paragraph"><?php echo $body ?></p>
            </div>
        </div>
    </div>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
</body>
</html>