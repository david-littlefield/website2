<?php

    class Image_Detail_Form_Provider {

        private $connection;

        public function __construct($connection) {
            $this -> connection = $connection;
        }

        public function create_upload_form() {
            $url_text_field = $this -> create_url_text_field(null);
            $location_text_field = $this -> create_location_text_field(null);
            $description_text_field = $this -> create_description_text_field(null);
            $upload_button = $this -> create_upload_button();
            return "<form action='processing.php' method='POST' enctype='multipart/form-data'>
                        $url_text_field
                        $location_text_field
                        $description_text_field
                        $upload_button
                    </form>";
        }

        public function create_url_text_field($value) {
            if ($value == null) {
                $value = "";
            }
            return "<div class='form-group'>
                    <input class='form-control' type='text' placeholder='Url' name='url_input' value='$value'> 
                </div>";
        }

        public function create_location_text_field($value) {
            if ($value == null) {
                $value = "";
            }
            return "<div class='form-group'>
                    <input class='form-control' type='text' placeholder='Location' name='location_input' value='$value'> 
                </div>";
        }

        public function create_description_text_field($value) {
            if ($value == null) {
                $value = "";
            }
            return "<div class='form-group'>
                        <textarea class='form-control' placeholder='Description' name='description_input' rows='3' resize='none'>$value</textarea> 
                    </div>";
        }

        private function create_upload_button() {
            return "<button type='submit' class='btn btn-primary' name='upload_button'>Upload</button>";
        }

    }

?>
