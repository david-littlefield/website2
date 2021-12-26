<?php 
    require_once("includes/classes/Record.php");
    require_once("includes/classes/Grid_Item.php");
    require_once("includes/classes/Form_Provider.php");
    require_once("includes/configuration.php");
    require_once("includes/header.php");

    if (!isset($_GET["id"])) {
        echo "No id was detected";
        exit();
    }

    $record = new Record($connection, "", $_GET["id"]);
?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <small>Edit</small>
            </h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class='col-md-6 portfolio-item'>
                <img class='img-responsive' loading='eager' src='<?php echo $record -> get_path(); ?>' srcset_placeholder='media/555/<?php echo $record -> get_filename(); ?>  1024w, media/555/<?php echo $record -> get_filename(); ?> 640w, media/225/<?php $record -> get_filename(); ?>  320w' width='555' height='370'>
            </div>
            <div class='col-md-6 portfolio-item'>
                <?php
                    $form_provider = new Form_Provider($connection);
                    echo $form_provider -> create_edit_form($record);
                ?>
            </div>
        </div>
    </div>

<?php 
    require_once("includes/footer.php");
?>