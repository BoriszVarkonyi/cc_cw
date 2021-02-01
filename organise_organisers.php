<?php include "includes/db.php" ?>
<?php

    if (isset($_POST['submit'])) {
        $test = TRUE;
        $name = $_POST['username'];
        $pass = $_POST['password'];
        $pass_a = $_POST['password_a'];
        $end_o_l = $_POST['license_end'];

        if ($pass == "") {
            $test = FALSE;
        }

        if ($name == "") {
            $test = FALSE;
        }

        if ($pass != $pass_a) {
            $test = FALSE;
        }
        if ($test) {
            $pass_hashed = password_hash($pass, PASSWORD_DEFAULT);

            $qry_insert = "INSERT INTO organisers (username, password, License_end, License_valid) VALUES ('$name', '$pass_hashed', '$end_o_l', '1')";
            $do_insert = mysqli_query($connection, $qry_insert);
            echo mysqli_error($connection);
            header("Refresh:0");
        } else {
            echo "tset is fasle";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organisers</title>
</head>
<body>
    <h1>Current organisers</h1>
    <div>
        <table>
            <tr>
                <td>ID</td>
                <td>Username</td>
                <td>License end</td>
                <td>License Valid</td>
                <td>Warning</td>
            </tr>
            <?php 
                //get organisers
                $qry_get_org = "SELECT * FROM `organisers`";
                $do_get_org = mysqli_query($connection, $qry_get_org);

                while ($row = mysqli_fetch_assoc($do_get_org)) {
                    $username = $row['username'];
                    $id = $row['id'];
                    $License_end = $row['License_end'];
                    $Lincense_valid = $row['License_valid'];
                    if ($Lincense_valid) {
                        $warning_color = "white";
                    } else {
                        $warning_color = "red";
                    }
                    
                    ?>
                        <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $username ?></td>
                            <td><?php echo $License_end ?></td>
                            <td><?php echo $Lincense_valid ?></td>
                            <td style="background:<?php echo $warning_color  ?>"></td>
                        </tr>

                    <?php
                }
            ?>
        </table>
    </div>

    <h1>Set up new organiser</h1>
    <form id="add_new_organmiser" action="" method="POST">
        <label for="username">Username</label><br>
        <input autocomplete="off" type="text" name="username" id="username" placeholder="Type your username here"><br>
        <label for="password">Password</label><br>
        <input autocomplete="off" type="password" name="password" id="password" placeholder="Type your password here"><br>
        <label for="password_a">Password again</label><br>
        <input autocomplete="off" type="password" name="password_a" id="password_a" placeholder="Type your password here"><br>
        <label for="license_end">End of License</label><br>
        <input type="date" name="license_end" id="license_end" placeholder="End of license"><br><br>
        <input type="submit"  name="submit" id="submit" placeholder="submit">
    </form>
</body>
</html>
