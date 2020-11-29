<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php" ?>
<?php include "../includes/cw_username_checker.php" ?>

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
  background-color: red;
  animation: example 4s infinite;
}

@keyframes example {
  0%   {background-color: red;
        transform: rotate(0deg);
        margin-left: 0px;
        margin-top: 0px}
  25%  {background-color: yellow;}
  50%  {background-color: blue;
        margin-left: 800px;
        margin-top: 200px}
  100% {background-color: green;
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
<br><br>
<img src="image_while_dev\osama_bin_laden_PNG27.png">

</body>
</html>