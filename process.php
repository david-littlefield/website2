<?php 

    require_once("includes/classes/Image_Upload_Data.php"); 
    require_once("includes/classes/Image_Processor.php"); 
    require_once("includes/classes/Image.php"); 
    require_once("includes/configuration.php");
    require_once("includes/header.php"); 

    if (!isset($_POST["upload_button"])) {
        echo "No file sent to page.";
        exit();
    }

    $image = new Image($connection, "", $_GET["id"]);

    if (isset($_POST["delete_button"])) {
        if (!$image -> delete()) {
            echo "Could not delete image";
            exit();
        }
        header("Location: /");
    }

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
        header("Location: https://www.squidproquo.io/");
    }

    require_once("includes/footer.php"); 

?>