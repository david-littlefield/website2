<?php
    require_once("includes/classes/Grid.php");
    require_once("includes/configuration.php");
    require_once("includes/header.php");
?>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <small>Recent</small>
                    </h1>
                </div>
            </div>
            <?php
                $grid = new Grid($connection);
                echo $grid -> create();
            ?>
        </div>

        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="/">«</a>
                    </li>
                    <li class="active">
                        <a href="/">1</a>
                    </li>
                    <li>
                        <a href="/">2</a>
                    </li>
                    <li>
                        <a href="/">3</a>
                    </li>
                    <li>
                        <a href="/">4</a>
                    </li>
                    <li>
                        <a href="/">5</a>
                    </li>
                    <li>
                        <a href="/">»</a>
                    </li>
                </ul>
            </div>
        </div>

        <footer>
            <div class="footer-blurb">
                <div class="container">
                    <div class="row">

                        <div class="col-sm-4 footer-blurb-item">
                            <img class="img-circle" loading="lazy" src="assets/img/tNCH0sKSZbA.jpeg" srcset_placeholder="media/100/tNCH0sKSZbA.jpeg  1024w, media/100/tNCH0sKSZbA.jpeg 640w, media/100/tNCH0sKSZbA.jpeg 320w" width="100" height="100">
                            <h3>My Stuff</h3>
                            <p>Upon yielding, kind sea subdue very seed sixth them lesse    r one lesser there earth days were
                                multiply so sixth gathering fifth that man fowl made.</p>
                            <p><a class="btn btn-primary" href="/">More Stuff</a></p>
                        </div>

                        <div class="col-sm-4 footer-blurb-item">
                            <img class="img-circle" loading="lazy" src="assets/img/vkdOhd_oYic.jpeg" srcset_placeholder="media/100/vkdOhd_oYic.jpeg  1024w, media/100/vkdOhd_oYic.jpeg 640w, media/100/vkdOhd_oYic.jpeg 320w" width="100" height="100">
                            <h3>Your Stuff</h3>
                            <p>Upon yielding, kind sea subdue very seed sixth them lesser one lesser there earth days were
                                multiply so sixth gathering fifth that man fowl made.</p>
                            <p><a class="btn btn-primary" href="/">More Stuff</a></p>
                        </div>

                        <div class="col-sm-4 footer-blurb-item">
                            <img class="img-circle" loading="lazy" src="assets/img/VF4SWxE-MRw.jpeg" srcset_placeholder="media/100/VF4SWxE-MRw.jpeg  1024w, media/100/VF4SWxE-MRw.jpeg 640w, media/100/VF4SWxE-MRw.jpeg 320w" width="100" height="100">
                            <h3>Our Stuff</h3>
                            <p>Upon yielding, kind sea subdue very seed sixth them lesser one lesser there earth days were
                                multiply so sixth gathering fifth that man fowl made.</p>
                            <p><a class="btn btn-primary" href="/">More Stuff</a></p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>

<?php 

    require_once("includes/footer.php"); 

?>

