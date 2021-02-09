<?php include "../includes/db.php" ?>
<?php
    $id = $_GET['vid_id'];

    $get_video_data = "SELECT * FROM cw_videos WHERE id = '$id'";
    $do_get_video_data = mysqli_query($connection, $get_video_data);

    if ($row = mysqli_fetch_assoc($do_get_video_data)) {
        $title = $row['title'];
        $comp_name = $row['comp_name'];
        $url = $row['URL'];
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        $video_id = $my_array_of_vars['v'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $comp_name ?>'s final results</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="videos">
    <?php include "cw_header.php"; ?>
    <div id="main">
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">
                    <button type="button" class="back_button" onclick="window.history.back();">
                        <img src="../assets/icons/arrow_back_ios-black-18dp.svg">
                    </button>
                    Video From <?php echo $comp_name ?></p>
                </p>
            </div>
            <div id="content_wrapper">
                <div id="round_livestream_wrapper">
                    <p id="no_livestream" class="hidden">There is no available livestream for this round.</p>
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $video_id ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
</body>
</html>