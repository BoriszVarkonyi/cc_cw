<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
<?php include "./controllers/ArticleController.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CompetitionView</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
    <link rel="stylesheet" href="../css/cw_homepage_style.min.css">
    <meta name="description" content="Check and Follow Fencing Competitions around the world with CompetitionView">
</head>
<body class="home">
    <?php include "cw_header.php"; ?>
    <main>
        <div id="slideshow">
            <div id="slideshow_content">
                <!-- Beta fos -->
                <p id="slideshow_title">CHECK COMPETITIONS</p>
            </div>
            <button class="slideshow_navigation_button left" aria-label="Slideshow go left" onclick="slideToLeft()">
                <img src="../assets/icons/chevron_left_black.svg" alt="Slideshow go left">
            </button>
            <button class="slideshow_navigation_button right" aria-label="Slideshow go right" onclick="slideToRight()">
                <img src="../assets/icons/chevron_right_black.svg" alt="Slideshow go right">
            </button>
            <div id="slides">
                <img src="../article_pics/kovi1.jpg" alt="slide_1" class="slide">
                <img src="../article_pics/borisz1.jpg" alt="slide_2" class="slide hidden">
                <img src="../article_pics/atylla1.jpg" alt="slide_3" class="slide hidden">
                <img src="../assets/img/fencers_bg_v.svg" alt="slide_4" class="slide hidden">
            </div>
            <div id="shadow"></div>
            <div id="slide_indicator">
                <button onclick="jumpToSlide(1)" aria-label="Jump to Slide 1" class="current"></button>
                <button onclick="jumpToSlide(2)" aria-label="Jump to Slide 2"></button>
                <button onclick="jumpToSlide(3)" aria-label="Jump to Slide 3"></button>
                <button onclick="jumpToSlide(4)" aria-label="Jump to Slide 4"></button>
            </div>
        </div>
        <div id="content">
            <div id="content_wrapper" class="columns">
                <div class="column">
                    <p class="column_title">Ongoing Competitions</p>
                    <table class="cw">
                        <thead>
                            <tr>
                                <th><p>NAME</p></th>
                                <th></th>
                                <th class="square"></th>
                            </tr>
                        </thead>
                        <tbody class="alt">
                        <?php
                            //query comp_status = 3 (comps with ongoing comp_status orederd by comp_start)
                            $qry = "SELECT * FROM competitions WHERE comp_status = 3 ORDER BY comp_start DESC";
                            $qry_do = mysqli_query($connection, $qry);
                            $empty = true;
                            //displays row in the table with parameters
                            while ($row = mysqli_fetch_assoc($qry_do)) {
                                $comp_name =  $row['comp_name'];
                                $comp_id = $row['comp_id'];
                                $empty = false;
                                //displays the compnames in a table with href button (live)
                                ?>
                                <tr>
                                    <!-- comp_name displayed -->
                                    <td onclick="window.location.href='competition.php?comp_id=<?php echo $comp_id ?>'">
                                        <p><?php echo $comp_name ?></p>
                                    </td>
                                    <!-- live button href -->
                                    <td>
                                        <a href="competition.php?comp_id=<?php echo $comp_id ?>">Live</a>
                                    </td>
                                    <td class="square">
                                        <button value="<?php echo $comp_id ?>" class="bookmark_button" onclick="favButton(this)">
                                            <img src="../assets/icons/bookmark_border_black.svg" alt="Save Competition">
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                                if ($empty) {
                            ?>

                            <!-- eztat else ágra -->
                            <tr>
                                <td colspan="3">
                                    <p>There are no ongoing competitions</p>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- latest videos (right) (placeholder)  -->
                <div class="column">
                    <p class="column_title">Latest Videos</p>
                    <?php
                        $qry_get_videos = "SELECT * FROM `cw_videos` ORDER BY Date_of_creation ASC LIMIT 5;";
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
                                <img src="http://img.youtube.com/vi/<?php echo $video_id ?>/sddefault.jpg" alt="<?php echo$title ?> thumbnail">
                                <div class="video_wrapper_info">
                                    <p><?php echo$title ?></p>
                                    <p><?php echo $comp_name ?></p>
                                </div>
                            </div>
                    <?php } ?>
                </div>
                <div class="column">
                    <p class="column_title">Latest Blog Posts</p>
                    <?php

                        $articleController = new ArticleController();
                        $articles = $articleController->getArticles(5);

                        foreach($articles as $article) {
                    ?>
                    <div class="blog_article" onclick="location.href='article.php?id=<?php echo $article->id ?>'">
                        <?php
                            if(file_exists($article->pic)) {
                        ?>
                            <img src="<?php echo $article->pic ?>" alt="Artice image">
                        <?php } ?>
                        <p class="article_title"><?php echo $article->title ?></p>
                        <p class="article_brief"><?php echo $article->body ?></p>
                        <div class="article_info">
                            <p>POSTED: <?php echo $article->date ?></p>
                            <p>BY: <?php echo $article->author ?></p>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/cw_main.js"></script>
    <script src="../js/cw_slideshow.js"></script>
    <script src="../js/list.js"></script>
</body>
</html>