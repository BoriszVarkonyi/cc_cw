<?php include "includes/db.php" ?>
<?php include "includes/functions.php" ?>
<?php include "includes/username_checker.php" ?>
<?php
    $qry_create_articels = "CREATE TABLE `ccdatabase`.`cw_articles` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NOT NULL , `body` TEXT NOT NULL , `author` VARCHAR(255) NOT NULL , `last_edit_by` VARCHAR(255) NOT NULL , `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , `last_edit` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_create_articles = mysqli_query($connection, $qry_create_articels);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/barebone_page_style.min.css">
    <title>d'V Admin</title>
</head>
<body>
      <h1>Hi there <?php echo $username ?>!</h1>
      <div class="basic_panel">
            <h2>Blog control:</h2>
            <button><a href="new_article.php">New article</a></button>
            <button><a href="article_selector.php">Modify article</a></button>
            <h2>Video control:</h2>
            <button><a href="add_video.php">Add video</a></button>
            <button><a href="video_selector.php">Modify videos</a></button>
      </div>
      <img id="dictator_image" src="article_pics/definitely_not_mao_ce_tung.jpg">
</body>
</html>