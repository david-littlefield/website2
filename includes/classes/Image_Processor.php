<?php

    class Image_Processor {

        private $connection;
        private $allowed_types = array("jpeg", "jpg", "webp");

        public function __construct($connection) {
            $this -> connection = $connection;
        }



        public function upload($upload_data) {
            $random_id = uniqid();
            $url = $upload_data -> url;
            $location = $upload_data -> location;
            $description = $upload_data -> description;
            $file_type = pathinfo($url, PATHINFO_EXTENSION);
            if (!is_valid_type($file_type)) {
                $content_type = resolve_content_type($url);
                if (!is_valid_type($content_type)) {
                    echo "Invalid file type";
                    return false;
                }
                $filename = $random_id . "." . $content_type;
            } else {
                $filename = $random_id . "." . $file_type;
            }
            $path = "assets/images/" . $filename;
            $data = file_get_contents($url);
            if (file_put_contents($path, $data)) {
                if (!$this -> insert_image_data($url, $path, $filename, $location, $description)) {
                    echo "Insert query failed";
                    return false;
                }
                return true;
            }
        }

        public function resolve_content_type($url) {
            $headers = get_headers($url, true);
            $content_type = end($headers["Content-Type"]);
            $content_type = explode("/", $content_type);
            $content_type = end($content_type);
            $content_type = strtolower($content_type);
            return $content_type;
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