<?php

include("functions.php");

// phpinfo();

$json = json_decode(file_get_contents('php://input'), true);

$data = array("results" => array());

$sql_result = load_more(2, $json['offset'], $json['conditions'], $json['nbbattle']);

// print_r($rqt);
if ($sql_result) {
	foreach ($sql_result as $row) {
		$pers_id = $row['pers_id'];
		$pers_username = $row['pers_username'];
		$pers_firstname = $row['pers_firstname'];
		$pers_lastname = $row['pers_lastname'];
		$pers_email = $row['pers_email'];
		$pers_datecre = $row['pers_datecre'];
		$pers_photo = $row['pers_photo'];
		$pers_nbbattle = $row['pers_nbbattle'];
		$pers_score = $row['pers_score'];
		
		$data["results"][count($data["results"])] = array(
			"pers_id" => "$pers_id",
			"pers_username" => "$pers_username",
			"pers_firstname" => "$pers_firstname",
			"pers_lastname" => "$pers_lastname",
			"pers_email" => "$pers_email",
			"pers_datecre" => "$pers_datecre",
			"pers_photo" => "$pers_photo",
			"pers_nbbattle" => "$pers_nbbattle",
			"pers_score" => "$pers_score"
		);
	}
}

header("Content-Type: application/json");
echo json_encode($data);

?>