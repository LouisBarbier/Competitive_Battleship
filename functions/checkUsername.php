<?php

include("functions.php");

// phpinfo();

$json = json_decode(file_get_contents('php://input'), true);
// $json = array("username" => "test");

$data = array("result" => array("exist" => existUsername($json['username'])));

$DB->close();

header("Content-Type: application/json");
echo json_encode($data);

?>