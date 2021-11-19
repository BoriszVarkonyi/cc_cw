<?php
include "./models/Competitor.php";

class CompetitionController {
    private $dbConnection;
    private $comp_id;

    function __construct($comp_id) {
        include "db.php";
        $this->dbConnection = $connection;
        $this->comp_id = $comp_id;
    }

    function getCompetitors() {
        $qry_get_competitors = "SELECT * FROM competitors WHERE assoc_comp_id = '$this->comp_id';";
        $do_get_competitors = mysqli_query($this->dbConnection, $qry_get_competitors);
        if(!$do_get_competitors || mysqli_num_rows($do_get_competitors) == 0) {
            return array();
        } else {
            if ($row = mysqli_fetch_assoc($do_get_competitors)) {
                $json_string = $row['data'];
                $json_table = json_decode($json_string);

                $competitors = array();
                foreach($json_table as $obj) {
                    array_push($competitors, new Competitor($obj));
                }
                return $competitors;
            } else {
                echo mysqli_error($this->dbConnection);
                return array();
            }
        }
    }

    function sortByRank($a, $b) {
        return $a->rank - $b->rank;
    }

    function sortCompetitorsByRank($competitors) {
        try {
            usort($competitors, array($this,"sortByRank"));
        } catch (Exception $ex) {
            //hopefully this won't happen in prod :D
        }
        return $competitors;
    }
}
?>