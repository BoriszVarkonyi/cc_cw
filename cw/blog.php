
<?php include "../includes/db.php" ?>
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
    <?php include "cw_header.php"; ?>
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

                        foreach($articles as $article) {
                    ?>

                    <div class="blog_article" onclick="location.href='article.php?id=<?php echo $article->id ?>'">
                    <?php
                        if(file_exists($article->pic)) {
                    ?>
                        <img src="<?php echo $article->pic ?>" alt="Article image">
                    <?php } ?>
                        <p class="article_title"><?php echo $article->title ?></p>
                        <p class="article_brief"><?php echo $article->body ?></p>
                        <div class="article_info">
                            <p>POSTED: <?php echo $article->date ?></p>
                            <p>BY: <?php echo $article->author ?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>