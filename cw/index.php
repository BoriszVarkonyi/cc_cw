<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "./controllers/ArticleController.php" ?>
<?php include "./controllers/VideoController.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>d'Artagnan View</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/dv_mainstyle.min.css">
    <link rel="stylesheet" href="../css/homepage_style.min.css">
    <meta name="description" content="Check and Follow Fencing Competitions around the world with d'ArtagnanView">
</head>
<body class="home">
    <?php include "static/header.php"; ?>
    <main>
        <div id="slideshow">
            <div id="slideshow_content">
                <p id="slideshow_title">D'ARTAGNAN VIEW</p>
            </div>
            <button class="slideshow_navigation_button left" aria-label="Slideshow go left" onclick="slideToLeft()">
                <img src="../assets/icons/chevron_left_black.svg" alt="Slideshow go left">
            </button>
            <button class="slideshow_navigation_button right" aria-label="Slideshow go right" onclick="slideToRight()">
                <img src="../assets/icons/chevron_right_black.svg" alt="Slideshow go right">
            </button>
            <div id="slides">
                <img src="article_pics/slideshow_1.jpg" alt="slide_1" loading="lazy" class="slide">
                <img src="article_pics/slideshow_2.jpg" alt="slide_2" loading="lazy" class="slide hidden">
                <img src="article_pics/slideshow_3.jpg" alt="slide_3" loading="lazy" class="slide hidden">
                <img src="article_pics/slideshow_4.jpg" alt="slide_4" loading="lazy" class="slide hidden">
                <img src="article_pics/slideshow_5.jpg" alt="slide_5" loading="lazy" class="slide hidden">
                <img src="article_pics/slideshow_6.jpg" alt="slide_6" loading="lazy" class="slide hidden">
            </div>
            <p class="image_author">Pictures by: Zsolt Nekifor</p>
            <div id="shadow"></div>
            <div id="slide_indicator">
                <button onclick="jumpToSlide(1)" aria-label="Jump to Slide 1" class="current"></button>
                <button onclick="jumpToSlide(2)" aria-label="Jump to Slide 2"></button>
                <button onclick="jumpToSlide(3)" aria-label="Jump to Slide 3"></button>
                <button onclick="jumpToSlide(4)" aria-label="Jump to Slide 4"></button>
                <button onclick="jumpToSlide(5)" aria-label="Jump to Slide 5"></button>
                <button onclick="jumpToSlide(6)" aria-label="Jump to Slide 6"></button>
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
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/slideshow.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/bookmark_competition.js"></script>
</body>
</html>
