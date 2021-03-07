<?php
    include "json_string.php";

    $array_of_fencers = json_decode($json_string);
    $n_fencers = count($array_of_fencers);

    //shuffle($array_of_fencers);

    $number_of_pools = 41;


    //1. param: hány darab csoport van,
    //2. param: hány személyesek a csoportok,
    //3. param: a versenyzők tömbje (sortolva, versenyzők objectek egy tömbben)
    function sorolas(int $n_pools,int $fencers_in_pools,array $array_of_fencers) {

        //kicsit szukitett fencer csak a necessery info van benne
        class fencer {
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

        //needs 'fencer' class before!
        //class of pools (fencer inside this)
        class pool{
            public $nationalitys = [];

            //function amivel hozzárakjuk a fencereket
            function add_fencer(int $y,object $fencer_obj) {

                $fencer_to_add = new fencer($fencer_obj);

                $this -> {$y} = $fencer_to_add;
                array_push($this -> nationalitys,$fencer_obj -> nation);
            }
        }

        //forward object saves xy when going ahead or backwards
        class forward {
            public $x = NULL;
            public $y = NULL;
            public $n_pools;

            //just so we know the number of pools
            function __construct($n_pools) {
                $this -> n_pools = $n_pools;
            }

            //saving position before going ahead
            function savePos($x, $y) {
                $n_pools = $this -> n_pools;
                if ($y % 2 == 0) {
                    //even
                    $x++;
                } else {
                    //odd
                    $x--;
                }
                $this -> x = $x;
                $this -> y = $y;
            }

            //sets saved x y to NULL
            function reset() {
                $this -> x = NULL;
                $this -> y = NULL;
            }

            //tests wether xy is NULL if so returns false
            function isSaved() {
                if ($this -> x === NULL && $this -> y === NULL) {
                    return false;
                } else {
                    return true;
                }
            }
        }

        //poolok letrehozasa az arrayben
        $array_of_pools = [];
        array_push($array_of_pools, NULL);
        for ($i = 0; $i < $n_pools; $i++) {
            $pool = new pool;
            array_push($array_of_pools, $pool);
        }

        //counterek
        $forward = new forward($n_pools);
        $fencer = 0;

        //INITIATE KíGYÓZÁS
        for ($y = 1; $y <= $fencers_in_pools; $y++) {
            if ($y % 2 == 0) {
                //EVEN 2, 4, 6
                for ($x = $n_pools; $x >= 1 && $y % 2 == 0; $x--) {
                    //letezik e a kovi fencer
                    if (!isset($array_of_fencers[$fencer])) {
                        break 2;
                    }
                    //van e mar fencer beirva
                    if (!isset($array_of_pools[$x] -> {$y})) {

                        //van e mar a poolban ugyan olyan nation u fencer
                        if (array_search($array_of_fencers[$fencer] -> nation,$array_of_pools[$x] -> nationalitys) === FALSE) {

                            //fencer beiras majd fencer +1
                            $array_of_pools[$x] -> add_fencer($y, $array_of_fencers[$fencer]);
                            $fencer++;

                            //visszalepes
                            if ($forward -> isSaved()) {
                                $x = $forward -> x;
                                $y = $forward -> y;
                                $forward -> reset();
                                if ($y % 2 != 0) { // ha y paratlan átlép a másik ágba
                                    $y--;
                                    break;
                                }
                            }
                        } else if (!$forward -> isSaved()) { //ha van mar ilyen nat a poolban
                            $forward -> savePos($x, $y);
                        }
                    }
                }

            } else {
                //ODD 1, 3, 5, 7
                for ($x = 1; $x <= $n_pools && $y % 2 != 0; $x++) {
                    //letezik e a kovi fencer
                    if (!isset($array_of_fencers[$fencer])) {
                        break 2;
                    }
                    //van e mar fencer beirva
                    if (!isset($array_of_pools[$x] -> {$y})) {

                        //van e mar a poolban ugyan olyan nation u fencer
                        if (array_search($array_of_fencers[$fencer] -> nation,$array_of_pools[$x] -> nationalitys)  === FALSE) {

                            //fencer beiras majd fencer +1
                            $array_of_pools[$x] -> add_fencer($y, $array_of_fencers[$fencer]);
                            $fencer++;
                            //visszalepes
                            if ($forward -> isSaved()) {
                                $x = $forward -> x;
                                $y = $forward -> y;

                                $forward -> reset();
                                if ($y % 2 == 0) {// ha y paros átlép a másik ágba
                                    $y--;
                                    break;
                                }
                            }
                        } else { //ha van mar ilyen nat a poolban
                            if ($x == $n_pools  && $y == $fencers_in_pools) { //ha a vegere ertunk akkor pakoljuk be az eredeti pos ba
                                if ($forward -> isSaved()) {
                                    $x = $forward -> x;
                                    $y = $forward -> y;
                                    if ($y % 2 == 0) {
                                        //even
                                        $x--;
                                    } else {
                                        //odd
                                        $x++;
                                    }
                                    $array_of_pools[$x] -> add_fencer($y, $array_of_fencers[$fencer]);
                                    $fencer++;
                                    $forward -> reset();
                                    if ($y % 2 == 0) {// ha y paros átlép a másik ágba
                                        $y--;
                                        break;
                                    }
                                } else {
                                    $array_of_pools[$n_pools] -> add_fencer($fencers_in_pools, $array_of_fencers[$fencer]);
                                    $fencer++;
                                }
                                //UTOLSO NEM CSAK PARATLAN LEHET LEHETNE PAROS IS

                            } else { //elore leptetjuk a pointert meg az fw_countert
                                if (!$forward -> isSaved()) {
                                    $forward -> savePos($x, $y);
                                }
                            }
                        }
                    }
                }
            }
        }
        return $array_of_pools;
    }

    $array_of_pos = sorolas(8, 7, $array_of_fencers);

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
    print_r($array_of_pos);
?>
</body>
</html>
