<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms - Competitive Battleship</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!--Some random Terms, IDC-->
    <header class="d-flex flex-wrap justify-content-center py-4 mb-4 border-bottom">
        <a href="index.php" target="_self" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="images/logos/competitive_battleship.svg" alt="Logo" class="bi me-2" width="40" height="40">
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
                <a href="admin.php" class="nav-link" target="_self">Admin Page</a>
            </li>
            <li class="nav-item">
                <a href="tutorial.php" class="nav-link" target="_self">Tutorial</a>
            </li>
            <li class="nav-item">
                <!--This <li> show the editAccount button only if we are already connected
                    If we are not, then it show the sign in and sign up buttons
                -->
                <a href="#" class="nav-link active" target="_self" aria-current="page">Edit Account</a>
            </li>
        </ul>
    </header>
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-4 my-4 border-top">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>