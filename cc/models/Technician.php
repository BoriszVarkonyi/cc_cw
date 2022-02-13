<?php

class Technician {
    public $id;
    public $assoc_comp_id;
    public $username;
    public $name;
    public $role;
    public $pass;
    public $online;
    
    function __construct($row){
        $this->id = $row["id"];
        $this->assoc_comp_id = $row["assoc_comp_id"];
        $this->username = $row["username"];
        $this->name = $row["name"];
        $this->role = $row["role"];
        $this->pass = $row["pass"];
        $this->online = $row["online"];
    }
}

?>