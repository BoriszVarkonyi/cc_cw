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
<body class="videos">    
<div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content" class="list">
                <div id="title_stripe">
                    <p class="stripe_title">Videos</p>
                </div>
                <form id="browsing_bar">
                    <div>
                        <button type="button" class="clear_search_button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                        <input type="text" name="" placeholder="Search by Title" class="search">
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
                            <div class="video_wrapper" onclick="location.href='video.php?vid_id=<?php echo $id ?>'">
                                <img src="http://img.youtube.com/vi/<?php echo $video_id ?>/sddefault.jpg" >
                                <div class="video_wrapper_info">
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
            </div>
            </div>
            <?php include "cw_footer.php"; ?>
        </div>
    </div>
<script src="../js/cw_main.js"></script>
</body>
</html>