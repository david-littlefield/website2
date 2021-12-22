<?php

    require_once("includes/classes/Image.php");
    require_once("includes/classes/Image_Grid_Item.php");

    class Image_Grid {

        # declares variable
        private $connection;

        # creates image grid object
        public function __construct($connection) {

            # stores connection to database
            $this -> connection = $connection;

        }

        # creates image grid using data from database
        public function create() {
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
                if ($index % 2 == 0 && $index != $count) {
                    $html .= "</row><row>";
                }
            }
            $html .= "</row>";
            return $html;
        }

    }

?>