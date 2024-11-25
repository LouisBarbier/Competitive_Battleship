<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Competitive Battleship</title>
    <link rel="icon" type="image/svg+xml" href="common/images/competitive_battleship.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="common/styles.css">
    <link rel="stylesheet" href="registration.css">
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
                <a href="index.php" class="nav-link" target="_self">Home</a>
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
                <a href="#" class="nav-link active" target="_self" aria-current="page">Sign Up</a>
            </li>
        </ul>
    </header>

    <main>
        <form>
            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img class="h-100" alt="your profile picture" src="./profile_pictures/1.png">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="profile-picture">Profile Picture</label>
                            <input id="profile-picture" class="form-control" name="profile-picture" type="file">
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="username">Username</label>
                            <div class="input-group">
                                <input id="username" class="form-control" name="username" placeholder="Username" aria-label="Username" type="text">
                                <span class="input-group-text" id="taken">No username</span>
                            </div>

                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="first-name">First Name</label>
                            <input id="first-name" class="form-control" name="first-name" placeholder="First name" aria-label="First name" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="last-name">Last Name</label>
                            <input id="last-name" class="form-control" name="last-name" placeholder="Last name" aria-label="Last name" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" name="email" placeholder="Email" aria-label="Email" type="email">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" name="password" placeholder="Password" aria-label="Password" type="password">
                </div>
                <div class="col-md-6">
                    <label for="confirm-password">Confirm password</label>
                    <input id="confirm-password" class="form-control" name="confirm-password" placeholder="Password" aria-label="Password" type="password">
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <input id="submit-button" class="btn btn-primary m-3" type="submit" value="Register">
                </div>
            </div>
        </form>
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
    <script src="registration.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>