<?PHP

include('./functions/functionIndex.php');

if (isset($_COOKIE["user"])) {
    $user = json_decode($_COOKIE["user"], true);

    $pers_id = $user['pers_id'];
    $pers_password = $user['pers_password'];

    $connected = isValid($pers_id, $pers_password);
} else {
    $connected = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Louis Barbier">
    <meta name="description" content="Play Battleship Against Other">
    <title>Competitive Battleship</title>
    <link rel="icon" type="image/svg+xml" href="common/images/competitive_battleship.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="common/styles.css">
</head>

<body>
    <!--
    Design considerations : 
        I would prefer a simple design (along the same lines as Wordle) 

    schedule : 
        Before September 17 : Project Site Navigation Diagrams
        Before September 24 : Project Userflow
        Before October 1 : Color Scheme
        Before October 30 : Make Progress
        Before November 5 : implement one thing from Bootstrap
        Before December 13 : Finish the Web Site


    // ------- Project Iteration 4 ------- //
    
    What will be the typefaces and styles for the body type and headings?
        All i'm sure at this point is that i want to use a font with serifs on the tutorial page to make the text easier to read.

    How many levels of headings are necessary?
        The only page that will contain more than 1 or 0 headings will be
        tutorial.html that might contain 3 levels of headings :
            - The title of the page
            - Another level for the main titles (ex : How to play, The score system, etc...)
            - Another for secondary titles (ex : the different chapters of How to play)

    What are the different weights and sizes of the headings?
        I don't know yet since i didn't start to work on the design that precisely.

    How will text be emphasized?
        By making sure the text and the background color are contrasted.

    Will hypertext links be standard or custom colors?
        Hypertext links will be customized by CSS to appear as buttons.

    How will you ensure the legibility and readability of your text?
        The pages will not contain a lot of text so i can just write it big.
        In the tutorial page, which might contain a lot of text, i will use titles to separate the text in smaller chunks.

    What will your line length be?
        Huh?

    
    -->

    <header class="d-flex flex-wrap justify-content-center">
        <a href="#" target="_self" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="common/images/competitive_battleship.svg" alt="Logo" class="bi me-2" width="40" height="40">
            <span class="fs-4">Competitive Battleship</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="#" class="nav-link active" target="_self" aria-current="page">Home</a>
            </li>
            <li class="nav-item">
                <!--
                    This button is accessible only if we are connected and if we are an admin
                -->
                <a href="admin.php" class="nav-link" target="_self">Admin Page</a>
            </li>
            <li class="nav-item">
                <a href="tutorial.html" class="nav-link" target="_self">Tutorial</a>
            </li>
            <li class="nav-item">
                <a id="login" href="login.html" class="nav-link" target="_blank">Sign In</a>
            </li>
            <li class="nav-item">
                <a href="registration.php" class="nav-link" target="_self">Sign Up</a>
            </li>
        </ul>
    </header>

    <main class="container">
        <div class="row">
            <div id="started_games" class="col custom-col mx-2 p-3">
                <h4 class="text-center">Continue</h4>
                <div class="table-wrapper">
                    <table class="table text-center table-sm">
                        <thead>
                            <tr>
                                <th id="date-col" scope="col">Start Date</th>
                                <th id="opponant-col" scope="col">Opponant</th>
                                <th id="continue-col" scope="col">Continue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            for ($i = 1; $i < 11; $i++) {

                                $battle_id = $i;
                                $battle_startDate = "05/13/14";
                                $opponant_name = "Test $i";

                                $your_turn = random_int(0, 1);

                                if ($your_turn) {
                                    $continue_button_color = 'green';
                                } else {
                                    $continue_button_color = 'red';
                                }

                                echo "<tr>
                                        <th scope=\"row\">$battle_startDate</th>
                                        <td>$opponant_name</td>
                                        <td><a class=\"btn continue-button $continue_button_color\" role=\"button\" href=\"battle.php?id=$battle_id\" target=\"_self\">&blacktriangleright;</a></td>
                                    </tr>";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="search_games" class="col custom-col mx-2 p-3 mw-100">
                <h4 class="text-center">Start</h4>
                <div class="nb-online">
                    <span class="nb-online">
                        <?php

                        $nb_online = getNbOnline();

                        echo $nb_online;

                        ?>
                    </span> online
                </div>
                <div>Start a new battle against someone your rank</div>
                <div class="text-center my-2">
                    <a id="battle-button" class="btn btn-lg" role="button" href="matchmaking.php" target="_self">BATTLE</a>
                </div>
            </div>
            <div id="profile" class="col custom-col mx-2 p-3 mw-100">
                <h4 class="text-center">Profile</h4>

                <?PHP
                
                if ($connected) {
                    echo "<div class=\"row\">
                        <div class=\"col\">";

                            if (($user["pers_photo"] !== "") and ($user["pers_photo"] !== null)) {
                                echo "<img id=\"profile-picture\" class=\"img-fluid\" alt=\"profile picture\" src=\"profile_pictures/" . $user["pers_photo"] . "\">";
                            } else {
                                echo "<img id=\"profile-picture\" class=\"img-fluid\" alt=\"profile picture\" src=\"profile_pictures/default.png\">";
                            }
                
                        echo "</div>
                        <div class=\"col\">
                            <span class=\"label\">rank:</span>
                            " . $user["pers_score"] . "
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col\">
                            <span class=\"label\">username:</span>
                            " . $user["pers_username"] . "
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col\">
                            <span class=\"label\">first name:</span>
                            " . $user["pers_firstname"] . "
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col\">
                            <span class=\"label\">last name:</span>
                            " . $user["pers_lastname"] . "
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col\">
                            <span class=\"label\">email:</span>
                            " . $user["pers_email"] . "
                        </div>
                    </div>";
                } else {
                    echo "<div class=\"alert alert-warning\">Not connected</div>";
                }

                ?>
                
            </div>
        </div>
    </main>

    <footer class="d-flex flex-wrap justify-content-between align-items-center mt-auto">
        <div class="col-md-4 d-flex align-items-center">
            <a href="#" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <img src="common/images/competitive_battleship.svg" alt="Logo" class="bi" width="30" height="30">
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2024 Competitive Battleship</span>
        </div>

        <ul class="nav col-md-4 nav-pills justify-content-start">
            <li class="nav-item">
                <a href="terms.html" class="nav-link" target="_self">Terms</a>
            </li>
        </ul>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3">
                <a class="text-body-secondary" href="https://www.facebook.com/juniata" title="Facebook" target="_blank">
                    <img class="bi" width="24" height="24" src="common/images/facebook.svg" alt="Facebook Logo">
                </a>
            </li>
            <li class="ms-3">
                <a class="text-body-secondary" href="https://twitter.com/juniatacollege" title="Twitter / X" target="_blank">
                    <img class="bi" width="24" height="24" src="common/images/x.svg" alt="Twitter / X Logo">
                </a>
            </li>
            <li class="ms-3">
                <a class="text-body-secondary" href="https://github.com/LouisBarbier/Competitive_Battleship" title="GitHub" target="_blank">
                    <img class="bi" width="24" height="24" src="common/images/github.svg" alt="GitHub Logo">
                </a>
            </li>
        </ul>
    </footer>

    <script src="common/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>