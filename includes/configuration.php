<?php

    date_default_timezone_set("America/Los_Angeles");

    # attempts to execute specified code
    try {
    
        # specifies information to connect to database
        $database = "website";
        $host = "198.74.61.19";
        $username = "littlefd";
        $password = "StrongPassword1234!";

        # connects to database
        $connection = new PDO("mysql:dbname=$database;host=$host", $username, $password);
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    # displays error messages that occur durring attempt
    } catch(PDOException $error) {
        echo "Connection Failed: " . $error -> getMessage();
    }

?>