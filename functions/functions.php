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

function existUsername ($pers_username) {
    global $DB;

    $sql = "SELECT count(*)
		FROM Person
		WHERE pers_username = '$pers_username'";

    if ($queryResult=$DB->query($sql)) {

        $countResult = $queryResult->fetch_row();

        if (!empty($countResult)) {
            if ($countResult[0] > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return -1;
        }
    }
}

function register ($pers_firstname, $pers_lastname, $pers_email, $pers_photo, $pers_username, $pers_password) {
    global $DB;

    $sql = "LOCK TABLES Person WRITE;";
			
    if($DB->query($sql) === true){
        
        echo "Table Person Locked<br>";
        
        $sql = "INSERT INTO Person (pers_firstname, pers_lastname, pers_email, pers_photo, pers_username, pers_password)
            VALUES ('$pers_firstname', '$pers_lastname', '$pers_email', '$pers_photo', '$pers_username', '$pers_password')";

        if($DB->query($sql) === true){
        
            echo "New Person inserted<br>";
            
        }
        
        $sql = "UNLOCK TABLES;";
    
        if($DB->query($sql) === true){
            echo "Table Person unlocked<br>";
        } else {
            echo"ERREUR, problème rencontré lors du dés-verrouillage de la table<br/> Réponce de la base de donnée : ";
            echo $DB->error;
        }
    } else {
        echo"ERREUR, problème rencontré lors du verrouillage des tables<br/> Réponce de la base de donnée : ";
        echo $DB->error;
    }
}

?>