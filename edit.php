<?php 
    require_once("includes/classes/Image.php");
    require_once("includes/classes/Image_Upload_Data.php");
    require_once("includes/classes/Grid_Item.php");
    require_once("includes/classes/Form_Provider.php");
    require_once("includes/configuration.php");
    require_once("includes/header.php");

    if (!isset($_GET["id"])) {
        echo "No id was detected";
        exit();
    }

    $image = new Image($connection, "", $_GET["id"]);

    $details_message = "";
    
    #if (isset($_POST["save_button"])) {
    #    $image_upload_data = new Image_Upload_Data(
    #        $_POST["unsplash_input"],
    #        $_POST["path_input"],
    #        $_POST["filename_input"],
    #        $_POST["location_input"],
    #        $_POST["description_input"]
    #    );
    #    if ($image_upload_data -> update_details($connection, $image -> get_id())) {
    #        $details_message = "<div class='alert alert-success'>
    #                                <strong>SUCCESS!</strong> Details updated successfully!
    #                            </div>";
    #        $image = new Image($connection, $_GET["id"]);
    #
    #    }
    #    else {
    #        $details_message = "<div class='alert alert-danger'>
    #                                <strong>ERROR!</strong> Could not load image details
    #                            </div>";
    #    }
    #}

?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <small>Edit</small>
            </h1>
        </div>
    </div>

    <div class="container">
        <div class="message">
            <?php
                echo $details_message
            ?>
        </div>
        <div class="row">
            <div class='col-md-6 portfolio-item'>
                <img class='img-responsive' loading='eager' src='<?php echo $image -> get_path(); ?>' srcset_placeholder='media/555/<?php echo $image -> get_filename(); ?>  1024w, media/555/<?php echo $image -> get_filename(); ?> 640w, media/225/<?php $image -> get_filename(); ?>  320w' width='555' height='370'>
            </div>
            <div class='col-md-6 portfolio-item'>
                <?php
                    $form_provider = new Form_Provider($connection);
                    echo $form_provider -> create_edit_form($image);
                ?>
            </div>
        </div>
    </div>

<?php 
    require_once("includes/footer.php");
?>