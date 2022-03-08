<?php
    //include dependencies
    $comp_id = $_GET['comp_id'];
    include "../includes/functions.php";
    include "../includes/db.php";
    //include "../includes/username_checker.php";

    /* get data from database
     * competitions
     * organiser
     * competitors
     * (referees)
     * pools
     * tables
    */


    //competitions data from database
    $competition_values_array = [];
    $qry_get_comp_data = "SELECT * FROM competitions WHERE comp_id = '$comp_id'";
    $do_get_comp_data = mysqli_query($connection, $qry_get_comp_data);
    if ($row = mysqli_fetch_assoc($do_get_comp_data)) {
        foreach ($row as $key => $value) {
            $competition_values_array[$key] = $value;
        }
        //delete unused data to save memory space
        unset($competition_values_array['comp_equipment']);
        unset($competition_values_array['comp_info']);
    } else {
        //error
        var_dump("Competitions " . mysqli_error($connection));
    }

    //organisers data from database
    $org_id = $competition_values_array['comp_organiser_id'];
    $qry_get_org_data = "SELECT username FROM organisers WHERE id = '$org_id'";
    $do_get_org_data = mysqli_query($connection, $qry_get_org_data);
    if ($row = mysqli_fetch_assoc($do_get_org_data)) {
        $org_username = $row['username']; //need some more values -> database update
    } else {
        //error
        var_dump("organisers " . mysqli_error($connection));
    }

    //competitors data from database
    $qry_get_competitor_data = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
    $do_get_competitor_data = mysqli_query($connection, $qry_get_competitor_data);
    if ($row = mysqli_fetch_assoc($do_get_competitor_data)) {
        $json_string = $row['data'];
        $competitors_table = json_decode($json_string);
    } else {
        //error
        var_dump("competitors " . mysqli_error($connection));
    }

    //referees data from database
    //might need some changes cant get xml with arbitres 07/12/2021
    $qry_get_ref_data = "SELECT data FROM referees WHERE assoc_comp_id = '$comp_id'";
    $do_get_ref_data = mysqli_query($connection, $qry_get_ref_data);
    if ($row = mysqli_fetch_assoc($do_get_ref_data)) {
        $json_string = $row['data'];
        $referee_table = json_decode($json_string);
    } else {
        //error
        var_dump("referees " . mysqli_error($connection));
    }

    //pools data from database
    $qry_get_pools_data = "SELECT * FROM pools WHERE assoc_comp_id = '$comp_id'";
    $do_get_pools_data = mysqli_query($connection, $qry_get_pools_data);
    if ($row = mysqli_fetch_assoc($do_get_pools_data)) {
        $fencer_string = $row['fencers'];
        $matches_string = $row['matches'];

        $matches_table = json_decode($matches_string);
        $fencer_table = json_decode($fencer_string);

        $pool_of = $row['pool_of'];
        $sort_by = $row['sort_by_club'] ? "club" : "nation";
    } else {
        //error
        var_dump("pools " . mysqli_error($connection));
    }

    //table data from database
    $qry_get_tables_data = "SELECT * FROM tables WHERE ass_comp_id = '$comp_id'";
    $do_get_tables_data = mysqli_query($connection, $qry_get_tables_data);
    if ($row = mysqli_fetch_assoc($do_get_tables_data)) {
        $table_type = $row['type'];
        $table_string = $row['data'];
        $table_table = json_decode($table_string);
    } else {
        //error
        var_dump("tables " . mysqli_error($connection));
    }



    /*                    form xml                       */


    //get base root name
    /*if ($competition_values_array['is_individual']) {
        $root_name = "CompetitionIndividuelle";
    } else {
        $root_name = "CompetitionEquipe";
    }*/
    $root_name = "CompetitionEquipe";
    //form document  \version, \encoding
    $set_version = '1.0';
    $set_encoding = 'iso-8859-1';
    $xml_document = new DOMDocument($set_version, $set_encoding);
    $xml_document -> formatOutput = true;

    //form root element
    $root_title = $xml_document -> createElement($root_name, "");
    $xml_document->appendChild($root_title);
    //set attributes for root elemetn
    /*
    $root -> setAttribute('Championnat', $competition_values_array['comp_host']);
    $root -> setAttribute('ID', $competition_values_array['comp_id']);
    $root -> setAttribute('NbDePoules', count($fencer_table));
    $root -> setAttribute('PhaseSuivanteDesQualifies', "");
    */

        //vadészok wrapper
        $tireurs_node_title = $xml_document -> createElement('Tireurs');
        //append
        $root_title->appendChild($tireurs_node_title);

            //make vadász nodes
                foreach ($competitors_table as $fencer_obj) {
                    $new_tireur_title = $xml_document->createElement('Tireur', "");
                    //set attributes


                    $tireurs_node_title -> appendChild($new_tireur_title);
                }


        //döntőbíró wrapper
        $arbitres_node_title = $xml_document->createElement('Arbitres');
        //append
        $root_title -> appendChild($arbitres_node_title);

            //make bíró nodes
                foreach ($referee_table as $ref_obj) {
                    $new_arbitre_title = $xml_document->createElement('Arbitre', "");
                    //set attributes


                    $arbitres_node_title -> appendChild($new_arbitre_title);
                }


        //Phases wrapper
        $phases_node_title = $xml_document -> createElement('Phases');
        //append
        $root_title -> appendChild($phases_node_title);


            //TourDePoules wrapper
            $tdp_node_title = $xml_document -> createElement('TourDePoules');
            //append
            $phases_node_title -> appendChild($tdp_node_title);
                //list all tiruer
                foreach ($competitors_table as $fencer_obj) {
                    $new_tireur_title = $xml_document->createElement('Tireur', "");
                    //set attributes


                    $tdp_node_title -> appendChild($new_tireur_title);
                }
                //list all arbitre
                foreach ($referee_table as $ref_obj) {
                    $new_arbitre_title = $xml_document->createElement('Arbitre', "");
                    //set attributes


                    $tdp_node_title -> appendChild($new_arbitre_title);
                }

                //list all pools
                foreach ($fencer_table as $pool_obj) {
                    if (!$pool_obj) continue;
                    $new_poule_title = $xml_document -> createElement('Poule', "");
                    //set attributes


                    $tdp_node_title -> appendChild($new_poule_title);
                }


            //TourDeTableaux wrapper
            $tdt_node_title = $xml_document->createElement('TourDeTableaux');
            //append
            $phases_node_title->appendChild($tdt_node_title);
                //list all tiruer
                foreach ($competitors_table as $fencer_obj) {
                    $new_tireur_title = $xml_document->createElement('Tireur', "");
                    //set attributes


                    $tdt_node_title -> appendChild($new_tireur_title);
                }


                //SuiteDeTableaux wrapper
                $sdt_node_title = $xml_document->createElement('SuiteDeTableaux');
                //append
                $tdt_node_title->appendChild($sdt_node_title);
                    //list all Tableauxs
                    foreach ($table_table as $key => $table_obj) {
                        $title = "Tableau_of_" . substr($key, 2);
                        $new_table_title = $xml_document->createElement("Tableau", '');
                        //set attributes


                        $sdt_node_title -> appendChild($new_table_title);
                            //list matches
                            foreach ($table_obj as $m_key => $match_obj) {
                                $match_node_title = $xml_document -> createElement('Match');
                                //set attributes


                                $new_table_title -> appendChild($match_node_title);
                                    //list tireurs in match
                                    foreach ($match_obj as $key_fencer => $fencer_obj) {
                                        if ($key_fencer != "referees" && $key_fencer != "pistetime") {
                                            $new_match_tireur = $xml_document -> createElement('Tireur');
                                            //set attributes

                                            $match_node_title -> appendChild($new_match_tireur);
                                        }
                                    }
                            }

                    }

    echo "<xmp>".$xml_document->saveXML()."</xmp>";

?>