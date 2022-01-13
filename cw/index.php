<?php include "db.php"; ?>
<?php include "../includes/functions.php"; ?>
<?php include "./controllers/ArticleController.php" ?>
<?php include "./controllers/VideoController.php" ?>
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
    <?php include "static/header.php"; ?>
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
                <img src="../article_pics/kris1.jpg" alt="slide_4" class="slide hidden">
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
                    <table>
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
                        $videoController = new VideoController();
                        $videos = $videoController->getVideos(5);

                        include 'views/Videos.php';
                    ?>
                </div>
                <div class="column">
                    <p class="column_title">Latest Blog Posts</p>
                    <?php

                        $articleController = new ArticleController();
                        $articles = $articleController->getArticles(5);

                        include 'views/Articles.php';
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="../js/cookie_monster.js"></script>
    <script src="../js/cw_main.js"></script>
    <script src="../js/cw_slideshow.js"></script>
    <script src="../js/list.js"></script>
    <script src="../js/cw_bookmark_competition.js"></script>
</body>
</html>