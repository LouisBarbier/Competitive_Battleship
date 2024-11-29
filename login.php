<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - Competitive Battleship</title>
    <link rel="icon" type="image/svg+xml" href="common/images/competitive_battleship.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="common/styles.css">
    <link rel="stylesheet" href="login.css">
    <style>
        
        <?php

        if (isset($_COOKIE["dark_mode"]) && $_COOKIE["dark_mode"] === "1") {
            echo ":root {
                --body-bg-color: #3B3838;
                --body-bg-color-hover: #404040;
                --nav-bg-color: #787C7E;
                --bd-color: white;
                --tx-color: white;
                --tx-color-inv: black;
            }";
        } else {
            echo ":root {
                --body-bg-color: #e3e3e1;
                --body-bg-color-hover: #cacaca;
                --nav-bg-color: #787C7E;
                --bd-color: black;
                --tx-color: black;
                --tx-color-inv: white;
            }";
        }

        ?>
        
    </style>
</head>
<body class="text-center">
    <!--Here players and admins will be able to log in (depending of if they are players or admins they will not have access to the same pages afterward)-->
    <form class="form-signin">
        <img class="mb-4" src="common/images/competitive_battleship.svg" alt="Logo" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Sign in to<br>Competitive Battleship</h1>

        <div id="error-msg" class="alert alert-danger" role="alert">Incorrect username or password.</div>

        <label for="user_id">ID or Email address</label>
        <input type="text" id="user_id" class="form-control" placeholder="ID or Email address" required autofocus>
        
        <label for="password">Password</label>
        <input type="password" id="password" class="form-control" placeholder="Password" required>

        <button id="submit-but" class="btn btn-lg btn-primary btn-block" type="button">Sign in</button>
        <p id="copyright" class="mt-5 mb-3 text-muted">&copy; 2024</p>
    </form>
  
    <script src="login.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>