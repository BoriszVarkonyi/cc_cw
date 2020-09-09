<?php

$connection = mysqli_connect('localhost', 'root', '', 'gyakorlo');
if(!$connection){

    die("Database connection failed") . mysqli_error($connection);

}

$query = "SELECT * FROM reports";

$result = mysqli_query($connection,$query);

if(!$result){

    die("QUERY FAILED");

}

while($record = mysqli_fetch_assoc($result)){


    echo $record ['days_of_the_week'];

}

?>