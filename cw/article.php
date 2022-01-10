<?php include "db.php" ?>
<?php include "../includes/functions.php" ?>
<?php include "./controllers/ArticleController.php" ?>
<?php
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $articleController = new ArticleController();
    $article = $articleController->getArticle($id);
    if(!$article) {
        header("Location: blog.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $article->title ?></title>
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_mainstyle.min.css">
</head>
<body class="blog">
    <?php include "cw_header.php"; ?>
    <main>
        <div id="content">
            <div id="title_stripe">
                <h1>
                    <a class="back_button" href="blog.php" aria-label="Go back to Blog">
                        <img src="../assets/icons/arrow_back_ios_black.svg" alt="Go back button">
                    </a>
                    <?php echo $article->title ?>
                </h1>
            </div>
            <div id="content_wrapper">
                <article>
                <?php
                    if(file_exists($article->pic)) {
                    ?>
                        <img src="<?php echo $article->pic ?>" alt="Article image">
                    <?php } ?>
                    <div class="info">
                        <p><?php echo "By: " . $article->author ?></p>
                        <p><?php echo $article->date ?></p>
                    </div>
                    <div class="body">
                        <p><?php echo str_replace("\n","<br/>",$article->body) ?></p>
                    </div>
                </article>
            </div>
        </div>
    </main>
    <?php include "cw_footer.php"; ?>
    <script src="../js/cw_main.js"></script>
</body>
</html>