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
    <title><?php echo $comp_name ?>'s highlight video</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="videos">
    <?php include "cw_header.php"; ?>
    <main role="main" class="full">
        <div id="content" class="full">
            <div id="title_stripe">
                <p class="stripe_title">
                    <button type="button" class="back_button" onclick="window.history.back();" aria-label="Go back to previous page">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </button>
                    Video From <?php echo $comp_name ?></p>
                </p>
            </div>
            <div id="content_wrapper" class="centered">
                <div id="video">
                    <p id="no_livestream" class="hidden">There is no available livestream for this round.</p>
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $video_id ?>" title="<?php echo $comp_name ?>'s highlight video" frameborder="0" allowfullscreen></iframe>
                </div>
                <a href="https://www.youtube.com/watch?v=<?php echo $video_id ?>" class="open_on_yt_button">
                    <p>Open on Youtube</p>
                    <img src="../assets/icons/youtube_icon-white.svg" alt="Youtube Logo">
                </a>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
</body>
</html>