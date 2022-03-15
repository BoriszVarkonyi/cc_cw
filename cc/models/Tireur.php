<?php
class tireur
{
    public $sexe;
    public $id;
    public $image;
    public $points;
    public $classement;
    public $club;
    public $lateralite;
    public $date_naissance;
    public $licence;
    public $nation;
    public $prenom;
    public $nom;
    public $reg;
    public $wc;
    public $comp_rank;
    public $temp_rank;
    public $final_rank;
    public $barcode;

    function __construct($sexe, $id, $image, $points, $classement, $club, $lateralite, $date_naissance, $licence, $nation, $prenom, $nom, $reg, $wc, $comp_rank, $temp_rank, $final_rank, $barcode)
    {
        $this->sexe = $sexe;
        $this->id = $id;
        $this->image = $image;
        $this->points = $points;
        $this->classement = $classement;
        $this->club = $club;
        $this->lateralite = $lateralite;
        $this->date_naissance = $date_naissance;
        $this->licence = $licence;
        $this->nation = $nation;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->reg = $reg;
        $this->wc = $wc;
        $this->comp_rank = $comp_rank;
        $this->temp_rank = $temp_rank;
        $this->final_rank = $final_rank;
        $this->barcode = $barcode;
    }
}
