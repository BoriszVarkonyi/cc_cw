<?php

$file = "example.txt";

if($handle = fopen($file, 'w')) {

$content = fread($handle, 'I love PHP');

fclose($handle);

} else {

echo "The application was not able to write on the file";

}








?>