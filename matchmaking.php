<?php

include('./functions/functions.php');

// prevent the user from creating an account if he is already logged in
if (isset($_COOKIE["user"])) {

    $user = json_decode($_COOKIE["user"], true);

    $pers_id = $user['pers_id'];
    $pers_password = $user['pers_password'];

    $connected = isValid($pers_id, $pers_password);
} else {
    $connected = false;
}

// If the user is not connected we refuse the access to this page
if (!$connected) {
    header("Location: index.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchMaking - Competitive Battleship</title>
    <link rel="icon" type="image/svg+xml" href="common/images/competitive_battleship.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        
        <?php

        load_css_variables(isset($_COOKIE["dark_mode"]) && $_COOKIE["dark_mode"] === "1");

        ?>

    </style>
    <link rel="stylesheet" href="./common/battle_styles.css">
    <link rel="stylesheet" href="./matchmaking.css">
</head>
<body>
    <!--Here players will be wait while the game try to get them against the closest player (in term of rank)
    Once a player is found the game will ask them to confirm the battle. Once confirmed the battle will start (they will be both redirected to battle.php).
    -->
    <header class="d-flex flex-wrap justify-content-center">
        <a href="index.php" target="_self" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="common/images/competitive_battleship.svg" alt="Logo" class="bi me-2" width="40" height="40">
            <span class="fs-4">Competitive Battleship</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item">
                
                <?php

                if (isset($_COOKIE["dark_mode"]) && $_COOKIE["dark_mode"] === "1") {
                    echo '<img id="bright_mode" alt="light mode" src="./common/images/heavy-bulb.png">';
                } else {
                    echo '<img id="bright_mode" alt="dark mode" src="./common/images/light-bulb.png">';
                }

                ?>

            </li>
            <li class="nav-item">
                <div class="btn btn-primary">?</div>
            </li>
            <li class="nav-item">
                <?php
                
                if (($user["pers_photo"] !== "") and ($user["pers_photo"] !== null)) {
                    echo '<img class="bi me-2" alt="Your Profile Picture" src="profile_pictures/' . $user["pers_photo"] . '" width="40" height="40">';
                } else {
                    echo '<img class="bi me-2" alt="Your Profile Picture" src="profile_pictures/default.png" width="40" height="40">';
                }

                echo $user["pers_username"];

                ?>
                
            </li>
        </ul>
    </header>

    <main class="container">

        <?php
        
        echo '<input id="pers_id" type="hidden" value="' . $user["pers_id"] . '">
        <input id="pers_score" type="hidden" value="' . $user["pers_score"] . '">';
        
        ?>
        
        <div id="loading-vizualizer" class="row">
            <div class="col-12 text-center">
                Looking for player …<br>
                rank : <span id="rankMin">rankMin</span> – <span id="rankMax">rankMax</span>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 text-center">
                <a id="cancel-button" class="btn" href="index.php" target="_self">CANCEL</a>
            </div>
        </div>
    </main>

    <script src="./matchmaking.js"></script>
    <script src="./common/battle_script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>