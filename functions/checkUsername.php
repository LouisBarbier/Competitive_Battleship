<?php

include("db.php");

// phpinfo();

$json = json_decode(file_get_contents('php://input'), true);
// $json = array("username" => "test");

$data = array("result" => array());

$sql = "SELECT count(*)
		FROM Person
		WHERE pers_username = '" . $json['username'] . "'";

// echo $sql;

if ($queryResult=$DB->query($sql)) {

    $countResult = $queryResult->fetch_row();

    if (!empty($countResult)) {
        if ($countResult[0] > 0) {
            $data["result"]["valid"] = "0";
        } else {
            $data["result"]["valid"] = "1";
        }
    } else {
        $data["result"]["valid"] = "1";
    }
}

$DB->close();

header("Content-Type: application/json");
echo json_encode($data);

?>