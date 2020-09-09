<?php

$connection = mysqli_connect("localhost","root","","ccdatabase");

if (!$connection) {

    echo "Connection error" . mysqli_error($connection);
}
?>