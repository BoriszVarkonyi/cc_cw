<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php" ?>
<?php include "../includes/cw_username_checker.php" ?>
<?php




if (isset($_POST['submit'])) {
    $target_dir = "../article_pics/";
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

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        
            if (rename($_FILES["fileToUpload"]["name"], $title . ".png")) {

                echo $_FILES["fileToUpload"]["name"] . " 's name has been changed";
                
            } else {

                echo "minden szar ÁÁÁÁÁÁÁÁÁÁÁÁ";

            }
        
            //header("Location: ../php/invitation.php?comp_id=$comp_id");

        } else {

        echo "Sorry, there was an error uploading your file.";

        }

    }
}
    





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CW Admin</title>
</head>
<body>
    
<h1>New article</h1>

<form action="" id="new_article" method="POST" >
<input name="title" type="text" placeholder="title">
<br>
<textarea name="body" id="body" cols="30" rows="10" placeholder="ARTICLE BODY HERE"></textarea>
<p>image:</p>
<input name="fileToUpload" type="file" placeholder="title">
<br>
<br>
<input type="submit" value="SAVE" name="submit">
<input type="submit" value="CANCEL" name="cancel">

</body>
</html>