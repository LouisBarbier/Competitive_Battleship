<?php

include('./functions/functions.php');

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
// if (false) {
    header("Location: index.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account - Competitive Battleship</title>
    <link rel="icon" type="image/svg+xml" href="common/images/competitive_battleship.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="common/styles.css">
    <style>
        
        <?php

        load_css_variables(isset($_COOKIE["dark_mode"]) && $_COOKIE["dark_mode"] === "1");

        ?>

    </style>
</head>
<body>
    <!--Here players and admins will be able to change infos of their account (profile picture, name, NOT ID)-->
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
                <a href="index.php" class="nav-link" target="_self">Home</a>
            </li>

            <?php

            if ($connected && ($user['pers_isadmin']==='1' || $user['pers_isadmin']===1 || $user['pers_isadmin']===true)) {
                echo '<li class="nav-item">
                    <a href="admin.php" class="nav-link" target="_self">Admin Page</a>
                </li>';
            }

            ?>

            <li class="nav-item">
                <a href="tutorial.php" class="nav-link" target="_self" aria-current="page">Tutorial</a>
            </li>
            <li class="nav-item">
                <!--This <li> show the editAccount button only if we are already connected
                    If we are not, then it show the sign in and sign up buttons
                -->
                <a href="#" class="nav-link active" target="_self">Edit Account</a>
            </li>
        </ul>
    </header>

    <main class="container text-center">NOT FINISHED</main>

    <footer class="d-flex flex-wrap justify-content-between align-items-center mt-auto">
        <div class="col-md-4 d-flex align-items-center">
            <a href="#" class="mb-3 me-2 mb-md-0 lh-1">
                <img src="common/images/competitive_battleship.svg" alt="Logo" class="bi" width="30" height="30">
            </a>
            <span class="mb-3 mb-md-0">&copy; 2024 Competitive Battleship</span>
        </div>

        <ul class="nav col-md-4 nav-pills justify-content-start">
            <li class="nav-item">
                <a href="terms.php" class="nav-link" target="_self">Terms</a>
            </li>
        </ul>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3">
                <a href="https://www.facebook.com/juniata" title="Facebook" target="_blank">
                    <img width="24" height="24" src="common/images/facebook.svg" alt="Facebook Logo">
                </a>
            </li>
            <li class="ms-3">
                <a href="https://twitter.com/juniatacollege" title="Twitter / X" target="_blank">
                    <img width="24" height="24" src="common/images/x.svg" alt="Twitter / X Logo">
                </a>
            </li>
            <li class="ms-3">
                <a href="https://github.com/LouisBarbier/Competitive_Battleship" title="GitHub" target="_blank">
                    <img width="24" height="24" src="common/images/github.svg" alt="GitHub Logo">
                </a>
            </li>
        </ul>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>