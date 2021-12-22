<?php

    require_once("includes/classes/Image.php");
    require_once("includes/classes/Grid_Item.php");

    class Grid {

        private $connection;

        public function __construct($connection) {
            $this -> connection = $connection;
        }

        public function create() {
            $query = $this -> connection -> prepare("SELECT * FROM images");
            $query -> execute();
            $count = $query -> rowCount();
            $index = 0;
            $html = "";
            $html .= "<row>";
            while ($row = $query -> fetch(PDO::FETCH_ASSOC)) {
                $image = new Image($this -> connection, $row);
                $grid_item = new Grid_Item($image);
                $html .= $grid_item -> create();
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