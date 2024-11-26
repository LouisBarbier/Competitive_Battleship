<?php

include("functions.php");

// phpinfo();

$json = json_decode(file_get_contents('php://input'), true);
// $json = array("email" => "test");

$data = array("result" => array("exist" => existEmail($json['email'])));

$DB->close();

header("Content-Type: application/json");
echo json_encode($data);

?>