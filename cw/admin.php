<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php" ?>
<?php include "../includes/cw_username_checker.php" ?>
<?php
    $qry_create_articels = "CREATE TABLE `ccdatabase`.`cw_articles` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NOT NULL , `body` TEXT NOT NULL , `author` VARCHAR(255) NOT NULL , `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_create_articles = mysqli_query($connection, $qry_create_articels);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CW Admin</title>
</head>
<body>
<p>Hi there <?php echo $username ?>!</p>
<button><a href="new_article.php">New article</a></button>
<button><a href="article_selector.php">Modify article</a></button>

</body>
</html>