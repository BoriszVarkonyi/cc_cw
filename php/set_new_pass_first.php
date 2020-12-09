<?php include '../includes/db.php' ?>
<?php include '../includes/username_checker.php' ?>

<?php 
    
    print_r($_POST);

    $where = $_GET['where'];
    $where = rtrim($where, "_");
    $array_where = explode("_", $where);

        if (isset($_POST['submit'])) {
            $password = $_POST['pass'];
            $passworda = $_POST['pass_again'];
            echo "áááááááááááááá";
            if ($password != "" && $passworda != "") {

                if ($password == $passworda) {
                    foreach ($value as $array_where) {
                        $qry_update_pass = "UPDATE `tech_$value` SET `pass` = '$password' WHERE `name` = '$username'";
                        $do_uodate_pass = mysqli_query($connection, $qry_update_pass);
                    }
                    
                }
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set up your password!</title>
</head>
<body>
    <p><h1>Choose a password for <?php echo $username ?></h1></p>

    <from id="asd" method="POST" action="../php/set_new_pass_first.php">
        <label for="pass">Type in your password</label>
        <br>
        <input type="password" name="pass">
        <br>
        <label for="pass_again">Type in your password again</label>
        <br>
        <input type="password" name="pass_again">
        <br>
        <input type="submit" name="submit" value="submit">
    </form>
    <?php 
        print_r($array_where);
        echo mysqli_error($connection);
        
    
    ?>
</body>
</html>
