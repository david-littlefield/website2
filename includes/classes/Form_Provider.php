<?php

    class Form_Provider {

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

        public function create_edit_form($record) {
            $id = $record -> get_id();
            $unsplash_url_text_field = $this -> create_unsplash_url_text_field($record -> get_unsplash_url());
            $location_text_field = $this -> create_location_text_field($record -> get_location());
            $description_text_field = $this -> create_description_text_field($record -> get_description());
            $save_button = $this -> create_save_button();
            $cancel_button = $this -> create_cancel_button();
            $delete_button = $this -> create_delete_button();
            return "<form action='process.php?id=$id' method='POST' enctype='multipart/form-data'>
                        $unsplash_url_text_field
                        $location_text_field
                        $description_text_field
                        <div class='d-flex'>
                            $save_button
                            $cancel_button
                            $delete_button
                        </div>
                    </form>";
        }

        public function create_unsplash_url_text_field($value) {
            if ($value == null) {
                $value = "";
                $readonly = "";
            } else {
                $readonly = "readonly";
            }
            return "<div class='form-group'>
                    <label>Unsplash URL:</label>
                    <input class='form-control' type='text' placeholder='' name='unsplash_input' value='$value' $readonly> 
                </div>";
        }

        public function create_location_text_field($value) {
            if ($value == null) {
                $value = "";
            }
            return "<div class='form-group'>
                    <label>Location:</label>
                    <input class='form-control' type='text' placeholder='' name='location_input' value='$value'> 
                </div>";
        }

        public function create_description_text_field($value) {
            if ($value == null) {
                $value = "";
            }
            return "<div class='form-group'>
                        <label>Description:</label>
                        <textarea class='form-control' placeholder='' name='description_input' rows='6' style='resize: none'>$value</textarea> 
                    </div>";
        }

        private function create_upload_button() {
            return "<button type='submit' class='btn btn-primary' name='upload_button'>Upload</button>";
        }

        private function create_save_button() {
            return "<button type='submit' class='btn btn-primary' name='save_button'>Save</button>";
        }

        private function create_cancel_button() {
            return "<button type='submit' class='btn btn-default' name='cancel_button'>Cancel</button>";
        }

        private function create_delete_button() {
            return "<button type='submit' class='btn btn-danger' name='delete_button' style='float: right !important'>Delete</button>";
        }

    }

?>