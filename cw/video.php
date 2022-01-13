<?php include "db.php" ?>
<?php include "./controllers/VideoController.php" ?>
<?php
    $id = filter_input(INPUT_GET, 'vid_id', FILTER_SANITIZE_NUMBER_INT);

    $videoController = new VideoController();
    $video = $videoController->getVideoById($id);
    if(!$video) {
        header("Location: videos.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $video->comp_name ?>'s highlight video</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="videos">
    <?php include "static/header.php"; ?>
    <main role="main" class="full">
        <div id="content" class="full">
            <div id="title_stripe">
                <h1>
                    <button class="back_button" onclick="window.history.back();" aria-label="Go back to previous page">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </button>
                    Video From <?php echo $video->comp_name ?></p>
                </h1>
            </div>
            <div id="content_wrapper" class="centered">
                <div id="video">
                    <p id="no_livestream" class="hidden">There is no available livestream for this round.</p>
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $video->video_id ?>" title="<?php echo $video->comp_name ?>'s highlight video" frameborder="0" allowfullscreen></iframe>
                </div>
                <a href="https://www.youtube.com/watch?v=<?php echo $video->video_id ?>" class="open_on_yt_button">
                    <p>Open on Youtube</p>
                    <img src="../assets/icons/youtube_icon_black.svg" alt="Youtube Logo">
                </a>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="../js/cw_main.js"></script>
</body>
</html>