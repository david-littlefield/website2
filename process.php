<?php 
    require_once("includes/classes/Image_Processor.php"); 
    require_once("includes/classes/Image.php"); 
    require_once("includes/configuration.php");
    require_once("includes/header.php"); 

    $image = new Image($connection, "", $_GET["id"]);

    if (isset($_POST["save_button"])) {
        $updated = $image -> update_record(
            $_POST["unsplash_input"],
            $_POST["location_input"],
            $_POST["description_input"]
        );
        if ($updated) {
            header("Location: /");
            exit();
        }
    }

    if (isset($_POST["upload_button"])) {
        # prepare data
        # download image
        # create record
        $image = new Image($connection);
    }

    if (isset($_POST["upload_button"])) {
        $image_upload_data = new Image_Upload_Data(
            $_POST["unsplash_input"],
            "",
            "",
            $_POST["location_input"], 
            $_POST["description_input"]
        );

        $image_processor = new Image_Processor($connection);
        $was_uploaded = $image_processor -> upload($image_upload_data);

        if (!$was_uploaded) {
            echo "Upload was unsuccessful";
        } else {
            #header("Location: index.php");
        }
    }

    if (isset($_POST["delete_button"])){
        echo "delete";
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