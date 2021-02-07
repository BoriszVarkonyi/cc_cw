<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php" ?>
<?php include "../includes/cw_username_checker.php" ?>
<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select article to modify</title>
</head>
<body>


<table style="width:100%">

                    <?php
                    $qry_get_articles = "SELECT * FROM cw_articles";
                    $do_get_articles = mysqli_query($connection, $qry_get_articles);

                    while ($row = mysqli_fetch_assoc($do_get_articles)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $body = $row['body'];
                        $author = $row['author'];

                    ?>

                    <!-- ne bánts kristóf nem értem a htmlt :( -->
                    <tr href="../cw/article_editor.php?article_id=<?php echo $id ?>">
                        <th>
                            <a href="../cw/article_editor.php?article_id=<?php echo $id ?>"><p><?php echo $title ?></p></a>
                        </th>
                        <th>
                            <a href="../cw/article_editor.php?article_id=<?php echo $id ?>"><p><?php echo $author ?></p></a>
                        </th>
                        <th>
                            <a href="../cw/article_editor.php?article_id=<?php echo $id ?>"><img width="100" height="100" src="../article_pics/<?php echo $id . '.png' ?>"><img></a>
                        </th>
                    </tr>
                    <?php
                    }
                    ?>

</table>


</body>
</html>