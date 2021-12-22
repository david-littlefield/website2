<?php

    class Image_Processor {

        private $connection;
        private $file_types = array("jpeg", "jpg", "webp");

        public function __construct($connection) {
            $this -> connection = $connection;        
        }

        public function upload($data) {
            $unsplash_url = $data -> unsplash_url;
            $image_url = $unsplash_url . "/download";
            $location = $data -> location;
            $description = $data -> description;
            $headers = get_headers($image_url, true);
            $file_type = $this -> get_file_type($headers);
            $filename = uniqid() . "." . $file_type;
            $path = "assets/images/" . $filename;
            if (!$this -> is_valid_file_type($file_type)) {
                echo "Invalid file type";
                return false;
            }
            $source_url = $this -> get_source_url($headers);
            $this -> download_image($source_url, $path);
            if (!file_exists($path)) {
                echo "Could not download image";
                return false;
            }
            if (!$this -> insert_data_into_database($unsplash_url, $path, $filename, $location, $description)) {
                echo "Could not perform insert query";
                return false;
            }
            return true;
        }

        public function get_file_type($headers) {
            $file_type = end($headers["Content-Type"]);
            $file_type = explode("/", $file_type);
            $file_type = end($file_type);
            $file_type = strtolower($file_type);
            return $file_type;
        }

        public function get_source_url($headers) {
            $source_url = $headers["Location"];
            return $source_url;
        }

        public function download_image($url, $path) {
            $curl = curl_init($url);
            $file_pointer = fopen($path, 'w+');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_FILE, $file_pointer);
            curl_exec($curl);
            curl_close($curl);
            fclose($file_pointer);
        }
    
        private function is_valid_file_type($file_type) {
            $lowercased = strtolower($file_type);
            return in_array($lowercased, $this -> file_types);
        }

        private function insert_data_into_database($unsplash_url, $path, $filename, $location, $description) {
            $query = $this -> connection -> prepare("INSERT INTO images (unsplash_url, path, filename, location, description) VALUES (:unsplash_url, :path, :filename, :location, :description)");
            $query -> bindParam(":unsplash_url", $unsplash_url);
            $query -> bindParam(":path", $path);
            $query -> bindParam(":filename", $filename);
            $query -> bindParam(":location", $location);
            $query -> bindParam(":description", $description);
            return $query -> execute();
        }

    }

?>