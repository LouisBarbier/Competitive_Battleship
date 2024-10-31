<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Louis Barbier">
    <meta name="description" content="Play Battleship Against Other">
    <title>Competitive Battleship</title>
    <link rel="icon" type="image/svg+xml" href="images\logos\competitive_battleship.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
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
        tutorial.php that might contain 3 levels of headings :
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

    <header class="d-flex flex-wrap justify-content-center border-bottom">
        <a href="#" target="_self" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="images/logos/competitive_battleship.svg" alt="Logo" class="bi me-2" width="40" height="40">
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
                <a href="tutorial.php" class="nav-link" target="_self">Tutorial</a>
            </li>
            <li class="nav-item">
                <div class="container">
                    <!--This <li> show the editAccount button only if we are already connected
                        If we are not, then it show the sign in and sign up buttons
                    -->
                    <a id="login" href="login.html" class="nav-link" target="_blank">Sign In</a>
                    <a href="#" class="nav-link" target="_self">Sign Up</a>
                </div>
            </li>
        </ul>
    </header>

    <main>
        <div id="started_games"><a href="battle.php" target="_self">Continue!</a></div>
        <div id="search_games"><a href="matchmaking.php" target="_self">Battle!</a></div>
        <div id="profile"></div>  
    </main>

    <footer class="d-flex flex-wrap justify-content-between align-items-center border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="#" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <img src="images/logos/competitive_battleship.svg" alt="Logo" class="bi" width="30" height="30">
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2024 Competitive Battleship</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3">
                <a class="text-body-secondary" href="https://www.facebook.com/juniata" title="Facebook" target="_blank">
                    <img class="bi" width="24" height="24" src="images/logos/facebook.svg" alt="Facebook Logo">
                </a>
            </li>
            <li class="ms-3">
                <a class="text-body-secondary" href="https://twitter.com/juniatacollege" title="Twitter / X" target="_blank">
                    <img class="bi" width="24" height="24" src="images/logos/x.svg" alt="Twitter / X Logo">
                </a>
            </li>
            <li class="ms-3">
                <a class="text-body-secondary" href="https://github.com/LouisBarbier/Competitive_Battleship" title="GitHub" target="_blank">
                    <img class="bi" width="24" height="24" src="images/logos/github.svg" alt="GitHub Logo">
                </a>
            </li>
        </ul>
    </footer>

    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>