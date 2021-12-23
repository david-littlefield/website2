<?php

    try {
    
        $database = "#database_placeholder#";
        $host = "#host_placeholder#";
        $username = "#username_placeholder#";
        $password = "#password_placeholder#";

        $connection = new PDO("mysql:dbname=$database; host=$host", $username, $password);
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    } catch(PDOException $error) {
        echo "Connection Failed: " . $error -> getMessage();
    }

    class Demo {

        private $connection;
        public $records;
        public $record;

        public function __construct($connection) {
            $this -> connection = $connection;
        }

        public function read_records() {
            $query = $this -> connection -> prepare("SELECT * FROM images");
            $query -> execute();
            $this -> records = $query -> fetchall();
        }

        public function read_record() {
            $query = $this -> connection -> prepare("SELECT * FROM images WHERE id = :id");
            $query -> bindParam(":id", $id);
            $query -> execute();
            $this -> record = $query -> fetch(PDO::FETCH_ASSOC);
        }

        public function create_record($unsplash_url, $path, $filename, $location, $description) {
            $query = $this -> connection -> prepare("INSERT INTO images (unsplash_url, path, filename, location, description) VALUES (:unsplash_url, :path, :filename, :location, :description)");
            $query -> bindParam(":unsplash_url", $unsplash_url);
            $query -> bindParam(":path", $path);
            $query -> bindParam(":filename", $filename);
            $query -> bindParam(":location", $location);
            $query -> bindParam(":description", $description);
            $query -> execute();
            $this -> record["id"] = $this -> connection -> lastInsertId();
        }

        public function update_record($unsplash_url, $location, $description) {
            $query = $this -> connection -> prepare("UPDATE images SET unsplash_url = :unsplash_url, path = :path, filename = :filename, location = :location, description = :description WHERE id = :id");
            $query -> bindParam(":unsplash_url", $unsplash_url);
            $query -> bindParam(":path", $this -> record["path"]);
            $query -> bindParam(":filename", $this -> record["filename"]);
            $query -> bindParam(":location", $location);
            $query -> bindParam(":description", $description);
            $query -> bindParam(":id", $this -> record["id"]);
            $query -> execute();
        }

        public function delete_record() {
            $query = $this -> connection -> prepare("DELETE FROM images WHERE id = :id");
            $query -> bindParam(":id", $this -> record["id"]);
            $query -> execute();
        }

    }

    # create demo object
    $demo = new Demo($connection);

    # reads records in database
    $demo -> read_records();

    display_all_records($demo);

    # creates record in database
    $unsplash_url = "https://unsplash.com/photos/UoqAR2pOxMo";
    $path = "assets/img/UoqAR2pOxMo.jpeg";
    $filename = "UoqAR2pOxMo.jpeg";
    $location = "Da Nang, Vietnam";
    $description = "The Non Nuoc beach is located at the foot of the Marble Mountains and extends over 5 km. This beach has calm waves and crystal clear blue water all year round. You can also eat locally caught fresh fish at one of the restaurants. It is also an ideal place for sports such as surfing, windsurfing, volleyball, etc.";
    $demo -> create_record($unsplash_url, $path, $filename, $location, $description);

    display_all_records($demo);

    # updates record in database
    $unsplash_url = $demo -> record["unsplash_url"];
    $location = $demo -> record["location"];
    $description = "Son Tra peninsula is located about 8 km from the city center and has many beautiful beaches such as But beach, Tien Sa beach, Nam beach, Rang beach, Bac beach and Con beach. These beaches are all very beautiful at the foot of mountains with jungle and clear blue sea. Apart from relaxing on the beach and swimming, you can also go into the jungle, visit pagodas, ride a scooter around the peninsula and snorkel.";
    $demo -> update_record($unsplash_url, $location, $description);

    display_all_records($demo);

    # deletes record in database
    $demo -> delete_record();

    display_all_records($demo);

    # displays all records in database
    function display_all_records($demo) {
        $demo -> read_records();
        var_dump($demo -> records);
    }

?>

