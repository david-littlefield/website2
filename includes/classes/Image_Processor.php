<?php

    class Image_Processor {

        private $connection;
        private $size_limit = 50000000;
        private $allowed_types = array("jpeg", "jpg", "webp");

        public function __construct($connection) {
            $this -> connection = $connection;
        }

        public function upload($image_upload_data) {
            $output_file_directory = "assets/images/";
            $url = $image_upload_data["url"];
            $id = uniqid();
            $extension = pathinfo($url, PATHINFO_EXTENSION);
            $path = $output_file_directory . $id . "." . $extension;
            $filename = $id . "." . $extension;
            $location = $image_upload_data["location"];
            $description = $image_upload_data["description"];
            $is_valid_data = $this -> process_data($image_data, $path);
            if (!$is_valid_data) {
                return false;
            }
            if (file_put_contents($path, file_get_contents($url))) {
                if (!$this -> insert_image_data($url, $path, $filename, $location, $description)) {
                    echo "Insert query failed";
                    return false;
                }
                return true;
            }
        }

        private function process_data($image_data, $path) {
            $image_type = pathinfo($file_path, PATHINFO_EXTENSION);
            if (!$this -> is_valid_size($image_data)) {
                echo "File too large. Must be less than " . $this -> size_limit . "bytes."; 
            }
            else if (!$this -> is_valid_type($image_type)) {
                echo "Invalid file type";
                return false;
            }
            else if ($this -> has_error($image_data)) {
                echo "Error code: " . $image_data["error"];
                return false;
            }
            return true;
        }

        private function is_valid_size($image_data) {
            return $image_data["size"] <= $this -> size_limit;
        }
    
        private function is_valid_type($image_type) {
            $lowercased = strtolower($image_type);
            return in_array($lowercased, $this -> allowed_types);
        }

        private function insert_image_data($url, $path, $filename, $location, $description) {
            $query = $this -> connection -> prepare("INSERT INTO images (url, path, filename, location, description) VALUES (:url, :path, :filename, :location, :description)");
            $query->bindParam(":url", $url);
            $query->bindParam(":path", $path);
            $query->bindParam(":filename", $filename);
            $query->bindParam(":location", $location);
            $query->bindParam(":description", $description);
            return $query->execute();
        }

    }

?>