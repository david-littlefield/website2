<?php

    class Image {

        private $connection;
        private $data;

        public function __construct($connection, $data, $id) {
            $this -> connection = $connection;
            if (is_array($data)) {
                $this -> data = $data;
            } else {
                $query = $this -> connection -> prepare("SELECT * FROM images WHERE id = :id");
                $query -> bindParam(":id", $id);
                $query -> execute();
                $this -> data = $query -> fetch (PDO::FETCH_ASSOC);
            }
        }

        public function delete($id) {
            $this -> connection -> prepare("DELETE FROM images WHERE id = :id");
            $query -> bindParam(":id", $id);
            $result = $query -> execute();
            echo $result;
            return $result;
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