<?php
    define("DBSERVER", "localhost");
    define("DBUSER", "root");
    define("DBPASSWORD", "");
    define("DBNAME", "competitive_battleship");

    $DB = new mysqli(DBSERVER, DBUSER, DBPASSWORD, DBNAME);

    if($DB->connect_error) {
        die("Connection failed: " . $DB->connect_error);
    }

    // echo "<p>Connected successfully</p>";
?>