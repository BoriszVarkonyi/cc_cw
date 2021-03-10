<?php include "..\includes\db.php"; ?>
<?php
$comp_id = $_GET['comp_id'];

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }

// Check if file already exists
if (file_exists($target_file)) {

    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
// if ($_FILES["fileToUpload"]["size"] > 524288) {

//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;

// }

// Allow certain file formats
// if($imageFileType != "xml") {

//     echo "Sorry, only XML files are allowed.";
//     $uploadOk = 0;

// }

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";

        if (rename($_FILES["fileToUpload"]["name"], $comp_id . ".xml")) {

            echo $_FILES["fileToUpload"]["name"] . " 's name has been changed";
        } else {

            echo "minden szar ÁÁÁÁÁÁÁÁÁÁÁÁ";
        }

        class tireur{
            public $sexe;
            public $id;
            public $image;
            public $points;
            public $classement;
            public $club;
            public $lateralite;
            public $date_naissance;
            public $licence;
            public $nation;
            public $prenom;
            public $nom;
            public $reg;
            public $wc;
            public $comp_rank;
            public $temp_rank;
            public $final_rank;

            function __construct($sexe,$id,$image,$points,$classement,$club,$lateralite,$date_naissance,$licence,$nation,$prenom,$nom,$reg,$wc,$comp_rank,$temp_rank,$final_rank) {
                $this -> sexe = $sexe;
                $this -> id = $id;
                $this -> image = $image;
                $this -> points = $points;
                $this -> classement = $classement;
                $this -> club = $club;
                $this -> lateralite = $lateralite;
                $this -> date_naissance = $date_naissance;
                $this -> licence = $licence;
                $this -> nation = $nation;
                $this -> prenom = $prenom;
                $this -> nom = $nom;
                $this -> reg = $reg;
                $this -> wc = $wc;
                $this -> comp_rank = $comp_rank;
                $this -> temp_rank = $temp_rank;
                $this -> final_rank = $final_rank;
            }
        }


        $xml = simplexml_load_file("$comp_id.xml");

        $qry_check_row = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
        $do_check_row = mysqli_query($connection, $qry_check_row);
        if ($row = mysqli_fetch_assoc($do_check_row)) {
            $json_string = $row['data'];
            $json_table = json_decode($json_string);
        }else{
            echo mysqli_error($connection);
        }

        foreach ($xml->Tireurs->children() as $fencers) {

            if (isset($fencers["Sexe"])) {
                $sexe = str_replace("'", "", reset($fencers["Sexe"]));
            }
            else{
                $sexe = NULL;
            }
            if (isset($fencers["ID"])) {
                $id= str_replace("'", "", reset($fencers["ID"]));
            }
            else{
                $id = NULL;
            }
            if (isset($fencers["Image"])) {
                $image= str_replace("'", "", reset($fencers["Image"]));
            }
            else{
                $image = NULL;
            }
            if (isset($fencers["Points"])) {
                $points= str_replace("'", "", reset($fencers["Points"]));
            }
            else{
                $points = NULL;
            }
            if (isset($fencers["Classement"])) {
                $classement= str_replace("'", "", reset($fencers["Classement"]));
            }
            else{
                $classement = NULL;
            }
            if (isset($fencers["Club"])) {
                $club= str_replace("'", "", reset($fencers["Club"]));
            }
            else{
                $club = NULL;
            }
            if (isset($fencers["Lateralite"])) {
                $lateralite= str_replace("'", "", reset($fencers["Lateralite"]));
            }
            else{
                $lateralite = NULL;
            }
            if (isset($fencers["Date_naissance"])) {
                $date_naissance= str_replace("'", "", reset($fencers["Date_naissance"]));
            }
            else{
                $date_naissance = NULL;
            }
            if (isset($fencers["Licence"])) {
                $licence= str_replace("'", "", reset($fencers["Licence"]));
            }
            else{
                $licence = NULL;
            }
            if (isset($fencers["Nation"])) {
                $nation= str_replace("'", "", reset($fencers["Nation"]));
            }
            else{
                $nation = NULL;
            }
            if (isset($fencers["Prenom"])) {
                $prenom= str_replace("'", "", reset($fencers["Prenom"]));
            }
            else{
                $prenom = NULL;
            }
            if (isset($fencers["Nom"])) {
                $nom= str_replace("'", "", reset($fencers["Nom"]));
            }
            else{
                $nom = NULL;
            }

            $reg= false;
            $wc= false;
            $comp_rank= NULL;
            $temp_rank= NULL;
            $final_rank= NULL;

            if ($classement == NULL || $classement == "") {
                $classement = 999;
            }

            $fencer_object = new tireur($sexe,$id,$image,$points,$classement,$club,$lateralite,$date_naissance,$licence,$nation,$prenom,$nom,$reg,$wc,$comp_rank,$temp_rank,$final_rank);

            array_push($json_table, $fencer_object);

        }

            $json_string = json_encode($json_table, JSON_UNESCAPED_UNICODE);


            echo $qry_update_data = "UPDATE `competitors` SET `data` = '$json_string' WHERE `assoc_comp_id` = '$comp_id'";
            $do_update_data = mysqli_query($connection, $qry_update_data);

            echo mysqli_error($connection);


        header("Location: ../php/competitors.php?comp_id=$comp_id");
    } else {

        echo "Sorry, there was an error uploading your file.";
    }
}
