<?php
    include "json_string.php";

    $array_of_fencers = json_decode($json_string);
    $n_fencers = count($array_of_fencers);

    //shuffle($array_of_fencers);

    $number_of_pools = 41;

    class pool{
        public $nationalitys = [];
    }

    class fencer_to_add {
        public $prenom_nom;
        public $id;
        public $c_pos;
        public $r_pos;
        public $nation;

        function __construct(object $fencer_obj){
            $this -> prenom_nom = $fencer_obj->prenom . " " . $fencer_obj->nom;
            $this -> id = $fencer_obj->id;
            $this -> c_pos = $fencer_obj->comp_rank;
            $this -> r_pos = $fencer_obj->classement;
            $this -> nation = $fencer_obj->nation;
        }
    }



    function sorolas(int $n_pools,int $fencers_in_pools,array $array_of_fencers) {

        //function amivel hozzárakjuk a fencereket
        function add_fencer(int $x,int $y,object $fencer_obj,array $array_of_pools) {
            $object = new fencer_to_add($fencer_obj);
            $array_of_pools[$x] -> $y = $object;
            array_push($array_of_pools[$x] -> nationalitys,$fencer_obj -> nation);

            return $array_of_pools;
        }

        //poolok letrehozasa az arrayben
        $array_of_pools = [];
        array_push($array_of_pools, NULL);
        for ($i = 0; $i < $n_pools; $i++) {
            $pool = new pool;
            array_push($array_of_pools, $pool);
        }

        //counterek
        $fw_counter = 0;
        $fencer = 0;

        //INITIATE KíGYÓZÁS
        for ($y = 1; $y <= $fencers_in_pools; $y++) {
            if ($y % 2 == 0) {
                //EVEN 2, 4, 6
                for ($x = $n_pools; $x >= 1; $x--) {

                    //van e mar fencer beirva
                    if (!isset($array_of_pools[$x] -> {$y})) {

                        //van e mar a poolban ugyan olyan nation u fencer
                        if (array_search($array_of_fencers[$fencer] -> nation,$array_of_pools[$x] -> nationalitys) === FALSE) {

                            //fencer beiras majd fencer +1
                            $array_of_pools = add_fencer($x,$y,$array_of_fencers[$fencer], $array_of_pools);
                            $fencer++;
                            //letezik e a kövi fencer
                            if (!isset($array_of_fencers[$fencer])) {
                                break 2;
                            }

                            //vissza kell e lepni
                            if ($fw_counter != 0) {
                                //visszaleptetes
                                $quotient = $fw_counter / $n_pools;
                                $y = $y - floor($quotient);
                                $fw_counter = 0;
                                if ($y % 2 == 0) {
                                    $x = $n_pools + 1;
                                } else {
                                    $x = 1;
                                }
                            }
                        } else { //ha van mar ilyen nat a poolban
                            if ($x == $n_pools  && $y == $fencers_in_pools) { //ha a vegere ertunk akkor pakoljuk be az eredeti pos ba
                                $remainder = $fw_counter % $n_pools;
                                $quotient = $fw_counter / $n_pools;

                                $y = $fencers_in_pools - floor($quotient);
                                if ($y % 2 == 0) {
                                    for ($x = $n_pools; $x >= 1; $x--) {
                                        if (!isset($array_of_pools[$x] -> {$y})) {
                                            $array_of_pools = add_fencer($x,$y,$array_of_fencers[$fencer], $array_of_pools);
                                            break;
                                        }
                                    }
                                } else {
                                    for ($x = 1; $x <= $n_pools; $x++) {
                                        if (!isset($array_of_pools[$x] -> {$y})) {
                                            $array_of_pools = add_fencer($x,$y,$array_of_fencers[$fencer], $array_of_pools);
                                            break;
                                        }
                                    }
                                }

                                $fencer++;
                                if (!isset($array_of_fencers[$fencer])) {
                                    break 2;
                                }
                                $fw_counter = 0;

                            } else { //elore leptetjuk a pointert meg az fw_countert
                                $fw_counter++;
                            }
                        }
                    }
                }
            } else {
                //ODD 1, 3, 5, 7
                for ($x = 1; $x <= $n_pools; $x++) {

                    //van e mar fencer beirva
                    if (!isset($array_of_pools[$x] -> {$y})) {

                        //van e mar a poolban ugyan olyan nation u fencer
                        if (array_search($array_of_fencers[$fencer] -> nation,$array_of_pools[$x] -> nationalitys)  === FALSE) {

                            //fencer beiras majd fencer +1
                            $array_of_pools = add_fencer($x,$y,$array_of_fencers[$fencer], $array_of_pools);
                            $fencer++;

                            //letezik e a kovi fencer
                            if (!isset($array_of_fencers[$fencer])) {
                                break 2;
                            }

                            //kell e vissza lepni
                            if ($fw_counter != 0) {
                                //visszaleptetes
                                $quotient = $fw_counter / $n_pools;
                                $y = $y - floor($quotient);
                                $remainder = $fw_counter % $n_pools;
                                if ($y % 2 == 0) {
                                    $x = $n_pools + 1;
                                } else {
                                    $x = 1;
                                }
                                $fw_counter = 0;
                            }
                        } else { //ha van mar ilyen nat a poolban

                            if ($x >= $n_pools  && $y >= $fencers_in_pools) { //ha a vegere ertunk akkor pakoljuk be az eredeti pos ba
                                $remainder = $fw_counter % $n_pools;
                                $quotient = $fw_counter / $n_pools;

                                $y = $fencers_in_pools - floor($quotient);
                                if ($y % 2 == 0) {
                                    for ($x = $n_pools; $x >= 1; $x--) {
                                        if (!isset($array_of_pools[$x] -> {$y})) {
                                            $array_of_pools = add_fencer($x,$y,$array_of_fencers[$fencer], $array_of_pools);
                                            break;
                                        }
                                    }
                                } else {
                                    for ($x = 1; $x <= $n_pools; $x++) {
                                        if (!isset($array_of_pools[$x] -> {$y})) {
                                            $array_of_pools = add_fencer($x,$y,$array_of_fencers[$fencer], $array_of_pools);
                                            break;
                                        }
                                    }
                                }
                                $fencer++;
                                if (!isset($array_of_fencers[$fencer])) {
                                    break 2;
                                }
                                $fw_counter = 0;
                            } else { //elore leptetjuk a pointert meg az fw_countert
                                $fw_counter++;
                            }
                        }
                    }
                }
            }
        }

        return $array_of_pools;
    }


    $array_of_pos = sorolas(41, 7, $array_of_fencers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kínhalál</title>
</head>
<body>
<?php
    for ($pool_num = 1; $pool_num < count($array_of_pos); $pool_num++) {
        ?><p><?php echo $pool_num ?></p><?php
        echo "<br>";
        foreach ($array_of_pos[$pool_num] as $key => $fencers) {
            ?>
                <p><?php echo $key ?></p>
                <p><?php print_r($fencers) ?></p>

            <?php
        }
        echo "<br>";
    }
    echo "number of fencers: " .  $n_fencers;
?>
</body>
</html>
