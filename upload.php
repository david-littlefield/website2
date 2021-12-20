<?php 
    require_once("includes/header.php"); 
    require_once("includes/classes/Video_Details_Form_Provider.php"); 
?>

    <div class="column">
        <?php
            $form_provider = new Image_Details_Form_Provider($connection);
            echo $form_provider -> create_upload_form(); 
        ?>
    </div>

    <script>
        $("form").submit(function() {
            $("#loading_modal").modal("show");
        });
    </script>

    <div class="modal fade" id="loading_modal" tabindex="-1" role="dialog" aria-labelledby="loading_modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    Please wait. This should only take a moment.
                    <img src="assets/images/icons/loading-spinner.gif">
                </div>
            </div>
        </div>
    </div>

<?php 
    require_once("includes/footer.php"); 
?>