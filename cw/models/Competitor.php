<?php
class Competitor {
    public $fullName;
    public $rank;
    public $isFinalRank;
    public $nation;
    public $club;

    function __construct($obj) {
        $this->isFinalRank = false;
        if($obj->final_rank != null) {
            $this->rank = $obj->final_rank;
            $this->isFinalRank = true;
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