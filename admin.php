<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Competitive Battleship</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!--Here admins will be able to see all players (or research specific ones) and modify/delete them-->
    <header>
        <ul>
            <li id="logo"><a href="index.php" target="_self">LOGO</a></li>
            <li id="admin">Admin Page</li>
            <li id="tutorial"><a href="tutorial.php" target="_self">Tutorial</a></li>
            <li id="account">
                <!--This <li> show the editAccount button only if we are already connected
                    If we are not, then it show the sign in and sign up buttons
                -->
                <a href="editAccount.php" target="_self">Edit Account</a>
            </li>
        </ul>
    </header>
    <footer>
        <ul>
            <li id="copyright">&copy; 2024 Competitive Battleship</li>
            <li id="terms"><a href="terms.php" target="_self">Terms</a></li>
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