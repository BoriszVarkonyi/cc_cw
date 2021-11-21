<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php" ?>
<?php include "../includes/cw_username_checker.php" ?>
<?php
    $qry_create_articels = "CREATE TABLE `ccdatabase`.`cw_articles` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NOT NULL , `body` TEXT NOT NULL , `author` VARCHAR(255) NOT NULL , `last_edit_by` VARCHAR(255) NOT NULL , `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , `last_edit` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $do_create_articles = mysqli_query($connection, $qry_create_articels);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CW Admin</title>

    <style>
img {
  width: 200px;
  height: 200px;
  background: red;
  animation: example 4s infinite;
}

@keyframes example {
  0%   {background: red;
        transform: rotate(0deg);
        margin-left: 0px;
        margin-top: 0px}
  25%  {background: yellow;}
  50%  {background: blue;
        margin-left: 800px;
        margin-top: 200px}
  100% {background: green;
        transform: rotate(360deg);
        margin-left: 0px;
        margin-top: 0px}
}
</style>

</head>
<body>
<p>Hi there <?php echo $username ?>!</p>
<button><a href="new_article.php">New article</a></button>
<button><a href="article_selector.php">Modify article</a></button>
<br/>
<button><a href="cw_add_video.php">Add video</a></button>
<button><a href="cw_video_selector.php">Modify videos</a></button>
<br><br>
<img src="..\uploads\osama_bin_laden_PNG27.png">

</body>
</html>