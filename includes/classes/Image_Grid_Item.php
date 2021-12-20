<?php

    class Image_Grid_Item {

        private $image;

        public function __construct($image) {
            $this -> image = $image;
        }

        public function create() {
            $url = $this -> image -> get_url();
            $path = $this -> image -> get_path();
            $filename = $this -> image -> get_filename();
            $location = $this -> image -> get_location();
            $description = $this -> image -> get_description();
            return "<div class='col-md-6 portfolio-item'>
                        <a href='$url'>
                            <img class='img-responsive' loading='eager' src='$path' srcset_placeholder='media/555/$filename  1024w, media/555/$filename 640w, media/225/$filename  320w' width='555' height='370'>
                        </a>
                        <h3>
                            <a href='$url'>$location</a>
                        </h3>
                        <p>
                            $description
                        </p>
                    </div>";
        }

    }

?>