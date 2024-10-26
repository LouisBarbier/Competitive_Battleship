<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchMaking - Competitive Battleship</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="battling_mode.css">
</head>
<body>
    <!--Here players will be wait while the game try to get them against the closest player (in term of rank)
    Once a player is found the game will ask them to confirm the battle. Once confirmed the battle will start (they will be both redirected to battle.php).
    -->
    <header class="d-flex flex-wrap justify-content-center py-4 mb-4 border-bottom">
        <a href="index.php" target="_self" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="images/logos/competitive_battleship.svg" alt="Logo" class="bi me-2" width="40" height="40">
            <span class="fs-4">Competitive Battleship</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item">
                <img src="" alt="Tutorial" class="bi me-2" width="40" height="32">
            </li>
            <li class="nav-item">
                <img src="" alt="Brightness" class="bi me-2" width="40" height="32">
            </li>
            <li class="nav-item">
                <img src="" alt="Your Profile Picture" class="bi me-2" width="40" height="32">
            </li>
        </ul>
    </header>

    <a href="battle.php">battle found</a>
    <a href="index.php" target="_self">Cancel</a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>