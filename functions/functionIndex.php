<?php

// phpinfo();

function isValid ($pers_id, $pers_password) {
    include("db.php");

    $sql = "SELECT COUNT(*)
            FROM Person
            WHERE pers_id = '$pers_id' AND pers_password = '$pers_password'";

    // echo $sql;

    $connected = 0;

    if ($queryResult=$DB->query($sql)) {

        $nb_correct = $queryResult->fetch_row()[0];

        if ($nb_correct === 1) {
            $connected = 1;
        } else {
            $connected = 0;
        }
    }

    $DB->close();

    return $connected;
}

function getNbOnline () {
    include("db.php");

    $fifteenMinAgo = date_sub(new DateTime('now'), new DateInterval('PT15M'));

    $sql = "SELECT COUNT(*)
        FROM Person
        WHERE pers_lastonline > '" . date_format($fifteenMinAgo, "Y-m-d H:i:s") . "'";

    // echo $sql;

    if ($queryResult=$DB->query($sql)) {
        $nb_online = $queryResult->fetch_row()[0];
    }

    $DB->close();

    return $nb_online;
}



?>