<?php

include("db.php");

// phpinfo();

$json = json_decode(file_get_contents('php://input'), true);
// $json = array("id" => "test", "password" => "test");

$data = array("result" => array());

if (str_contains($json['id'], '@')) { // it's an email
    $condition = "pers_email = '" . $json['id'] . "'";
} else { // it's an username
    $condition = "pers_username = '" . $json['id'] . "'";
}

$sql = "SELECT pers_id,pers_password, pers_username, pers_firstname, pers_lastname, pers_email, pers_isadmin, pers_photo, pers_score
		FROM Person
		WHERE $condition AND pers_password = '" . $json['password'] . "'";

// echo $sql;

if ($queryResult=$DB->query($sql)) {

    $person = $queryResult->fetch_assoc();

    if (!empty($person)) {
        
        $data["result"]["person"] = array(
            "pers_id" => "".$person["pers_id"],
            "pers_password" => "".$person["pers_password"],
            "pers_username" => "".$person["pers_username"],
            "pers_firstname" => "".$person["pers_firstname"],
            "pers_lastname" => "".$person["pers_lastname"],
            "pers_email" => "".$person["pers_email"],
            "pers_isadmin" => "".$person["pers_isadmin"],
            "pers_photo" => "".$person["pers_photo"],
            "pers_score" => "".$person["pers_score"]
        );

        $data["result"]["valid"] = "1";
    } else {
        $data["result"]["valid"] = "0";
    }
}

$DB->close();

header("Content-Type: application/json");
echo json_encode($data);

?>