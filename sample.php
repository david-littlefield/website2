<?php

    # attempts to execute specified code
    try {
    
        # specifies information to connect to database
        $database = "website";
        $host = "198.74.61.19";
        $username = "littlefd";
        $password = "StrongPassword1234!";

        # connects to database
        $connection = new PDO("mysql:dbname=$database; host=$host", $username, $password);
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    # displays error messages that occur durring attempt
    } catch(PDOException $error) {
        echo "Connection Failed: " . $error -> getMessage();
    }

    class Sample {

        private $connection;

        public function __construct($connection) {
            $this -> connection = $connection;
        }

        public function read_records() {
            $query = $this -> connection -> prepare("SELECT * FROM images");
            $query -> execute();
            $records = $query -> fetchall();
            echo var_dump($records);
        }

    }

    $sample = new Sample($connection);
    $sample.read_records();

?>