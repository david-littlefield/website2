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
            $headers = get_headers($url, true);
            if (!$this -> is_valid_type($file_type)) {
                $content_type = $this -> resolve_content_type($headers);
                if (!$this -> is_valid_type($content_type)) {
                    echo "Invalid file type";
                    return false;
                }
                $filename = $random_id . "." . $content_type;
                $path = "assets/images/" . $filename;
                $source_url = $this -> resolve_source_url($headers);
                echo file_get_contents($source_url);
                var_dump(file_get_contents($source_url));
                if (false) {
                    echo "Download image failed";
                    return false;
                }
                if (!$this -> insert_image_data($url, $path, $filename, $location, $description)) {
                    echo "Insert query failed";
                    return false;
                }
                return true;
            }
            $filename = $random_id . "." . $file_type;
            $path = "assets/images/" . $filename;
            if (!$this -> download_file($url, $path)) {
                echo "Download image failed";
                return false;
            }
            if (!$this -> insert_image_data($url, $path, $filename, $location, $description)) {
                echo "Insert query failed";
                return false;
            }
            return true;
        }

        public function resolve_content_type($headers) {
            $content_type = end($headers["Content-Type"]);
            $content_type = explode("/", $content_type);
            $content_type = end($content_type);
            $content_type = strtolower($content_type);
            return $content_type;
        }

        public function resolve_source_url($headers) {
            $source_url = $headers["Location"];
            $source_url = explode("?", $source_url);
            $source_url = reset($source_url);
            return $source_url;
        }

        public function download_file($url, $path) {
            $curl_handler = curl_init($url);
            $file_pointer = fopen($path, 'wb');
            curl_setopt($curl_handler, CURLOPT_FILE, $file_pointer);
            curl_setopt($curl_handler, CURLOPT_HEADER, 0);
            curl_exec($curl_handler);
            curl_close($curl_handler);
            fclose($file_pointer);
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