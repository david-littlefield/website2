<?php

    class Image_Upload_Data {

        public $url;
        public $path;
        public $filename;
        public $location;
        public $description;

        public function __construct($url, $path, $filename, $location, $description) {
            $this -> url = $url;
            $this -> path = $path;
            $this -> filename = $filename;
            $this -> location = $location;
            $this -> description = $description;
        }

        public function update_details($connection, $id) {
            $query = $connection -> prepare("update images set url = :url, path = :path, filename = :filename, location =: location, description =: description where id = :id)");
            $query -> bindParam(":url", $this -> url);
            $query -> bindParam(":path", $this -> path);
            $query -> bindParam(":filename", $this -> filename);
            $query -> bindParam(":location", $this -> location);
            $query -> bindParam(":description", $this -> description);
            return $query -> execute();
        }

    }

?>