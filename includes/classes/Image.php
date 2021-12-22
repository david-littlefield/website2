<?php

    class Image {

        private $connection;
        private $data;

        public function __construct($connection, $data = [], $id = "") {
            $this -> connection = $connection;
            if (!empty($data)) {
                $this -> load_record($data);
            }
            elseif (!empty($id)) {
                $this -> data["id"] = $id;
                $this -> read_record($id);
            }
        }

        public function load_record($data) {
            if (is_array($data)) {
               $this -> data = $data;
            }
        }

        public function read_record() {
            $query = $this -> connection -> prepare("SELECT * FROM images WHERE id = :id");
            $query -> bindParam(":id", $this -> data["id"]);
            $query -> execute();
            $data = $query -> fetch (PDO::FETCH_ASSOC);
            $this -> data = $data;
        }

        public function update_record($unsplash_url, $location, $description) {
            $query = $this -> connection -> prepare("UPDATE images SET unsplash_url = :unsplash_url, path = :path, filename = :filename, location = :location, description = :description WHERE id = :id");
            $query -> bindParam(":unsplash_url", $unsplash_url);
            $query -> bindParam(":path", $this -> data["path"]);
            $query -> bindParam(":filename", $this -> data["filename"]);
            $query -> bindParam(":location", $location);
            $query -> bindParam(":description", $description);
            $query -> bindParam(":id", $this -> data["id"]);
            return $query -> execute();
        }

        public function delete_record() {
            $query = $this -> connection -> prepare("DELETE FROM images WHERE id = :id");
            $query -> bindParam(":id", $this -> data["id"]);
            return $query -> execute();
        }

        public function get_id() {
            return $this -> data["id"];
        }

        public function get_unsplash_url() {
            return $this -> data["unsplash_url"];
        }
        
        public function get_path() {
            return $this -> data["path"];
        }
        
        public function get_filename() {
            return $this -> data["filename"];
        }
        
        public function get_location() {
            return $this -> data["location"];
        }
        
        public function get_description() {
            return $this -> data["description"];
        }

    }

?>