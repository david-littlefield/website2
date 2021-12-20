<?php

    require_once("includes/classes/Image.php");
    require_once("includes/classes/Image_Grid_Item.php");

    class Image_Grid {

        private $connection;

        public function __construct($connection) {
            $this -> connection = $connection;
        }

        public function create($images = null) {
            if ($images == null) {
                return $this -> generate_items();
            } else {
                return $this -> generate_items_from_images($images);
            }
        }

        public function generate_items() {
            $query = $this -> connection -> prepare("SELECT * FROM images");
            $query -> execute();
            $count = $query -> rowCount();
            $index = 0;
            $html = "";
            $html .= "<row>";
            while ($row = $query -> fetch(PDO::FETCH_ASSOC)) {
                $image = new Image($this -> connection, $row, "");
                $item = new Image_Grid_Item($image);
                $html .= $item -> create();
                $index ++;
                echo $count;
                if ($index % 2 == 0 && $index != $count) {
                    $html .= "</row><row>";
                }
            }
            $html .= "</row>";
            return $html;
        }

        public function generate_items_from_images($images) {
            $index = 0;
            $html = "";
            $html .= "<row>";
            foreach($images as $image) { 
                $image = new Image($this -> connection, $image, "");
                $item = new Image_Grid_Item($image);
                $html .= $item -> create();
                $index ++;  
                if ($index % 2 == 0 && $index != count($images)) {
                    $html .= "</row><row>";
                }
            }
            $html .= "</row>";
            return $html;
        }
    }

?>