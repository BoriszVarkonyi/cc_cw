<?php include "includes/db.php" ?>
<?php include "includes/functions.php" ?>
<?php include "includes/username_checker.php" ?>
<?php
    //get article by id
    $id = filter_input(INPUT_GET, 'article_id', FILTER_SANITIZE_NUMBER_INT);


    $qry_get_article = "SELECT * FROM `cw_articles` WHERE `id` = '$id'";
    $do_get_article = mysqli_query($connection, $qry_get_article);

    if ($row = mysqli_fetch_assoc($do_get_article)) {
        $title = $row['title'];
        $body = $row['body'];
        $author = $row['author'];
        $date = $row['date'];
        $picture_path = "article_pics/" . $id . ".png";

    }


    //delete existinf article
    if (isset($_POST['delete'])) {
        $qry_delete = "DELETE FROM `cw_articles` WHERE `id` = '$id'";
        $do_delete = mysqli_query($connection, $qry_delete);
        echo mysqli_error($connection);
        header("Location: ../cw/admin.php");
    }


    //upadte existing article
    if (isset($_POST['update'])) {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $date = date("Y/m/d");
        print_r($_POST);
        print_r($_FILES["fileToUpload"]);
        if ($title != "" && $body != "") {

            if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"] != null) {

                $target_dir = "article_pics/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }


                // Check if file already exists
                if (file_exists($target_file)) {

                    echo "Sorry, file already exists.";
                    $uploadOk = 0;

                }

                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {

                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                /*
                if(isset($_FILES["fileToUpload"])) {
                    try{
                        unlink("../article_pics/$id.png");
                        echo "The existing picture is deleted";
                    } catch (Exception $e) {
                        echo "Error '$e'!";
                        $uploadOk = 0;
                    }
                }
                */

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {

                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


                        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";



                        if (rename("article_pics/" . $_FILES["fileToUpload"]["name"], "article_pics/" . $id . ".png")) {

                            echo $_FILES["fileToUpload"]["name"] . " 's name has been changed";

                        } else {

                            echo "minden szar ÁÁÁÁÁÁÁÁÁÁÁÁ";

                        }

                    } else {

                    echo "Sorry, there was an error uploading your file.";

                    }

                }

            }

            //header("Location: ../cw/admin.php");
        }
        $date = new DateTime();
        $date = $date->format("Y-m-d");

        $qry_update = "UPDATE cw_articles SET title='$title', body='$body', last_edit='$date' WHERE id = '$id';";
        $do_update = mysqli_query($connection, $qry_update);
        if(!$do_update) {
            echo mysqli_error($connection);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/cw_barebone_page_style.min.css">
    <title>Edit '<?php echo $title; ?>'</title>
</head>
<body>
    <div class="basic_panel">
        <form method="POST" enctype="multipart/form-data">
            <h1>Article:</h1>
            <p>posted on:</p>
            <p><?php echo $date ?></p>
            <p>Author:<p>
            <p><?php echo $author ?></p>

            <input name="title" type="text" placeholder="Title here" value="<?php echo $title ?>">
            <textarea name="body" id="" cols="30" rows="10" placeholder="ARTICLE BODY HERE"><?php echo $body ?></textarea>

            <label>IMAGE</label>
            <img width="200" height="200" src="<?php echo $picture_path ?>"><img>
            <input type="file" name="fileToUpload" placeholder="title">
            <input type="submit" value="Save" name="update">
        </form>
        <form method="POST">
            <input type="submit" name="delete" value="DELETE">
        </form>
        <button>
            <a href="article_selector.php">Go back</a>
        </button>
    </div>
</body>
</html>