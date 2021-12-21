<?php

    class Image_Processor {

        private $connection;
        private $allowed_types = array("jpeg", "jpg", "webp");

        public function __construct($connection) {
            $this -> connection = $connection;
        }

        public function upload($upload_data) {
            $random_id = uniqid();
            $unsplash_url = $upload_data -> unsplash_url;
            $image_url = $unsplash_url . "/download";
            $location = $upload_data -> location;
            $description = $upload_data -> description;
            $file_type = pathinfo($image_url, PATHINFO_EXTENSION);
            $headers = get_headers($image_url, true);
            if (!$this -> is_valid_type($file_type)) {
                $content_type = $this -> resolve_content_type($headers);
                if (!$this -> is_valid_type($content_type)) {
                    echo "Invalid file type";
                    return false;
                }
                $filename = $random_id . "." . $content_type;
                $path = "assets/images/" . $filename;
                $source_url = $this -> resolve_source_url($headers);
                $this -> download_file($source_url, $path);
                if (!file_exists($path)) {
                    echo "Download image failed";
                    return false;
                }
                if (!$this -> insert_image_data($unsplash_url, $path, $filename, $location, $description)) {
                    echo "Insert query failed";
                    return false;
                }
                return true;
            }
            $filename = $random_id . "." . $file_type;
            $path = "assets/images/" . $filename;
            $this -> download_file($url, $path);
            if (!file_exists($path)) {
                echo "Download image failed";
                return false;
            }
            if (!$this -> insert_image_data($unsplash_url, $path, $filename, $location, $description)) {
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
            return $source_url;
        }

        public function download_file($url, $path) {
            $curl = curl_init($url);
            $file_pointer = fopen($path, 'w+');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_FILE, $file_pointer);
            curl_exec($curl);
            curl_close($curl);
            var_dump($path);
            var_dump($file_pointer);
            fclose($file_pointer);
        }
    
        private function is_valid_type($image_type) {
            $lowercased = strtolower($image_type);
            return in_array($lowercased, $this -> allowed_types);
        }

        private function insert_image_data($unsplash_url, $url, $path, $filename, $location, $description) {
            $query = $this -> connection -> prepare("INSERT INTO images (unsplash_url, path, filename, location, description) VALUES (:unsplash_url, :path, :filename, :location, :description)");
            $query->bindParam(":unsplash_url", $unsplash_url);
            $query->bindParam(":path", $path);
            $query->bindParam(":filename", $filename);
            $query->bindParam(":location", $location);
            $query->bindParam(":description", $description);
            return $query->execute();
        }

    }

?>