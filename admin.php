<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Competitive Battleship</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!--Here admins will be able to see all players (or research specific ones) and modify/delete them-->
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="index.php" target="_self" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="" alt="Logo" class="bi me-2" width="40" height="32">
            <span class="fs-4">Competitive Battleship</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="index.php" class="nav-link" target="_self">Home</a>
            </li>
            <li class="nav-item">
                <!--
                    This button is accessible only if we are connected and if we are an admin
                -->
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>