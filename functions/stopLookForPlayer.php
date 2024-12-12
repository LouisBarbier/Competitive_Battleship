<?php

include("db.php");

// phpinfo();

$json = json_decode(file_get_contents('php://input'), true);

// We set the user pers_lastmatchmaking to NULL so we know they are not looking for an opponant anymore
$sql = "UPDATE Person SET pers_lastmatchmaking = NULL WHERE pers_id = " . $json['id'];
    
$DB->query($sql);

$DB->close();

?>