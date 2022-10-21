<?php
include "./models/Admin.php";

class AdminController {
    private $dbConnection;

    function __construct() {
        include "includes/db.php";
        $this->dbConnection = $connection;
    }

    function adminExists($name) {
        $do_get_admin = mysqli_query($this->dbConnection, "SELECT name, password FROM cw_admin WHERE name = '$name';");
        if(mysqli_num_rows($do_get_admin) == 0)  
            return false;
        return true;
    }

    function getAdminByName($name) {
        $do_get_admin = mysqli_query($this->dbConnection, "SELECT name, password FROM cw_admin WHERE name = '$name';");
        if($do_get_admin) {
            $row = mysqli_fetch_assoc($do_get_admin);
            return new Admin($row);
        } else {
            return new Admin('');
        }
    }

    function insert($name, $pass) {
        $insert_query = "INSERT INTO `cw_admin` (`name`, `password`) VALUES ('$name', '$pass')";
        return mysqli_query($this->dbConnection, $insert_query);
    }
}