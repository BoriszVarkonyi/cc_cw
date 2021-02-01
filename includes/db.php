<?php

//connecting and testing databse connections
$connection = mysqli_connect("localhost","root","","ccdatabase");
mysqli_set_charset($connection, "UTF-8");
if (!$connection) {

    echo "Connection error" . mysqli_error($connection);
}
?>