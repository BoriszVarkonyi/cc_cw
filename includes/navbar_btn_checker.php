<?php

    class navbar {

        function __construct($connection, $comp_id) {
            $array_names = ['overview','table','temporary_ranking','pools','competitors','call_room','registration','weapon_control','announcements','basic_information','information_for_fencers','invitation','technicians','referees','pistes','formula','ranking','manage_entries'];

            //get competition state
            $qry_get_state = "SELECT comp_status FROM competitions WHERE comp_id = '$comp_id'";
            $do_get_state = mysqli_query($connection, $qry_get_state);
            if ($row = mysqli_fetch_assoc($do_get_state)) {
                $state = $row['comp_status'];
            }

            foreach ($array_names as $name) {
                if ($name == 'weapon_control') {
                    $button_obj = new wc_button($state, $comp_id, $connection);
                } else if ($name == 'pools') {
                    $button_obj = new pool_button($state, $comp_id, $connection);
                } else if ($name == 'call_room') {
                    $button_obj = new call_room_button($state, $comp_id, $connection);
                } else {
                    $button_obj = new button($name, $state, $comp_id, $connection);
                }

                $this -> {$name} = $button_obj;
            }
        }
    }

    class button {
        public $href = "";
        public $class = "";
        protected $name;
        protected $state;
        protected $path_beg = "../php/";
        protected $path_end;
        protected $role;
        protected $comp_id;
        public $conn;

        protected function setComp_id($comp_id) {
            $this -> path_end = ".php?comp_id=" . $comp_id;
            $this -> comp_id = $comp_id;
        }

        public function __construct($name, $state, $comp_id, $connection) {
            $this -> conn = $connection;
            $this -> state = $state;
            $this -> name = $name;
            $this -> setComp_id($comp_id);

            $this -> determineRole();
        }

        protected function determineRole() {//when there will be technician login needs to be redone!
            //$this -> role = $_SESSION['role'];
            $this -> role = 'organiser';
            if ($this -> role == 'organiser') {
                $this -> setByState();
            } else {
                $this -> setByTechnician();
            }
        }

        protected function setByState() {
            switch ($this -> state) {
                case 1:
                    $disabled_buttons = ["temporary_ranking", "competitors", "pools", "table", "overview", "manage_entries"];
                break;
                case 2:
                    $disabled_buttons = ["basic_information", "information_for_fencers", "ranking"];
                break;
                case 3:
                    $disabled_buttons = ["general", "basic_information", "info_for_fencers", "timetable", "invitation", "ranking", "manage_entries"];
                break;
            }
            $this -> setHrefClass($disabled_buttons);
        }

        protected function setByTechnician() {
            switch ($this -> role) {
                case 1: //semi
                    $disabled_buttons = ['call_room','registration','weapon_control','announcements','basic_information','information_for_fencers','invitation','technicians','referees','pistes','formula','ranking','manage_entries'];
                break;
                case 2: //DT
                    $disabled_buttons = ['call_room','registration','weapon_control','announcements','basic_information','information_for_fencers','invitation','technicians','referees','pistes','formula','ranking','manage_entries'];
                break;
                case 3: // weapon control
                    $disabled_buttons = ['overview','table','temporary_ranking','pools','competitors','call_room','registration','announcements','basic_information','information_for_fencers','invitation','technicians','referees','pistes','formula','ranking','manage_entries'];
                break;
                case 4: //registration
                    $disabled_buttons = ['overview','table','temporary_ranking','pools','competitors','call_room','weapon_control','announcements','basic_information','information_for_fencers','invitation','technicians','referees','pistes','formula','ranking','manage_entries'];
                break;

                $this -> setHrefClass($disabled_buttons);
            }
        }

        protected function setHrefClass($disabled_buttons) {
            if (in_array($this -> name, $disabled_buttons)) {
                //class & href if disabled
                $this -> class = "disabled";
            } else {
                //class & href if active
                $this -> href = $this -> path_beg . $this -> name . $this -> path_end;
            }
        }
    }

    class wc_button extends button {

        public function __construct($state, $comp_id, $connection) {
            $this -> name = "weapon_control";
            $this -> state = $state;
            $this -> conn = $connection;
            $this -> setComp_id($comp_id);

            $this -> determineRole();

            if ($this -> href != "") {
                //get weapon_control
                $comp_id = $this -> comp_id;
                $qry_get_data = "SELECT `comp_wc_type` FROM `competitions` WHERE `comp_id` = '$comp_id'";
                $do_get_data = mysqli_query( $this -> conn, $qry_get_data);

                if ($row = mysqli_fetch_assoc($do_get_data)) {
                    $wc_type = $row['comp_wc_type'];

                    $this -> setWeaponControl($wc_type);
                }
            }
        }

        protected function setWeaponControl($wc_type) {
            switch ($wc_type) {
                case 0://no wc
                    $this -> class = 'hidden';
                break;
                case 1://immidiate
                    $this -> href = $this -> path_beg . "weapon_control_immediate" . $this -> path_end;
                break;
                case 2://administrative
                    $this -> href = $this -> path_beg . "weapon_control_administrated" . $this -> path_end;
                break;
            }
        }
    }

    class pool_button extends button {

        public function __construct($state, $comp_id, $connection) {
            $this -> name = "pools";
            $this -> state = $state;
            $this -> conn = $connection;
            $this -> setComp_id($comp_id);

            $this -> determineRole();

            if ($this -> href != "") {
                $comp_id = $this -> comp_id;
                $qry_get_pools = "SELECT matches FROM pools WHERE assoc_comp_id = '$comp_id'";
                if ($do_get_pools = mysqli_query($this -> conn, $qry_get_pools)) {
                    if ($row = mysqli_fetch_assoc($do_get_pools)) {
                        $matches_string = $row['matches'];

                        if ($matches_string == NULL) { //pools config;
                            $pool_phase = 1;
                        } else { //pools view;
                            $pool_phase = 2;
                        }
                        //phase 3 a pool done
                    } else {
                        $pool_phase = 0;
                    }
                } else { // pools generate;
                    $pool_phase = 0;
                }

                $this -> setPoolPhase($pool_phase);
            }
        }

        public function setPoolPhase($pool_phase) {
            switch ($pool_phase) {
                case 0://pools_generate
                    $this -> href = $this -> path_beg . "pools_generate" . $this -> path_end;
                    break;
                case 1://pools_config
                    $this -> href = $this -> path_beg . "pools_config" . $this -> path_end;
                    break;
                case 2://pools_view
                    $this -> href = $this -> path_beg . "pools_view" . $this -> path_end;
                    break;
                case 3://pools done

                break;
            }
        }
    }

    class call_room_button extends button {

        public function __construct($state, $comp_id, $connection) {
            $this -> name = "call_room";
            $this -> state = $state;
            $this -> conn = $connection;
            $this -> setComp_id($comp_id);

            $this -> determineRole();

            $comp_id = $this -> comp_id;
            $qry_get_call_room = "SELECT data FROM formulas WHERE assoc_comp_id = '$comp_id'";
            $do_get_call_room = mysqli_query($this -> conn, $qry_get_call_room);

            if ($row = mysqli_fetch_assoc($do_get_call_room)) {
                $formula_string = $row['data'];
                $formula_json = json_decode($formula_string);

                $call_room = $formula_json -> callRoom;

                $this -> setCallRoom($call_room);
            } else {
                echo mysqli_error($this -> conn);
            }
        }

        protected function setCallRoom($call_room) {
            if ($call_room) {
                $this -> href = $this -> path_beg . 'call_room' . $this -> path_end;
            } else {
                $this -> class = "hidden";
            }
        }
    }

    $navbar = new navbar($connection, $comp_id);


    // foreach ($navbar as $name => $buttons) {
    //     echo $name . "<br>";
    //     echo $buttons -> href . "<br>";
    //     echo $buttons -> class . "<br>";
    //     echo "<br>";
    // }
?>
