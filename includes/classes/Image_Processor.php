<?php

    class Image_Processor {

        # declares variables
        private $connection;
        private $file_types = array("jpeg", "jpg", "webp");

        # creates image processor object
        public function __construct($connection) {

            # stores connection to database
            $this -> connection = $connection;
        
        }

        # performs upload using specified input data
        public function upload($input_data) {
            
            # prepares image data
            $unsplash_url = $input_data -> unsplash_url;
            $image_url = $unsplash_url . "/download";
            $location = $input_data -> location;
            $description = $input_data -> description;
            $headers = get_headers($image_url, true);
            $file_type = $this -> get_file_type($headers);
            $filename = uniqid() . "." . $file_type;
            $path = "assets/images/" . $filename;

            # verifies image is approved file type
            if (!$this -> is_valid_file_type($file_type)) {
                echo "Invalid file type";
                return false;
            }

            # downloads image
            $source_url = $this -> get_source_url($headers);
            $this -> download_image($source_url, $path);

            # verifies download was successful
            if (!file_exists($path)) {
                echo "Could not download image";
                return false;
            }
            # verifies database query was successul
            if (!$this -> insert_data_into_database($unsplash_url, $path, $filename, $location, $description)) {
                echo "Could not perform insert query";
                return false;
            }

            # communicates upload was successful
            return true;

        }

        # extracts file type from http headers
        public function get_file_type($headers) {
            $file_type = end($headers["Content-Type"]);
            $file_type = explode("/", $file_type);
            $file_type = end($file_type);
            $file_type = strtolower($file_type);
            return $file_type;
        }

        # extracts source url of image from http headers
        public function get_source_url($headers) {
            $source_url = $headers["Location"];
            return $source_url;
        }

        # downloads image from specified url to specified path using curl
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
    
        # verifies specified file type is an approved file type
        private function is_valid_file_type($file_type) {
            $lowercased = strtolower($file_type);
            return in_array($lowercased, $this -> file_types);
        }

        # inserts specified data into database
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