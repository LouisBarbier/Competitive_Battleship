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

// If the user is not connected or not an admin we refuse the access to this page
if (!$connected || !$pers_isadmin) {
// if (false) {
    header("Location: index.php");
    die();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $user_2 = getUser($id);


    if ($user_2['pers_id'] === null) {
        $real_user = false;
    } else {
        $real_user = true;
    }
} else {
    $real_user = false;
}

if (!$real_user) {
// if (false) {
    header("Location: admin.php");
    die();
}

if (isset($_POST['delete-user'])) {
    $deleteUser = $_POST['delete-user'];

    if ($deleteUser == 1 || $deleteUser == "1") {
        delete_user($user_2['pers_id']);

        header("Location: admin.php");
        die();
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $first_name = $_POST['first-name'];
        $last_name = $_POST['last-name'];
        $photo = "";
    
        if ($username == $user_2['pers_username']) {
            $valid_username = true;
        } else {
            $valid_username = existUsername($username) == 0;
        }
        if ($email == $user_2['pers_email']) {
            $valid_email = true;
        } else {
            $valid_email = existEmail($email) == 0;
        }
    
        if ($valid_username && $valid_email) {
            
            update_person($user_2['pers_id'], $first_name, $last_name, $email, $username);
    
            if (isset($_FILES["profile-picture"])) {
                if ($_FILES["profile-picture"]["error"] > 0){
                    /*
                    // setCookie have to be called before anything is sent => don't echo anything
                    switch ($_FILES["document"]['error']){
                        case 1: // UPLOAD_ERR_INI_SIZE
                            echo"ERROR, file is too heavy for the PHP server";
                            break;
                        case 2: // UPLOAD_ERR_FORM_SIZE
                            echo "ERROR, file is too heavy for the HTML form";
                            break;
                        case 3: // UPLOAD_ERR_PARTIAL
                            echo "ERROR, something stopped file upload";
                            break;
                        case 4: // UPLOAD_ERR_NO_FILE
                            // echo "ERROR, no file selected"; // Not a problem => Don't print error message
                            break;
                        default : break;
                    }
                    */
                } else {
                    if (($user_2['pers_photo'] == "") || ($user_2['pers_photo'] == null)) {
                        $deconstructed_file_name = explode('.',$_FILES["profile-picture"]["name"]);
                    
                        $actual_file_name = array_shift($deconstructed_file_name);
                        
                        $photo = $user_2['pers_id'].".".implode('.',$deconstructed_file_name);
                        $file_dir = "./profile_pictures/".$user_2['pers_id'].".".implode('.',$deconstructed_file_name);
                        $n = 1;
                        
                        while (is_dir($file_dir)) {
                            $photo = $user_2['pers_id']."(".$n.").".implode('.',$deconstructed_file_name);
                            $file_dir = "./profile_pictures/".$user_2['pers_id']."(".$n.").".implode('.',$deconstructed_file_name);
                            $n++;
                        }
                    } else {
                        $file_dir = "./profile_pictures/" . $user_2['pers_photo'];
                    }
    
                    // echo $file_dir;
                    
                    move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $file_dir);
                    
                    if (($user_2['pers_photo'] == "") || ($user_2['pers_photo'] == null)) {
                        update_profile_picture($user_2['pers_id'], $photo);
                        $user_2['pers_photo'] = $photo;
                    }
                }
            }
        }
    
        $user_2['pers_username'] = $username;
        $user_2['pers_email'] = $email;
        $user_2['pers_firstname'] = $first_name;
        $user_2['pers_lastname'] = $last_name;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php
    
    echo "<title>" . $user_2['pers_username'] . "'s Account - Competitive Battleship</title>";
    
    ?>
    
    <link rel="icon" type="image/svg+xml" href="common/images/competitive_battleship.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="common/styles.css">
    <link rel="stylesheet" href="person.css">
    <style>
        
        <?php

        load_css_variables(isset($_COOKIE["dark_mode"]) && $_COOKIE["dark_mode"] === "1");

        ?>
        
    </style>
</head>
<body>
    <!--Here new player will be able to register so they can start playing-->
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
                <a href="admin.php" class="nav-link active" target="_self" aria-current="page">Admin Page</a>
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
    
    echo '<main class="container">
        <form id="modification-form" action="person.php?id=' . $user_2["pers_id"] . '" method="POST" enctype="multipart/form-data">
            <input id="delete-user" name="delete-user" type="hidden" value="0">
        
            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-12 text-center">';
                            
                            if (($user_2["pers_photo"] !== "") and ($user_2["pers_photo"] !== null)) {
                                echo '<img id="profile-picture-visualizer" alt="user profile picture" src="./profile_pictures/' . $user_2["pers_photo"] . '">';
                            } else {
                                echo '<img id="profile-picture-visualizer" alt="user profile picture" src="./profile_pictures/default.png">';
                            }
                        
                        echo '</div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="profile-picture">Profile Picture</label>
                            <input id="profile-picture" class="form-control" name="profile-picture" type="file" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="username">Username</label>
                            <div class="input-group">
                                <input id="username" class="form-control" name="username" placeholder="Username" aria-label="Username" type="text" value="' . $user_2["pers_username"] . '" required>
                                <input id="username-valid" type="hidden" style="display: none; visibility: hidden;" value="false">
                                <span class="input-group-text" id="usernameTaken">No username</span>
                            </div>

                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="first-name">First Name</label>
                            <input id="first-name" class="form-control" name="first-name" placeholder="First name" aria-label="First name" type="text" value="' . $user_2["pers_firstname"] . '" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="last-name">Last Name</label>
                            <input id="last-name" class="form-control" name="last-name" placeholder="Last name" aria-label="Last name" type="text" value="' . $user_2["pers_lastname"] . '" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <input id="email" class="form-control" name="email" placeholder="Email" aria-label="Email" type="email" value="' . $user_2["pers_email"] . '" required>
                                <input id="email-valid" type="hidden" style="display: none; visibility: hidden;" value="false">
                                <span class="input-group-text" id="emailTaken">No email</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-end">
                    <input id="confirm-but" class="btn btn-submit" type="submit" value="Confirm">
                </div>
                <div class="col-1"></div>
                <div class="col text-start">
                    <input id="delete-but" class="btn btn-submit" type="button" value="Delete">
                </div>
            </div>
        </form>
    </main>';

    ?>

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
    <script src="person.js"></script>
    <script src="./common/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>