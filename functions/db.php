<?php
    define("SERVER", "localhost");
    define("USER", "root");
    define("PASSWORD", "");
    define("DBNAME", "competitive_battleship");

    $DB = new mysqli(SERVER, USER, PASSWORD, DBNAME);

    if($DB->connect_error) {
        die("Connection failed: " . $DB->connect_error);
    }

    // echo "<p>Connected successfully</p>";
?>