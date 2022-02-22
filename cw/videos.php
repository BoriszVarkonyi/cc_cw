<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "./controllers/VideoController.php"; ?>

<?php
    if(isset($_GET['q'])) {
        $q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
    }
?>

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
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>Videos</h1>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar" method="GET">
                    <div class="search_wrapper wide">
                        <input type="text" name="q" placeholder="Search by Title" class="search page alt" value="<?php if(isset($_GET['q'])) echo $q; ?>">
                        <button type="button" onclick=""><img src="../assets/icons/close_black.svg" alt="Close Search"></button>
                    </div>
                </form>
                <div id="videos_wrapper">
                    <?php
                        $videoController = new VideoController();
                        if(isset($_GET["q"]))
                            $videos = $videoController->getVideosSearch($q);
                        else
                            $videos = $videoController->getVideos();

                        include 'views/Videos.php';
                    ?>
                    <div class="video_wrapper ghost"></div>
                    <div class="video_wrapper ghost"></div>
                </div>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/main.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>