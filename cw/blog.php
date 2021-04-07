
<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="blog">
    <?php include "cw_header.php"; ?>
    <div id="main">
        <div id="content">
            <div id="title_stripe">
                <p class="stripe_title">Blog</p>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick=""><img src="../assets/icons/close-black.svg"></button>
                    </div>
                    <input type="submit" value="Search">
                </form>

                <div>
                    <?php
                    $qry_get_data = "SELECT * FROM `cw_articles`";
                    $do_get_data = mysqli_query($connection, $qry_get_data);

                    while ($row = mysqli_fetch_assoc($do_get_data)) {
                        $title = $row['title'];
                        $body = $row['body'];
                        $author = $row['author'];
                        $date = $row['date'];
                        $id = $row['id'];
                        $pic = "../article_pics/" . $id . ".png";

                        $brief = substr($body, 0, 400);

                    ?>

                    <div class="blog_article" onclick="location.href='article.php?id=<?php echo $id ?>'">
                        <p class="article_title"><?php echo $title ?></p>
                        <img src="<?php echo $pic ?>"  class="article_image">
                        <p class="article_brief"><?php echo $body ?></p>
                        <p class="article_post_date">POSTED: <?php echo $date ?></p>
                        <p class="article_post_date">BY: <?php echo $author ?></p> <!-- ennek nem biztos date nek kene lennie de csak ez volt na -->
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>