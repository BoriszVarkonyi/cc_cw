<?php

    //include dependencies
    $comp_id = $_GET['comp_id'];
    include "../../includes/functions.php";
    include "../../includes/db.php";
    include "../../includes/username_checker.php";

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
    if ($competition_values_array['is_individual']) {
        $root_name = "CompetitionIndividuelle";
    } else {
        $root_name = "CompetitionEquipe";
    }

    //form document  \version, \encoding
    $set_version = '1.0';
    $set_encoding = 'iso-8859-1';
    $xml_document = new DOMDocument($set_version, $set_encoding);
    $xml_document -> formatOutput = true;

    //form root element
    $Competition = $xml_document -> createElement($root_name, "");
    //set attributes for root elemetn
    $Competition -> setAttribute('Championnat', $competition_values_array['comp_host']);
    $Competition -> setAttribute('ID', $competition_values_array['comp_id']);
    $Competition -> setAttribute('NbDePoules', count($fencer_table));
    $Competition -> setAttribute('PhaseSuivanteDesQualifies', "");



    /*
    //header("Content-type: text/xml");
    $xml = new DOMDocument($version = '1.0', $encoding = 'UTF-8');
    $xml->formatOutput = true;
    $element = $xml->createElement("foos");
    $xml->appendChild($element);

    $childElement = $xml->createElement("foo");

    $attribute = $xml->createAttribute("id");
    $attribute->value = "123";

    $childElement -> appendChild($attribute);
    $element->appendChild($childElement);

    echo "<xmp>".$xml->saveXML()."</xmp>";
    */
?>