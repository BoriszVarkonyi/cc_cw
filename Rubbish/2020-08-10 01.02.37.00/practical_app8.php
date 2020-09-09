<?php

class Dog {

var $eyeColors = "Blue";
var $noseColor = "black";
var $furColor = "brown";

function ShowAll(){

    echo $this->eyeColors . "<br>";
    echo $this->noseColor .  "<br>";
    echo $this->furColor .  "<br>";


}




}

new Dog();


?>