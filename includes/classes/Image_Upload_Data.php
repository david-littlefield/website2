<?php

    class Image_Upload_Data {

        public $unsplash_url;
        public $path;
        public $filename;
        public $location;
        public $description;

        public function __construct($unsplash_url, $path, $filename, $location, $description) {
            $this -> unsplash_url = $unsplash_url;
            $this -> path = $path;
            $this -> filename = $filename;
            $this -> location = $location;
            $this -> description = $description;
        }

        public function update_details($connection, $id) {
            $query = $connection -> prepare("update images set unsplash_url = :unsplash_url, path = :path, filename = :filename, location =: location, description =: description where id = :id)");
            $query -> bindParam(":unsplash_url", $this -> unsplash_url);
            $query -> bindParam(":path", $this -> path);
            $query -> bindParam(":filename", $this -> filename);
            $query -> bindParam(":location", $this -> location);
            $query -> bindParam(":description", $this -> description);
            return $query -> execute();
        }

    }

?>