<?php include '../includes/db.php' ?>
<?php include '../includes/username_checker.php' ?>

<?php 
    
    print_r($_POST);
    
    $where = $_GET['where'];
    $where = rtrim($where, "_");
    $array_where = explode("_", $where);
    
        if (isset($_POST['r_submit'])) {
            $password = $_POST['r_pass'];
            $passworda = $_POST['r_passa'];
            echo "áááááááááááááá";
            if ($password != "" && $passworda != "") {

                if ($password == $passworda) {

                    $password = password_hash($password, PASSWORD_DEFAULT);
                    foreach ($array_where as $value) {
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
    <form id="login" method="POST">
        <input type="password" name="r_pass" placeholder="password">
        <input type="password" name="r_passa" placeholder="password again">
        <input type="submit" name="r_submit">
    </form>
</body>
</html>
