<?php

class Admin {
    public $Name;
    public $Password; 
    function __construct($row) {
       $this->Name = $row['name'] ?? null;
       $this->Password = $row['password'] ?? null;
    }
}