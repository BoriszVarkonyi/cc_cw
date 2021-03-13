<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php include '../includes/sortfunction.php' ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php
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
            public $ref1 = NULL;
            public $ref2 = NULL;
            public $piste = NULL;
            public $s_time = NULL;

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
                        } else {
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
                                    if ($y % 2 != 0) {// ha y paratlan átlép a másik ágba
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


    //get fencers from competitors db int oarray
    $qry_get_array = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
    $do_get_array = mysqli_query($connection, $qry_get_array);
    if ($row = mysqli_fetch_assoc($do_get_array)) {
        $json_string = $row['data'];
        $json_table = json_decode($json_string);
    }


    //make pools table
    $qry_make_pools = "CREATE TABLE `ccdatabase`.`pools` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `data` LONGTEXT NOT NULL, `pool_of` INT(1) NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    if (!$do_make_pools = mysqli_query($connection, $qry_make_pools)) {
        echo mysqli_error($connection);
    }


    //_________CSAK NEKED BORISZ____________//
    $number_of_fencers = count($json_table);//
    //______________________________________//

    if (isset($_POST['submit'])) {
        //initial data from form
        $pool_of = $_POST['pools_of'];
        //js majd ideadja
        $number_of_pools = ceil($number_of_fencers/$pool_of);


        //SORTING OOGA BOOGA
        $objects = new ObjSorter($json_table,'classement');
        $sorted_fencers = $objects->sorted;

        //I N I T I A T E   S O R O L A S !
        $array_of_pools = sorolas($number_of_pools,$pool_of,$sorted_fencers);

        $json_string = json_encode($array_of_pools);
        //set up new row for pools
        $qry_new_row = "INSERT INTO `pools` (`assoc_comp_id`, `data`, `pool_of`) VALUES ('$comp_id', '$json_string', '$pool_of')";
        if ($do_new_row = mysqli_query($connection, $qry_new_row)) {
            header("Location: ../php/pools_config.php?comp_id=$comp_id");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pools of <?php echo $comp_name ?></title>
    <link rel="stylesheet" href="../css/mainstyle.min.css">
    <link rel="stylesheet" href="../css/basestyle.min.css">
</head>
<body>
    <!-- header -->
    <div id="flexbox_container">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <div class="page_content_flex">
            <div id="title_stripe">
                <p class="page_title">Generate Pools</p>
                <div class="stripe_button_wrapper">
                    <button name="submit" form="generate_pools" class="stripe_button primary" type="submit" shortcut="SHIFT+G">
                        <p>Generate Pools</p>
                        <img src="../assets/icons/save-black-18dp.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="basic_information_wrapper" class="db_panel form_page_flex">
                    <div class="db_panel_title_stripe">
                        <img src="../assets/icons/build-black-18dp.svg">
                        <p>Set propeties of Pools</p>
                    </div>
                    <div class="db_panel_main">

                    <form id="generate_pools" action="../php/pools_generate.php?comp_id=<?php echo $comp_id ?>" class="form_wrapper" method="POST">
                        <div>
                            <div>
                                <label for="starting_time">STRIVE FOR</label>
                                <div class="option_container">
                                    <input type="text" class="hidden" id="fencer_quantity" value="<?php echo $number_of_fencers ?>">

                                    <input type="radio" class="option_button" name="pools_of" id="7" value="7"/>
                                    <label for="7" class="complex">Pools of 7 <p id="p_7"></p></label>

                                    <input type="radio" class="option_button" name="pools_of" id="6" value="6"/>
                                    <label for="6" class="complex">Pools of 6 <p id="p_6"></p></label>

                                    <input type="radio" class="option_button" name="pools_of" id="5" value="5"/>
                                    <label for="5" class="complex">Pools of 5 <p id="p_5"></p></label>

                                    <input type="radio" class="option_button" name="pools_of" id="4" value="4"/>
                                    <label for="4" class="complex">Pools of 4 <p id="p_4"></p></label>

                                </div>
                            </div>
                            <div>
                                <label for="interval_of_match">NUMBER OF QUALIFIERS AFTER POOLS</label>
                                <input type="number" placeholder="#" class="number_input centered">
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="pistes_type">STATISTICS</label>
                                <table class="pools_stat_table">
                                    <thead>
                                        <th>Percent</th>
                                        <th>Number of Fencers</th>
                                    </thead>
                                    <tr>
                                        <td>All</td>
                                        <td><?php echo $number_of_fencers ?></td>
                                    <tr>
                                    <tr>
                                        <td>80%</td>
                                        <td><?php echo $number_of_fencers * 0.8?></td>
                                    <tr>
                                    <tr>
                                        <td>70%</td>
                                        <td><?php echo $number_of_fencers * 0.7?></td>
                                    <tr>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/main.js"></script>
<script src="../js/list.js"></script>
<script src="../js/pools.js"></script>
<script src="../js/overlay_panel.js"></script>
<script src="../js/generate_pools.js"></script>
</html>