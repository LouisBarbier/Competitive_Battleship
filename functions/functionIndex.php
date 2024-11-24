<?php


include 'db.php';

// phpinfo();

function isValid ($pers_id, $pers_password) {
    global $DB;

    $sql = "SELECT COUNT(*)
            FROM Person
            WHERE pers_id = '$pers_id' AND pers_password = '$pers_password'";

    // echo $sql;

    $connected = 0;

    if ($queryResult=$DB->query($sql)) {

        $nb_correct = $queryResult->fetch_row()[0];

        // echo "nb_correct = $nb_correct";

        if ($nb_correct == 1) {
            $connected = 1;
        } else {
            $connected = 0;
        }
    }

    return $connected;
}

function getNbOnline () {
    global $DB;

    $fifteenMinAgo = date_sub(new DateTime('now'), new DateInterval('PT15M'));

    $sql = "SELECT COUNT(*)
        FROM Person
        WHERE pers_lastonline > '" . date_format($fifteenMinAgo, "Y-m-d H:i:s") . "'";

    // echo $sql;

    if ($queryResult=$DB->query($sql)) {
        $nb_online = $queryResult->fetch_row()[0];
    }

    return $nb_online;
}

?>