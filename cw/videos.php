<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
<?php include "./controllers/VideoController.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Videos</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="videos">
    <?php include "cw_header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>Videos</h1>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>
                </form>
                <div id="videos_wrapper">
                    <?php
                        $videoController = new VideoController();
                        $videos = $videoController->getVideos();

                        foreach($videos as $video) {
                    ?>
                            <!-- latest video placeholder -->
                            <div class="video_wrapper" onclick="location.href='video.php?vid_id=<?php echo $video->id ?>'" loading="lazy">
                                <img src="http://img.youtube.com/vi/<?php echo $video->video_id ?>/sddefault.jpg" alt="<?php echo $video->title ?> thumbnail">
                                <div class="video_wrapper_info">
                                    <p><?php echo $video->title ?></p>
                                    <p><?php echo $video->comp_name ?></p>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                    <div class="video_wrapper ghost"></div>
                    <div class="video_wrapper ghost"></div>
                </div>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>