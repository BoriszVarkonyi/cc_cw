<?php include "includes/db.php" ?>
<?php include "./controllers/ArticleController.php" ?>
<?php
    include "../i18n/i18n.php";
    $i18n = new I18N();
?>
<?php
    if(isset($_GET['q'])) {
        $q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/dv_mainstyle.min.css">
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
                        <input type="text" name="q" placeholder="Search by Title" class="search page alt" value="<?php if(isset($_GET['q'])) echo $q; ?>">
                        <button type="button" onclick="" aria-label="Close Search"><img src="../assets/icons/close_black.svg" alt="Search Close"></button>
                    </div>
                    <input type="submit" value="Search">
                </form>

                <div id="blog_wrapper">
                    <?php
                        $articleController = new ArticleController();
                        if(isset($_GET['q']))
                            $articles = $articleController->getArticlesSearch($q);
                        else
                            $articles = $articleController->getArticles();

                        include 'views/Articles.php';
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php include "static/footer.php"; ?>
    <script src="javascript/main.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>