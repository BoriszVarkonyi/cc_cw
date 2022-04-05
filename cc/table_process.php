<?php
include "includes/functions.php";
include "includes/db.php";
include 'includes/sortfunction.php';
ob_start();

$comp_id = $_GET['comp_id'];


$qry_get_table = "SELECT * FROM tables WHERE ass_comp_id = $comp_id";
$qry_get_table_do = mysqli_query($connection, $qry_get_table);

if ($row = mysqli_fetch_assoc($qry_get_table_do)) {

	$out_table = json_decode($row["data"]);
}

$qry_check_row = "SELECT data FROM competitors WHERE assoc_comp_id = '$comp_id'";
$do_check_row = mysqli_query($connection, $qry_check_row);
if ($row = mysqli_fetch_assoc($do_check_row)) {
	$json_string = $row['data'];
	$json_table = json_decode($json_string);
}

$final_rank_id_list = [];

$startTable = "t_1";

//set winner

$winnerid = "1";

array_push($final_rank_id_list, $out_table->$startTable->m_1->$winnerid->id);

//set second

$actualTable = "t_2";

foreach ($out_table->$actualTable->m_1 as $key => $value) {
	if ($key == "referees" || $key == "pistetime") {
		continue;
	}
	if (!in_array($out_table->$actualTable->m_1->$key->id, $final_rank_id_list)) {

		array_push($final_rank_id_list, $out_table->$actualTable->m_1->$key->id);
	}
}

//others if there is no fencing for 3rd place

$actualTable = "t_4";

while (isset($out_table->$actualTable)) {

	$eliminated_ids_array = [];

	foreach ($out_table->$actualTable as $matchkey => $matches) {
		foreach ($matches as $name => $data) {
			if ($name == "referees" || $name == "pistetime") {
				continue;
			}
			if (!in_array($out_table->$actualTable->$matchkey->$name->id, $final_rank_id_list)) {

				foreach ($json_table as $value) {

					if ($value->id == $out_table->$actualTable->$matchkey->$name->id) {

						$fencerobj = new stdClass;

						$fencerobj->id = $out_table->$actualTable->$matchkey->$name->id;
						$fencerobj->rank = $value->temp_rank;

						array_push($eliminated_ids_array, $fencerobj);
					}
				}
			}
		}
	}

	print_r($eliminated_ids_array);

	$objects = new ObjSorter($eliminated_ids_array, 'rank');

	$objects_array  = $objects->sorted;

	print_r($objects_array);

	foreach ($objects_array as $obj) {
		array_push($final_rank_id_list, $obj->id);
	}

	$actualTable = "t_" . ltrim($actualTable, "t_") * 2;
}
print_r($final_rank_id_list);

$placecounter = 1;

foreach ($final_rank_id_list as $ids) {
	foreach ($json_table as $key => $value) {
		if ($value->id == $ids) {
			$json_table[$key]->final_rank = $placecounter;
		}
	}
	$placecounter++;
}

$leftover = [];

foreach ($json_table as $key => $value) {

	if ($value->final_rank == "") {

		$fencerobj = new stdClass;

		$fencerobj->id = $value->id;
		$fencerobj->rank = $value->temp_rank;

		array_push($leftover, $fencerobj);
	}
}

$objects = new ObjSorter($leftover, 'rank');

$objects_array = $objects->sorted;

$rankpos = count($final_rank_id_list) + 1;

foreach ($objects_array as $key => $value) {
	foreach ($json_table as $fencernum => $fencer) {

		if ($fencer->id == $value->id) {

			$json_table[$fencernum]->final_rank = $rankpos;

		}

	}

	$rankpos++;

}

print_r($json_table);


//	  ONLY IF NO FENCING FOR 3RD PLACE
//--------------------------------------------
foreach ($json_table as $key => $value) {
	if ($value->final_rank == 4) {
		$json_table[$key]->final_rank = 3;
	}
}
//--------------------------------------------

$table_upload = json_encode($json_table, JSON_UNESCAPED_UNICODE);

$qry_upload_table = "UPDATE competitors SET data = '$table_upload' WHERE assoc_comp_id = $comp_id";
$qry_upload_table_do = mysqli_query($connection, $qry_upload_table);

if (!$qry_upload_table_do) {
	echo mysqli_error($connection);
}

header("Location: overview.php?comp_id=$comp_id");
