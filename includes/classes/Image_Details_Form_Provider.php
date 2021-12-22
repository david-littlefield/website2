<?php

    class Image_Details_Form_Provider {

        private $connection;

        public function __construct($connection) {
            $this -> connection = $connection;
        }

        public function create_upload_form() {
            $unsplash_url_text_field = $this -> create_unsplash_url_text_field(null);
            $location_text_field = $this -> create_location_text_field(null);
            $description_text_field = $this -> create_description_text_field(null);
            $upload_button = $this -> create_upload_button();
            return "<form action='process.php' method='POST' enctype='multipart/form-data'>
                        $unsplash_url_text_field
                        $location_text_field
                        $description_text_field
                        $upload_button
                    </form>";
        }

        public function create_edit_form($image) {
            $unsplash_url_text_field = $this -> create_unsplash_url_text_field($image -> get_unsplash_url());
            $location_text_field = $this -> create_location_text_field($image -> get_location());
            $description_text_field = $this -> create_description_text_field($image -> get_description());
            $save_button = $this -> create_save_button();
            return "<form action='process.php' method='POST' enctype='multipart/form-data'>
                        $unsplash_url_text_field
                        $location_text_field
                        $description_text_field
                        $save_button
                    </form>";
        }

        public function create_unsplash_url_text_field($value) {
            if ($value == null) {
                $value = "";
            }
            return "<div class='form-group'>
                    <input class='form-control' type='text' placeholder='Unsplash URL' name='unsplash_input' value='$value'> 
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
                        <textarea class='form-control' placeholder='Description' name='description_input' rows='5' style='resize: none'>$value</textarea> 
                    </div>";
        }

        private function create_upload_button() {
            return "<button type='submit' class='btn btn-primary' name='upload_button'>Upload</button>";
        }

        private function create_save_button() {
            return "<button type='submit' class='btn btn-primary' name='save_button'>Save</button>";
        }

    }

?>