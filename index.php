<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Louis Barbier">
    <meta name="description" content="Play Battleship Against Other">
    <title>Competitive Battleship</title>
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

    <header>
        <ul>
            <li id="logo">LOGO</li>
            <li id="admin">
                <!--
                    This button is accessible only if we are connected and if we are an admin
                -->
                <a href="admin.php" target="_self">Admin Page</a>
            </li>
            <li id="tutorial"><a href="tutorial.php" target="_self">Tutorial</a></li>
            <li id="account">
                <!--This <li> show the editAccount button only if we are already connected
                    If we are not, then it show the sign in and sign up buttons
                -->
                <a href="editAccount.php" target="_self">Edit Account</a>
            </li>
        </ul>
    </header>

    <div id="main">
        <div id="started_games"><a href="battle.php" target="_self">Continue!</a></div>
        <div id="search_games"><a href="matchmaking.php" target="_self">Battle!</a></div>
        <div id="profile"></div>  
     </div>

    <footer>
        <ul>
            <li id="copyright">&copy; 2024 Competitive Battleship</li>
            <li id="terms"><a href="terms.php">Terms</a></li>
            <li id="links">
                <ul>
                    <li><a href="https://www.facebook.com/juniata" title="Facebook" target="_blank"><img src="images/logos/facebook.svg" alt="Facebook Logo"></a></li>
                    <li><a href="https://twitter.com/juniatacollege" title="Twitter / X" target="_blank"><img src="images/logos/x.svg" alt="Twitter / X Logo"></a></li>
                    <li><a href="https://github.com/LouisBarbier/Competitive_Battleship" title="GitHub" target="_blank"><img src="images/logos/github.svg" alt="GitHub Logo"></a></li>
                </ul>
            </li>
        </ul>
    </footer>
</body>
</html>