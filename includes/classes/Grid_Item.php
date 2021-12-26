<?php

    class Grid_Item {

        private $record;

        public function __construct($record) {
            $this -> record = $record;
        }

        public function create() {
            $id = $this -> record -> get_id();
            $path = $this -> record -> get_path();
            $filename = $this -> record -> get_filename();
            $location = $this -> record -> get_location();
            $description = $this -> record -> get_description();
            return "<div class='col-md-6 portfolio-item'>
                        <a href='/edit.php?id=$id'>
                            <img class='img-responsive' loading='eager' src='$path' srcset_placeholder='media/555/$filename  1024w, media/555/$filename 640w, media/225/$filename  320w' width='555' height='370'>
                        </a>
                        <h3>
                            <a href='/edit.php?id=$id'>$location</a>
                        </h3>
                        <p>
                            $description
                        </p>
                    </div>";
        }

    }

?>