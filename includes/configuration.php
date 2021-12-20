<?php

    date_default_timezone_set("America/Los_Angeles");

    try {
        echo "database start";
        $database = "website";
        $host = "198.74.61.19";
        $username = "littlefd";
        $password = "StrongPassword1234!";
        $connection = new PDO("mysql:dbname=$database;host=$host", $username, $password);
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        echo "database end";
    } catch(PDOException $error) {
        echo "Connection Failed: " . $error -> getMessage();
    }

?>