<?php 
    require_once("includes/classes/Processor.php"); 
    require_once("includes/classes/Image.php"); 
    require_once("includes/configuration.php");
    require_once("includes/header.php"); 

    if (isset($_GET["id"])) {
        $image = new Image($connection, "", $_GET["id"]);
    }

    if (isset($_POST["save_button"])) {
        $updated = $image -> update_record(
            $_POST["unsplash_input"],
            $_POST["location_input"],
            $_POST["description_input"]
        );
        if (!$updated) {
            echo "Could not update record";
            exit();
        }
        header("Location: /");
    }

    if (isset($_POST["upload_button"])) {
        $processor = new Processor($connection);
        $uploaded = $processor -> upload(
            $_POST["unsplash_input"],
            $_POST["location_input"],
            $_POST["description_input"]
        );
        if (!$uploaded) {
            echo "Could not create record";
            exit();
        }
        header("Location: /");
    }

    if (isset($_POST["cancel_button"])){
        header("Location: /");
    }

    if (isset($_POST["delete_button"])) {
        $id = $image -> get_id();
        echo "\n" . $id . "\n";
        if (!$image -> delete($id)) {
            echo "Could not delete image";
            exit();
        }
        echo "\n" . "done" . "\n";
        #header("Location: /index.php");
    }

    require_once("includes/footer.php"); 

?>