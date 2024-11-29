<?php

include('./functions/functions.php');

// prevent the user from accessing the admin page if he is not logged in or if he isn't an admin
if (isset($_COOKIE["user"])) {

    $user = json_decode($_COOKIE["user"], true);

    $pers_id = $user['pers_id'];
    $pers_password = $user['pers_password'];

    $connected = isValid($pers_id, $pers_password);

    $pers_isadmin = $user['pers_isadmin'];

    // if (!$connected or !$pers_isadmin) {
    if (false) {
        header("Location: index.php");
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Competitive Battleship</title>
    <link rel="icon" type="image/svg+xml" href="common/images/competitive_battleship.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="common/styles.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        :root {
            --body-bg-color: #e3e3e1;
            --body-bg-color-hover: #cacaca;
            --nav-bg-color: #787C7E;
            --bd-color: black;
            --tx-color: black;
            --tx-color-inv: white;
        }
    </style>
</head>
<body>
    <!--Here admins will be able to see all players (or research specific ones) and modify/delete them-->
    <header class="d-flex flex-wrap justify-content-center">
        <a href="index.php" target="_self" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="common/images/competitive_battleship.svg" alt="Logo" class="bi me-2" width="40" height="40">
            <span class="fs-4">Competitive Battleship</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item">
                <img id="bright_mode" alt="dark mode" src="./common/images/light-bulb.png">
            </li>
            <li class="nav-item">
                <a href="index.php" class="nav-link" target="_self">Home</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link active" target="_self" aria-current="page">Admin Page</a>
            </li>
            <li class="nav-item">
                <a href="tutorial.php" class="nav-link" target="_self">Tutorial</a>
            </li>
            <li class="nav-item">
                <!--This <li> show the editAccount button only if we are already connected
                    If we are not, then it show the sign in and sign up buttons
                -->
                <a href="editAccount.php" class="nav-link" target="_self">Edit Account</a>
            </li>
        </ul>
    </header>

    <main class="container">
        <div id="researcher" class="row"></div>
        <div class="row">
            <?php

            $sql_result = load_more(21, 0);

            /*
            if ($sql_result) {

                $i = 0;

                foreach ($sql_result as $row) {
                    if ($i % 3 == 0) {
                        echo '<div class="row">';
                    }

                    echo '<a class="col custom-col m-2 p-3" href="battle.php">
                        <div class="row">
                            <div class="col">';

                                if (($row["pers_photo"] !== "") and ($row["pers_photo"] !== null)) {
                                    echo '<img class="img-fluid profile-picture" alt="profile picture" src="profile_pictures/' . $row["pers_photo"] . '">';
                                } else {
                                    echo '<img class="img-fluid profile-picture" alt="profile picture" src="profile_pictures/default.png">';
                                }
                    
                            echo '</div>
                            <div class="col">
                                <span class="label">rank:</span>
                                ' . $row["pers_score"] . '
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span class="label">username:</span>
                                ' . $row["pers_username"] . '
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span class="label">first name:</span>
                                ' . $row["pers_firstname"] . '
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span class="label">last name:</span>
                                ' . $row["pers_lastname"] . '
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span class="label">email:</span>
                                ' . $row["pers_email"] . '
                            </div>
                        </div>
                    </a>';

                    if (($i % 3 == 2) or ($i == mysqli_num_rows($sql_result) - 1)) {
                        echo '</div>';
                    }

                    $i++;
                }
            }
            */

            if ($sql_result) {
                echo '<div class="row row-cols-4">';

                foreach ($sql_result as $row) {
                    echo '<div class="col mb-4">
                        <div class="card h-100 text-center">'; // mb-3 p-3

                            if (($row["pers_photo"] !== "") and ($row["pers_photo"] !== null)) {
                                echo '<img class="card-img-top profile-picture" alt="profile picture" src="profile_pictures/' . $row["pers_photo"] . '">';
                            } else {
                                echo '<img class="card-img-top profile-picture" alt="profile picture" src="profile_pictures/default.png">';
                            }

                            echo '<div class="card-body">
                                <h5 class="card-title">' . $row["pers_username"] . '</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Account created in ' . $row["pers_datecre"] . '</small>
                            </div>
                        </div>
                    </div>';
                }

                echo '</div>';
            }
            
            ?>
            
        </div>
    </main>

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