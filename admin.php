<?php

include('./functions/functions.php');

// prevent the user from accessing the admin page if he is not logged in or if he isn't an admin
if (isset($_COOKIE["user"])) {

    $user = json_decode($_COOKIE["user"], true);

    $pers_id = $user['pers_id'];
    $pers_password = $user['pers_password'];

    $connected = isValid($pers_id, $pers_password);

    $pers_isadmin = $user['pers_isadmin'];
} else {
    $connected = false;
}

// if (!$connected || !$pers_isadmin) {
if (false) {
    header("Location: index.php");
    die();
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

        <?php

        load_css_variables(isset($_COOKIE["dark_mode"]) && $_COOKIE["dark_mode"] === "1");

        ?>

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

    <?php

    $username = "";
    $score = 0;
    $nbbattle = 0;
    $datecre_start = "";
    $datecre_end = "";
    
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $score = $_POST['score'];
        $nbbattle = $_POST['nbbattle'];
        $datecre_start = $_POST['datecre_start'];
        $datecre_end = $_POST['datecre_end'];
    }

    $conditions = array();

    if ($username != "") {
        array_push($conditions, "pers_username LIKE '%$username%'");
    }

    if ($score != "" && $score != 0) {
        array_push($conditions, "pers_score >= $score");
    } else {
        $score = 0;
    }

    if ($nbbattle == "") {
        $nbbattle = 0;
    }

    if ($datecre_start != "") {
        array_push($conditions, "pers_datecre >= $datecre_start");
    }

    if ($datecre_end != "") {
        array_push($conditions, "pers_datecre <= $datecre_end");
    }

    echo '<main class="container">
        <input id="current_username" type="hidden" value="' . $username . '">
        <input id="current_score" type="hidden" value="' . $score . '">
        <input id="current_nbbattle" type="hidden" value="' . $nbbattle . '">
        <input id="current_datecre_start" type="hidden" value="' . $datecre_start . '">
        <input id="current_datecre_end" type="hidden" value="' . $datecre_end . '">

        <form id="research-form" class="row text-center" action="admin.php" method="POST">
            <div class="col-4">
                <div class="form-floating">
                    <input id="username" class="form-control" name="username" type="text" placeholder="username" value="' . $username . '">
                    <label for="username">Username</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating">
                    <input id="score" class="form-control" name="score" type="number" min="0" placeholder="1234" value="' . $score . '">
                    <label for="score">Score</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating">
                    <input id="nbbattle" class="form-control" name="nbbattle" type="number" min="0" placeholder="1234" value="' . $nbbattle . '">
                    <label for="nbbattle">Battle</label>
                </div>
            </div>
            <div class="col-2">
                <div class="form-floating">
                    <input id="datecre_start" class="form-control" name="datecre_start" type="date" placeholder="01/01/2024" value="' . $datecre_start . '">
                    <label for="datecre_start">Created after</label>
                </div>
            </div>
            <div class="col-2">
                <div class="form-floating">
                    <input id="datecre_end" class="form-control" name="datecre_end" type="date" placeholder="01/01/2025" value="' . $datecre_end . '">
                    <label for="datecre_end">Created before</label>
                </div>
            </div>
            <div class="col-1">
                <button id="submit-but" class="btn" type="submit">&telrec;</button>
            </div>
        </form>
        <div id="users-list" class="row text-center row-cols-4">';

            $sql_result = load_more(8, 0, $conditions, $nbbattle);

            if ($sql_result) {
                foreach ($sql_result as $row) {
                    echo '<div class="col mb-4">
                        <a class="card h-100 text-center" href="#">';

                            if (($row["pers_photo"] !== "") and ($row["pers_photo"] !== null)) {
                                echo '<img class="card-img-top profile-picture" alt="profile picture" src="profile_pictures/' . $row["pers_photo"] . '">';
                            } else {
                                echo '<img class="card-img-top profile-picture" alt="profile picture" src="profile_pictures/default.png">';
                            }

                            echo '<div class="card-body">
                                <h5 class="card-title fw-bold">' . $row["pers_username"] . '</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="text-start list-group-item">
                                        <span class="label">First name :</span>
                                        ' . $row["pers_firstname"] . '
                                    </li>
                                    <li class="text-start list-group-item">
                                        <span class="label">Last name :</span>
                                        ' . $row["pers_lastname"] . '
                                    </li>
                                    <li class="text-start list-group-item">
                                        <span class="label">Email :</span>
                                        ' . $row["pers_email"] . '
                                    </li>
                                    <li class="text-start list-group-item">
                                        <div class="row">
                                            <div class="col text-start">
                                                <span class="label">Score :</span>
                                                ' . $row["pers_score"] . '
                                            </div>
                                            <div class="col text-end">
                                                <span class="label">Battle :</span>
                                                ' . $row["pers_nbbattle"] . '
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Account created :<br>' . date("m/d/Y H:i:s", strtotime($row["pers_datecre"])) . '</small>
                            </div>
                        </a>
                    </div>';
                }
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

    <template id="template-user">
        <a class="card h-100 text-center" href="#">
            <img class="card-img-top profile-picture" alt="profile picture" src="profile_pictures/@pers_photo@">
            <div class="card-body">
                <h5 class="card-title fw-bold">@pers_username@</h5>
                <ul class="list-group list-group-flush">
                    <li class="text-start list-group-item">
                        <span class="label">First name :</span>
                        @pers_firstname@
                    </li>
                    <li class="text-start list-group-item">
                        <span class="label">Last name :</span>
                        @pers_lastname@
                    </li>
                    <li class="text-start list-group-item">
                        <span class="label">Email :</span>
                        @pers_email@
                    </li>
                    <li class="text-start list-group-item">
                        <div class="row">
                            <div class="col text-start">
                                <span class="label">Score :</span>
                                @pers_score@
                            </div>
                            <div class="col text-end">
                                <span class="label">Battle :</span>
                                @pers_nbbattle@
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-footer">
                <small class="text-muted">Account created :<br>@pers_datecre@</small>
            </div>
        </a>
    </template>

    <script src="admin.js"></script>
    <script src="./common/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>