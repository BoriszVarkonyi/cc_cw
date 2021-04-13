<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
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
                <p class="stripe_title">Videos</p>
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

                        $qry_get_videos = "SELECT * FROM cw_videos;";
                        $do_get_videos = mysqli_query($connection, $qry_get_videos);

                        while ($row = mysqli_fetch_assoc($do_get_videos)) {
                            $video_id = "asd";
                            $url = $row['URL'];
                            $comp_name = $row['comp_name'];
                            $id = $row['id'];
                            $title = $row['title'];
                            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
                            $video_id = $my_array_of_vars['v'];

                    ?>
                            <!-- latest video placeholder -->
                            <div class="video_wrapper" onclick="location.href='video.php?vid_id=<?php echo $id ?>'" loading="lazy">
                                <img src="http://img.youtube.com/vi/<?php echo $video_id ?>/sddefault.jpg" alt="<?php echo$title ?> thumbnail">
                                <div class="video_wrapper_info">
                                    <p><?php echo$title ?></p>
                                    <p><?php echo $comp_name ?></p>
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