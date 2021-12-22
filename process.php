<?php 

    require_once("includes/classes/Image_Upload_Data.php"); 
    require_once("includes/classes/Image_Processor.php"); 
    require_once("includes/classes/Image.php"); 
    require_once("includes/configuration.php");
    require_once("includes/header.php"); 

    $image = new Image($connection, "", $_GET["id"]);

    var_dump($image);

    if (isset($_POST["delete_button"])) {
        if (!$image -> delete($image -> get_id())) {
            echo "Could not delete image";
            exit();
        }
        header("Location: index.php");
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
        header("Location: index.php");
    }

    require_once("includes/footer.php"); 

?>