<?php $comp_id = $_GET["comp_id"] ?>

<?php
    //deletes file with comp_id name
    if (unlink("../uploads/" . $comp_id . ".png")) {

        header("Location: ../cc/invitation.php?comp_id=$comp_id");

    } else {
        //error

        echo "There was a problem deleting your logo picture!";
    }


?>

