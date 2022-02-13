<?php
include "Technician.php";

class TechnicianFactory {
    private $connection;

    function __construct($connection){
        $this->connection = $connection;
    }

    function fromUsername($username) {
        $query_result = $this->connection->query("SELECT * FROM technicians WHERE username = '$username'");
        if($query_result) {
            $row = $this->connection->fetch_assoc();
            return new Technician($row);
        }
        return null;
    }
    function fromId($id) {
        $query_result = $this->connection->query("SELECT * FROM technicians WHERE id = '$id'");
        if($query_result) {
            $row = $this->connection->fetch_assoc();
            return new Technician($row);
        }
        return null;
    }
    function allFromCompetition($assoc_comp_id) {
        $technicians = array();
        $query_result = $this->connection->query("SELECT * FROM technicians WHERE assoc_comp_id = '$assoc_comp_id'");
        foreach($query_result as $row) {
            array_push($technicians, new Technician($row));
        }
        return $technicians;
    }
    function addNewTechnician($assoc_comp_id, $username, $name, $role) {
        $this->connection->query("INSERT INTO technicians (assoc_comp_id, username, name, role) VALUES ($assoc_comp_id, '$username', '$name', '$role')");
    }
    function deleteTechnicianByUserName($username) {
        $this->connection->query("DELETE FROM technicians WHERE username = '$username'");
    }
}