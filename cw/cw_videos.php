<?php include "cw_header.php"; ?>
<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Videos</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>    
    <div id="cw_main_narrow">
        <p class="cw_panel_title">Videos</p>
        <div id="browsing_bar">
            <input type="submit" value="Search">
        </div>
        <div id="videos_wrapper">
            <div id="latest_videos_panel_full">
                <p class="cw_panel_subtitle">Latest Videos</p>
                

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
                        <div class="video_wrapper" onclick="location.href='cw_video.php?vid_id=<?php echo $id ?>'">
                            <img src="http://img.youtube.com/vi/<?php echo $video_id ?>/sddefault.jpg" >
                            <div>
                                <p><?php echo$title ?></p>
                                <p><?php echo $comp_name ?></p>
                            </div>
                        </div>

                <?php 
                    }
                ?>



            </div>
        </div>
    </div>
<?php include "cw_footer.php"; ?>
</body>
<script src="../js/cw_main.js"></script>
</html>