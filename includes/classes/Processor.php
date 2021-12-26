<?php
    require_once("includes/classes/Record.php");

    class Processor {

        private $connection;
        private $valid_extensions = array("jpeg", "jpg", "webp");

        public function __construct($connection) {
            $this -> connection = $connection;        
        }

        public function upload($unsplash_url, $location, $description) {
            $redirect_url = $unsplash_url . "/download";
            $headers = get_headers($redirect_url, true);
            $extension = $this -> parse_extension($headers);
            if (!$this -> is_valid_extension($extension)) {
                echo "Invalid extension";
                return false;
            }
            $filename = $this -> parse_filename($unsplash_url) . "." . $extension;
            $path = "assets/img/" . $filename;
            $url = $this -> parse_url($headers);
            $this -> download_file($url, $path);
            if (!file_exists($path)) {
                echo "Failed to download image";
                return false;
            }
            $record = new Record($this -> connection);
            if (!$record -> create($unsplash_url, $path, $filename, $location, $description)) {
                echo "Failed to create query";
                return false;
            }
            return true;
        }

        public function parse_extension($headers) {
            $extension = end($headers["Content-Type"]);
            $extension = explode("/", $extension);
            $extension = end($extension);
            $extension = strtolower($extension);
            return $extension;
        }

        public function parse_filename($unsplash_url) {
            $filename = explode("/", $unsplash_url);
            $filename = end($filename);
            return $filename;
        }

        private function is_valid_extension($extension) {
            $lowercased = strtolower($extension);
            return in_array($lowercased, $this -> valid_extensions);
        }

        public function parse_url($headers) {
            $url = $headers["Location"];
            return $url;
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
            fclose($file_pointer);
        }

        public function delete_file($path) {
            return unlink($path);
        }

    }

?>