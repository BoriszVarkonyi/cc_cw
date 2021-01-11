
<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    <link rel="stylesheet" href="../css/cw_mainstyle.css">
    <link rel="stylesheet" href="../css/basestyle.css">
</head>
<body>
    <div id="wrapper">
        <?php include "cw_header.php"; ?>
        <div id="main">
            <div id="content" class="list">
                <div id="title_stripe">
                    <p class="stripe_title">Blog</p>
                </div>
                <form id="browsing_bar">
                    <input type="text" class="hidden"> <!-- IF storing the search is nedded in text form-->
                    <div>
                        <button type="button" class="clear_search_button" onclick="" ><img src="../assets/icons/close-black-18dp.svg"></button>
                        <input type="text" name="" placeholder="Search by Fencer" class="search">
                    </div>
                    <input type="submit" value="Search">
                </form>

        <div class="cw_table_wrapper">

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


            <div class="blog_article" onclick="location.href='cw_article.php?id=<?php echo $id ?>'">
                <p class="article_title"><?php echo $title ?></p>
                <img src="<?php echo $pic ?>"  class="article_image">
                <div>
                    <p class="article_brief"><?php echo $brief ?></p>
                    <p class="article_post_date">POSTED: <?php echo $date ?></p>
                    <p class="article_post_date">BY: <?php echo $author ?></p> <!-- ennek nem biztos date nek kene lennie de csak ez volt na -->
                </div>
            </div>
            <?php 
                }
            ?>


            </div>
            <?php include "cw_footer.php"; ?>
        </div>
    </div>
<script src="../js/cw_main.js"></script>
</body>
</html>