<?php

    class Image {

        private $connection;
        private $image_data;

        public function __construct($connection, $input_data, $input_id) {
            $this -> connection = $connection;
            if (is_array($input_data)) {
                echo "image a";
                $this -> image_data = $input_data;
            } else {
                echo "image b";
                $query = $this -> connection -> prepare("SELECT * FROM images WHERE id = :id");
                $query -> bindParam(":id", $input_id);
                $query -> execute();
                $image_data = $query -> fetch (PDO::FETCH_ASSOC);
            }
        }

        public function get_id() {
            return $this -> image_data["id"];
        }

        public function get_url() {
            return $this -> image_data["url"];
        }
        
        public function get_path() {
            return $this -> image_data["path"];
        }
        
        public function get_filename() {
            return $this -> image_data["filename"];
        }
        
        public function get_location() {
            return $this -> image_data["location"];
        }
        
        public function get_description() {
            return $this -> image_data["description"];
        }

    }

?>