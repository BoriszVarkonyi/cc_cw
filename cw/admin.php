<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php" ?>
<?php include "../includes/cw_username_checker.php" ?>

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