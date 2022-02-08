<?php include "../includes/headerburger.php"; ?>
<?php include "../includes/db.php" ?>
<?php include '../includes/sortfunction.php' ?>
<?php ob_start(); ?>
<?php checkComp($connection); ?>

<?php

    //get formula info
    $qry_get_form = "SELECT data FROM formulas WHERE assoc_comp_id = '$comp_id'";
    $do_get_form = mysqli_query($connection, $qry_get_form);

    if ($row = mysqli_fetch_assoc($do_get_form)) {
        $formula_string = $row['data'];
        $formula_table = json_decode($formula_string);
        $quilifiers_a_p = $formula_table -> qualifiers;
    } else {
        $quilifiers_a_p = "";
    }


    //1. param: hány darab csoport van,
    //2. param: hány személyesek a csoportok,
    //3. param: a versenyzők tömbje (sortolva, versenyzők objectek egy tömbben)
    //4. param: Club alapján vagy nationality alapján sortolja a versenyzőket
    function sorolas($n_pools,int $fencers_in_pools,array $array_of_fencers,$sort_by_club) {

        //determine attribute to sort by
        if ($sort_by_club) {
            $sort_by = "club";
        } else {
            $sort_by = "nation";
        }

        //kicsit szukitett fencer csak a necessery info van benne
        class fencer {
            public $prenom_nom;
            public $id;
            public $c_pos;
            public $r_pos;
            public $nation;
            public $club;

            function __construct(object $fencer_obj){
                $this -> prenom_nom = $fencer_obj->prenom . " " . $fencer_obj->nom;
                $this -> id = $fencer_obj->id;
                $this -> c_pos = $fencer_obj->comp_rank;
                $this -> r_pos = $fencer_obj->classement;
                $this -> nation = $fencer_obj->nation;
                $this -> club = $fencer_obj->club;
            }
        }

        //needs 'fencer' class before!
        //class of pools (fencer inside this)
        class pool{
            public $nationalitys = [];
            public $ref1 = NULL;
            public $ref2 = NULL;
            public $piste = NULL;
            public $time = NULL;

            //function amivel hozzárakjuk a fencereket
            function add_fencer(int $y,object $fencer_obj,$sort_by) {

                $fencer_to_add = new fencer($fencer_obj);

                $this -> {$y} = $fencer_to_add;
                array_push($this -> nationalitys,$fencer_obj -> $sort_by);
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
                        if (array_search($array_of_fencers[$fencer] -> $sort_by,$array_of_pools[$x] -> nationalitys) === FALSE) {

                            //fencer beiras majd fencer +1
                            $array_of_pools[$x] -> add_fencer($y, $array_of_fencers[$fencer],$sort_by);
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
                                    $array_of_pools[$x] -> add_fencer($y, $array_of_fencers[$fencer],$sort_by);
                                    $fencer++;
                                    $forward -> reset();
                                    if ($y % 2 != 0) {// ha y paratlan átlép a másik ágba
                                        $y--;
                                        break;
                                    }
                                } else {
                                    $array_of_pools[$n_pools] -> add_fencer($fencers_in_pools, $array_of_fencers[$fencer],$sort_by);
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
                        if (array_search($array_of_fencers[$fencer] -> $sort_by,$array_of_pools[$x] -> nationalitys)  === FALSE) {

                            //fencer beiras majd fencer +1
                            $array_of_pools[$x] -> add_fencer($y, $array_of_fencers[$fencer],$sort_by);
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
                                    $array_of_pools[$x] -> add_fencer($y, $array_of_fencers[$fencer],$sort_by);
                                    $fencer++;
                                    $forward -> reset();
                                    if ($y % 2 == 0) {// ha y paros átlép a másik ágba
                                        $y--;
                                        break;
                                    }
                                } else {
                                    $array_of_pools[$n_pools] -> add_fencer($fencers_in_pools, $array_of_fencers[$fencer],$sort_by);
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
    $qry_make_pools = "CREATE TABLE `ccdatabase`.`pools` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `assoc_comp_id` INT(11) NOT NULL , `fencers` LONGTEXT NULL DEFAULT NULL , `matches` LONGTEXT NULL DEFAULT NULL ,  `pool_of` INT(1) NOT NULL , `sort_by_club` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    if (!$do_make_pools = mysqli_query($connection, $qry_make_pools)) {
        echo mysqli_error($connection);
    }


    //_________CSAK NEKED BORISZ____________//
    $number_of_fencers = count($json_table);//
    //______________________________________//

    if (isset($_POST['submit'])) {
        //initial data from form
        $pool_of = $_POST['pools_of'];
        $sort_by = $_POST['sort_by'];
        if ($sort_by == "club") {
            $sort_by_club = true;
        } else {
            $sort_by_club = false;
        }
        //js majd ideadja
        $array_p = explode(";", $pool_of);
        $pool_of = $array_p[0];
        $number_of_pools = $array_p[1];

        //SORTING OOGA BOOGA
        $objects = new ObjSorter($json_table,'classement');
        $sorted_fencers = $objects->sorted;

        //make set cp
        $cp_counter = 1;
        foreach ($sorted_fencers as $fencer_obj) {
            $fencer_obj -> comp_rank = $cp_counter;
            $cp_counter++;
        }

        //I N I T I A T E   S O R O L A S !
        $array_of_pools = sorolas($number_of_pools,$pool_of,$sorted_fencers,$sort_by_club);

        $json_string = json_encode($array_of_pools, JSON_UNESCAPED_UNICODE);
        //set up new row for pools
        $qry_new_row = "INSERT INTO `pools` (`assoc_comp_id`, `fencers`, `pool_of`,`sort_by_club`) VALUES ('$comp_id', '$json_string', '$pool_of', '$sort_by_club')";
        if ($do_new_row = mysqli_query($connection, $qry_new_row)) {

            $error = false;

        } else {
            $error = true;
        }

        //test for new formula
        $post_qualifiers = $_POST['qualifiers'];
        if ($post_qualifiers != $quilifiers_a_p) {
            //update db with new data
            $formula_table -> qualifiers = $post_qualifiers;

            $formula_string = json_encode($formula_table, JSON_UNESCAPED_UNICODE);

            $qry_update_formula = "UPDATE `formulas` SET `data` = '$formula_string' WHERE assoc_comp_id = '$comp_id'";
            if ($do_update_formula = mysqli_query($connection, $qry_update_formula)) {
                $error = false;
            } else {
                $error = true;
            }
        }

        if ($error) {
            echo "meghalt minden rossz gg";
        } else {
            header("Location: ../cc/pools_config.php?comp_id=$comp_id");
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
    <link rel="stylesheet" href="../css/basestyle.min.css">
    <link rel="stylesheet" href="../css/mainstyle.min.css">
</head>
<body>
    <!-- header -->
    <div id="content_wrapper">
        <?php include "../includes/navbar.php"; ?>
        <!-- navbar -->
        <main>
            <div id="title_stripe">
                <p class="page_title">Generate Pools</p>
                <div class="stripe_button_wrapper">
                    <button name="submit" form="generate_pools" class="stripe_button primary" type="submit" shortcut="SHIFT+G">
                        <p>Generate Pools</p>
                        <img src="../assets/icons/save_black.svg"/>
                    </button>
                </div>
            </div>
            <div id="page_content_panel_main">
                <div id="basic_information_wrapper" class="db_panel form_page_flex">
                    <div class="db_panel_header">
                        <img src="../assets/icons/build_black.svg">
                        <p>Set propeties of Pools</p>
                    </div>
                    <div class="db_panel_main">

                    <form id="generate_pools" action="../cc/pools_generate.php?comp_id=<?php echo $comp_id ?>" class="form_wrapper" method="POST">
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
                                <label for="starting_time">SORT BY</label>
                                <div class="option_container">

                                    <input type="radio" class="option_button" name="sort_by" id="sb_club" value="club" checked/>
                                    <label for="sb_club">Club</label>

                                    <input type="radio" class="option_button" name="sort_by" id="sb_nationality" value="nation"/>
                                    <label for="sb_nationality">Nationality</label>

                                </div>
                            </div>
                            <div>
                                <label for="interval_of_match">NUMBER OF QUALIFIERS AFTER POOLS</label>
                                <input type="number" name="qualifiers" placeholder="#" class="number_input centered" value="<?php echo $quilifiers_a_p ?>">
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="pistes_type">STATISTICS</label>
                                <table class="pools_stat_table">
                                    <thead>
                                        <tr>
                                            <th>Percent</th>
                                            <th>Number of Fencers</th>
                                        </tr>
                                    </thead>
                                    <tbody class="alt">
                                        <tr>
                                            <td>All</td>
                                            <td><?php echo $number_of_fencers ?></td>
                                        </tr>
                                        <tr>
                                            <td>80%</td>
                                            <td><?php echo $number_of_fencers * 0.8?></td>
                                        </tr>
                                        <tr>
                                            <td>70%</td>
                                            <td><?php echo $number_of_fencers * 0.7?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="javascript/cookie_monster.js"></script>
    <script src="javascript/main.js"></script>
    <script src="javascript/list.js"></script>
    <script src="javascript/pools_generate.js"></script>
</body>
</html>