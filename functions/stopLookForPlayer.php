<?php

include("db.php");

// phpinfo();

$json = json_decode(file_get_contents('php://input'), true);

$id = $json['id'];

$sql = "UPDATE Person SET pers_lastmatchmaking = NULL WHERE pers_id = " . $json['id'];
    
$DB->query($sql);

$DB->close();

?>