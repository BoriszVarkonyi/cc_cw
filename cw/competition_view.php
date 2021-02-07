<?php include "../includes/db.php"; ?>
<?php include "../includes/cw_fav_button_list.php" ?>
<?php include "../includes/functions.php"; ?>
<!DOCTYPE html>
<html lang="en" data-content-theme="vanilla">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CompetitionView</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body class="home">
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="slideshow">
                <p id="slideshow_title" title="Check Competitions">Check Competitions</p>
                <div id="sildes">
                    <div id="slide_nav">
                        <button class="slideButtons active" onclick="toggleButton(this)"></button>
                        <button class="slideButtons" onclick="toggleButton(this)"></button>
                        <button class="slideButtons" onclick="toggleButton(this)"></button>
                        <button class="slideButtons" onclick="toggleButton(this)"></button>
                    </div>
                    <!-- slide1 -->
                    <div class="slide bg_fencers"></div>

                    <!-- slide2 -->
                    <div class="slide bg_fencers"></div>

                    <!-- slide3 -->
                    <div class="slide bg_fencers"></div>

                    <!-- slide4 -->
                    <div class="slide bg_fencers"></div>
                </div>
            </div>
            <div id="content">
                <div class="column">
                    <p class="column_title">Ongoing Competitions</p>
                    <div class="table t_c_1">
                        <div class="table_row_wrapper">
                    <?php
                        //query comp_status = 3 (comps with ongoing comp_status orederd by comp_start)
                        $qry = "SELECT * FROM competitions WHERE comp_status = 3 ORDER BY comp_start DESC";
                        $qry_do = mysqli_query($connection, $qry);


                        //displays row in the table with parameters
                        while ($row = mysqli_fetch_assoc($qry_do)) {
                            $comp_name =  $row['comp_name'];
                            $comp_id = $row['comp_id'];

                            $star = getStar($comp_id);

                            //displays the compnames in a table with href button (live)
                            ?>
                            <div class="table_row" onclick="window.location.href='competition.php?comp_id=<?php echo $comp_id ?>'">
                                <!-- comp_name displayed -->
                                <div class="table_item">
                                    <p><?php echo $comp_name ?></p>
                                </div>
                                <!-- live button href -->
                                <div class="table_item live">
                                    <a href="">Live</a>
                                </div>
                                <form method="POST" class="big_status_item">
                                    <button name="submit_button" value="<?php echo $comp_id ?>" class="favourite_button">
                                        <img src="<?php echo $star ?>" >
                                    </button>
                                </form>
                            </div>

                            <?php
                        }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- latest videos (right) (placeholder)  -->
                <div class="column">
                    <p class="column_title">Latest Videos</p>



                        <?php
                            $qry_get_videos = "SELECT * FROM cw_videos ORDER BY Date_of_creation ASC LIMIT 5;";
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
                        <?php } ?>


                </div>
            </div>
            </div>
        <?php include "cw_footer.php"; ?>
    </div>
</body>
<script src="../js/cw_main.js"></script>
<script src="../js/cw_slideshow.js"></script>
<script src="../js/list.js"></script>
</html>