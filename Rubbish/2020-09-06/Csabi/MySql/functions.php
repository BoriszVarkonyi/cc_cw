<?php include "db.php";?>


<?php function createRows(){




if(isset($_POST['submit'])){
global $connection;

    $username = $_POST['username'];
    $password = $_POST['password'];

$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);


$hashFormat = "$2y$10$";
$salt = "iusesomecrazystrings22";
$hashF_and_salt = $hashFormat . $salt;
$password = crypt($password, $hashF_and_salt);
    
    
    $query = "INSERT INTO users(username,password)";
    $query .= "VALUES ('$username', '$password')";
    
    $result = mysqli_query($connection, $query);
    
    if(!$result){
    
    die('Query FAILED' . mysqli_error());
    
    
    } else {

        echo "Record Create";
    
    }

}
}

function readRows(){
    global $connection;

    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);
    
    if(!$result){
    
    die('Query FAILED' . mysqli_error());

}
while($row = mysqli_fetch_assoc($result)) {
   
    print_r($row);

}

}


function showAllData(){
    global $connection;
    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Query FAILED' . mysqli_error());
    }

$query = "SELECT * FROM users";
$result = mysqli_query($connection, $query);
if(!$result){
die('Query FAILED' . mysqli_error($connection));

}

while($row = mysqli_fetch_assoc($result)){
    $id = $row['id'];

     echo "<option value='$id'>$id</option>";

}

}



function deleteRows(){

global $connection;

$username = $_POST['username'];
$password = $_POST['password'];
$id = $_POST['id'];

$query = "DELETE FROM users ";
$query .= "WHERE id = '$id' ";

$result = mysqli_query($connection, $query);
if(!$result){

    die("QUERY FAILED" . mysqli_error($connection));

}

}

?>