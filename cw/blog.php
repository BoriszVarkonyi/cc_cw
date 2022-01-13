
<?php include "db.php" ?>
<?php include "../includes/functions.php" ?>
<?php include "./controllers/ArticleController.php" ?>
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
    <?php include "static/header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>Blog</h1>
            </div>
            <div id="content_wrapper">
                <form id="browsing_bar">
                    <div class="search_wrapper wide">
                        <input type="text" name="" placeholder="Search by Title" class="search page alt">
                        <button type="button" onclick="" aria-label="Close Search"><img src="../assets/icons/close_black.svg" alt="Search Close"></button>
                    </div>
                    <input type="submit" value="Search">
                </form>

                <div id="blog_wrapper">
                    <?php
                        $articleController = new ArticleController();
                        $articles = $articleController->getArticles();

                        include 'views/Articles.php';
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>