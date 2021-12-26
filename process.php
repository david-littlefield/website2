<?php 
    require_once("includes/classes/Processor.php"); 
    require_once("includes/classes/Record.php"); 
    require_once("includes/configuration.php");
    require_once("includes/header.php"); 

    if (isset($_GET["id"])) {
        $record = new Record($connection, "", $_GET["id"]);
    }

    $processor = new Processor($connection);

    if (isset($_POST["save_button"])) {
        $updated = $record -> update(
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
        $record_deleted = $record -> delete();
        if (!$record_deleted) {
            echo "Could not delete record";
            exit();
        }
        $file_deleted = $processor -> delete_file($record -> get_path());
        if (!$file_deleted) { 
            echo ("File could not be deleted"); 
        }
        header("Location: /");
    }

    require_once("includes/footer.php"); 

?>