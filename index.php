<?php

    require_once("includes/configuration.php");
    require_once("includes/classes/Image_Grid.php");
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
                $image_grid = new Image_Grid($connection);
                echo $image_grid -> create();
            ?>
            <div class="row text-center">
                <div class="col-lg-12">
                    <ul class="pagination">
                        
                        <li>
                            <a href="#">«</a>
                        </li>
                        
                        <li class="active">
                            <a href="#">1</a>
                        </li>
                        
                        <li>
                            <a href="#">2</a>
                        </li>
                        
                        <li>
                            <a href="#">3</a>
                        </li>
                        
                        <li>
                            <a href="#">4</a>
                        </li>
                        
                        <li>
                            <a href="#">5</a>
                        </li>

                        <li>
                            <a href="#">»</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <footer>
            <div class="footer-blurb">
                <div class="container">
                    <div class="row">

                        <div class="col-sm-4 footer-blurb-item">
                            <img class="img-circle" loading="lazy" src="http://45.79.166.55/assets/images/7.jpeg" srcset_placeholder="media/100/7.jpeg  1024w, media/100/7.jpeg 640w, media/100/7.jpeg 320w" width="100" height="100">
                            <h3>My Stuff</h3>
                            <p>Upon yielding, kind sea subdue very seed sixth them lesser one lesser there earth days were
                                multiply so sixth gathering fifth that man fowl made.</p>
                            <p><a class="btn btn-primary" href="https://unsplash.com/photos/tNCH0sKSZbA">More Stuff</a></p>
                        </div>

                        <div class="col-sm-4 footer-blurb-item">
                            <img class="img-circle" loading="lazy" src="http://45.79.166.55/assets/images/8.jpeg" srcset_placeholder="media/100/8.jpeg  1024w, media/100/8.jpeg 640w, media/100/8.jpeg 320w" width="100" height="100">
                            <h3>Your Stuff</h3>
                            <p>Upon yielding, kind sea subdue very seed sixth them lesser one lesser there earth days were
                                multiply so sixth gathering fifth that man fowl made.</p>
                            <p><a class="btn btn-primary" href="https://unsplash.com/photos/vkdOhd_oYic">More Stuff</a></p>
                        </div>

                        <div class="col-sm-4 footer-blurb-item">
                            <img class="img-circle" loading="lazy" src="http://45.79.166.55/assets/images/9.jpeg" srcset_placeholder="media/100/9.jpeg  1024w, media/100/9.jpeg 640w, media/100/9.jpeg 320w" width="100" height="100">
                            <h3>Our Stuff</h3>
                            <p>Upon yielding, kind sea subdue very seed sixth them lesser one lesser there earth days were
                                multiply so sixth gathering fifth that man fowl made.</p>
                            <p><a class="btn btn-primary" href="https://unsplash.com/photos/VF4SWxE-MRw">More Stuff</a></p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>

<?php 

    require_once("includes/footer.php"); 

?>

