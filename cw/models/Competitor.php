<?php
class Competitor {
    public $fullName;
    public $rank;
    public $nation;
    public $club;

    function __construct($obj) {
        if($obj->final_rank != null) {
            $this->rank = $obj->final_rank;
        } else if ($obj->temp_rank != null) {
            $this->rank = $obj->temp_rank;
        } else {
            $this->rank = "0";
        }
        $this->fullName = $obj->prenom . " " . $obj->nom;
        $this->nation = $obj->nation;
        $this->club = $obj->club;
    }
}
?>