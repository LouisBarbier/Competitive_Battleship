<?php

include("db.php");

date_default_timezone_set('US/Eastern');

// phpinfo();

$json = json_decode(file_get_contents('php://input'), true);
// $json = array("id" => "12", "rank_min" => "0", "rank_max" => "10");

$id = $json['id'];

$data = array("result" => array());

$seconds_ago = date_format(date_sub(new DateTime('now'), new DateInterval("PT30S")), "Y-m-d H:i:s");

$search = true;

$sql = "SELECT pers_lastmatchmaking FROM Person WHERE pers_id = $id";

if ($queryResult=$DB->query($sql)) {

    $pers_lastmatchmaking = $queryResult->fetch_row()[0];

    if ($pers_lastmatchmaking == null) {
        $sql = "SELECT bat_id FROM Battle
            WHERE (bat_player1 = $id OR bat_player2 = $id) AND bat_start >= '$seconds_ago'
            ORDER BY bat_start DESC LIMIT 1";

        if ($queryResult=$DB->query($sql)) {
            $bat_id = $queryResult->fetch_row();

            if (!empty($bat_id)) {
                $data["result"]["found"] = "1";
                $data["result"]["battle"] = "".$bat_id[0];

                $search = false;
            }
        }
    }
}

if ($search) {
    $conditions = "pers_id != $id AND pers_lastmatchmaking >= '$seconds_ago'";

    if (isset($json['rank_min']) && $json['rank_min'] > 0 ) {
        $conditions .= " AND pers_score >= " . $json['rank_min'];
    }
    
    if (isset($json['rank_max'])) {
        $conditions .= " AND pers_score <= " . $json['rank_max'];
    }
    
    $sql = "SELECT pers_id
            FROM Person
            WHERE $conditions
            ORDER BY pers_lastmatchmaking ASC
            LIMIT 1";
    
    $data["sql"] = $sql;
    
    if ($queryResult=$DB->query($sql)) {
    
        $opponant = $queryResult->fetch_assoc();
    
        if (!empty($opponant)) {

            $sql = "LOCK TABLES Battle WRITE, Person WRITE;";
                
            if($DB->query($sql) === true){
                
                // Tables Battle and Person Locked
            
                $sql = "UPDATE Person SET pers_lastmatchmaking = NULL WHERE pers_id = $id OR pers_id = " . $opponant["pers_id"];
        
                $DB->query($sql);
                
                $sql = "INSERT INTO Battle (bat_player1, bat_player2, bat_turn)
                    VALUES ($id, " . $opponant["pers_id"] . ", " . random_int(1, 2) . ")";
    
                if($DB->query($sql) === true){
                
                    // New Battle inserted
                    
                    $data["result"]["battle"] = mysqli_insert_id($DB);
                    
                } else {
                    $data["result"]["battle"] = -1;
                }
                
                $sql = "UNLOCK TABLES;";
            
                if($DB->query($sql) == true){
                    // Table Battle unlocked
                } else {
                    echo $DB->error;
                }
            } else {
                echo $DB->error;
    
                $data["result"]["battle"] = -1;
            }
    
            $data["result"]["found"] = "1";
        } else {
            $sql = "UPDATE Person SET pers_lastmatchmaking = '" . date_format(new DateTime(), "Y-m-d H:i:s") . "' WHERE pers_id = $id";
    
            $DB->query($sql);
    
            $data["result"]["found"] = "0";
        }
    }
}

$DB->close();

header("Content-Type: application/json");
echo json_encode($data);

?>