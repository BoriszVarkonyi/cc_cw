<?php include "db.php";?>
<?php include "functions.php";?>

<?php
if(isset($_POST['submit'])){

    deleteRows();

}

?>

<?php include "includes/header.php"?>

<div class="container">

<div class="col-xs-6">
<h1 class="text-center">DELETE</h1>

<form action="login_delete.php" method="post">
        <div class="form-group">
        <label for="username">Username</label>
            <input type="text" name="username" class="form-control">
        </div>

        <div class="form-group">
        <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
            </form-control">
        </div>

        <div class="form-group">

        <select name="id" id="">

        <?php

            $query = "SELECT * FROM users";
            $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($result)){

               $id = $row['id'];

           echo "<option value='$id'>$id</option>";

        }

        ?>
        </select>
        </div>

        <input type="submit" name="submit" value="DELETE">

    </form>
</div>
</div>
<?php include "includes/footer.php"?>