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

function load_css_variables ($dark_mode) {
    if ($dark_mode) {
        echo ":root {
            --body-bg-color: #3B3838;
            --body-bg-color-hover: #404040;
            --nav-bg-color: #787C7E;
            --bd-color: white;
            --tx-color: white;
            --tx-color-inv: black;
            --darker: rgba(255, 255, 255, 0.5);
            --small-darker: rgba(255, 255, 255, 0.1);
        }";
    } else {
        echo ":root {
            --body-bg-color: #e3e3e1;
            --body-bg-color-hover: #cacaca;
            --nav-bg-color: #787C7E;
            --bd-color: black;
            --tx-color: black;
            --tx-color-inv: white;
            --darker: rgba(0, 0, 0, 0.5);
            --small-darker: rgba(0, 0, 0, 0.1);
        }";
    }
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

function existEmail ($pers_email) {
    global $DB;

    $sql = "SELECT count(*)
		FROM Person
		WHERE pers_email = '$pers_email'";

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

function register ($pers_firstname, $pers_lastname, $pers_email, $pers_username, $pers_password, $pers_photo = null) {
    global $DB;

    if ($pers_photo === null) {
        $pers_photo_sql = "NULL";
    } else {
        $pers_photo_sql = "'$pers_photo'";
    }

    $sql = "LOCK TABLES Person WRITE;";
			
    if($DB->query($sql) === true){
        
        // echo "Table Person Locked<br>";
        
        $sql = "INSERT INTO Person (pers_firstname, pers_lastname, pers_email, pers_username, pers_password, pers_photo)
            VALUES ('$pers_firstname', '$pers_lastname', '$pers_email', '$pers_username', '$pers_password', $pers_photo_sql)";

        if($DB->query($sql) === true){
        
            // echo "New Person inserted<br>";

            $pers_id = mysqli_insert_id($DB);
            
        } else {
            $pers_id = -1; // don't return -1; , We still have to unlock the table
        }
        
        $sql = "UNLOCK TABLES;";
    
        if($DB->query($sql) == true){
            // echo "Table Person unlocked<br>";
        } else {
            echo"ERREUR, problème rencontré lors du dés-verrouillage de la table<br/> Réponce de la base de donnée : ";
            echo $DB->error;
        }
    } else {
        echo"ERREUR, problème rencontré lors du verrouillage des tables<br/> Réponce de la base de donnée : ";
        echo $DB->error;

        return -1;
    }

    return $pers_id;
}

function update_profile_picture ($pers_id, $pers_photo = null) {
    global $DB;

    if ($pers_photo === null) {
        $pers_photo_sql = "NULL";
    } else {
        $pers_photo_sql = "'$pers_photo'";
    }

    $sql = "UPDATE Person SET pers_photo = $pers_photo_sql WHERE pers_id = $pers_id";

    $DB->query($sql);
}

function load_more ($quantity, $offset, $conditions=array(), $condition_nbbattle=0) {
    global $DB;

    if (count($conditions) > 0) {
        $conditions_str = "WHERE " . implode(" AND ", $conditions);
    } else {
        $conditions_str = "";
    }

    if ($condition_nbbattle > 0) {
        $condition_nbbattle_str = "HAVING pers_nbbattle >= $condition_nbbattle";
    } else {
        $condition_nbbattle_str = "";
    }

    $sql = "SELECT pers_id, pers_username, pers_firstname, pers_lastname, pers_email, pers_datecre, pers_photo, count(bat_id) AS pers_nbbattle, pers_score
		FROM Person
            LEFT JOIN Battle ON (pers_id = bat_player1 OR pers_id = bat_player2)
        $conditions_str
		GROUP BY pers_id
        $condition_nbbattle_str
		ORDER BY pers_id DESC
		LIMIT $quantity OFFSET $offset";

    return $DB->query($sql);
}

?>