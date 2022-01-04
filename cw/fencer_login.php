<?php include "../includes/db.php" ?>
<?php include "cw_comp_getdata.php" ?>
<?php
    session_start();

    //log out
    if(isset($_GET['log_out'])) {
        session_destroy();
        header("Location: competition.php?comp_id=$comp_id");
    }

    //check if fencer is already logged in
    if(isset($_SESSION["fencer_name"])) {
        echo "<h1>Already logged in!</h1>";
        header("Location: my_matches_individual.php");
    }

    //login existing fencer
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['pass'];

        $qry_get_competitors_data = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
        $do_get_data = mysqli_query($connection, $qry_get_competitors_data);
        if ($rows = mysqli_fetch_assoc($do_get_data)) {
            $rows = json_decode($rows["data"]);
            foreach($rows as $row) {
                $full_name = $row->nom . " " . $row->prenom;
                if($full_name == $username && $full_name == $password) {
                    $_SESSION["fencer_id"] = $row->id;
                    $_SESSION["fencer_name"] = $full_name;
                    $_SESSION["comp_id"] = $comp_id;
                    header("Location: my_matches_individual.php");
                }
            }
        } else {
            $feedback = "Error " . mysqli_error($connection);
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
    <title>Fencer Login</title>
</head>
<body>
    <div class="basic_panel">
        <h1>LOGIN</h1>
        <?php $feedback ?>
        <form id="login" method="POST">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="pass" placeholder="password">
            <button type="submit" name="submit">Login<button>
        </form>
    </div>
    <a href="competition.php?comp_id=<?php echo $comp_id; ?>">Go back</a>
</body>
</html>