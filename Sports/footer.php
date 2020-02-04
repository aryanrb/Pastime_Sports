<?php 
    include 'connection.php';

    if(isset($_POST['btnNewsletter']))
    {
        $email = $_POST['txtNewsletter'];
        $query_subscribe = "INSERT INTO subscriber Values('','$email')";
        $connection->query($query_subscribe);
    }
?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css">

<!-- footer form here -->
<div class="container-fluid"> 
    <footer class="row text-center pt-5">
    <div class="foot col-sm-4 mb-3">
        <h2> 
            <a href="index.html">
                <span class="ps_icon"><img src="images/psLogo.png" alt="logo"></span> 
                    Pastime Sports 
            </a>
        </h2>
        <div class="d-flex justify-content-center">
            <div class="links address text-left">
                <p> <i class="fa fa-map-marker"></i> Balaju, Kathmandu</p>
                <p> <i class="fa fa-envelope-o"></i> info@pastime.com</p>
                <p> <i class="fa fa-phone"></i> +977-9860046024</p>
                <p> <i class="fa fa-fax"></i> (123) 456-7890</p>
            </div>
        </div>
    </div>
    <div class="foot col-sm-5">
        <h2>Newsletter</h2>
        <p>Join with us to get regular updates.</p>
        <form method="post">
            <div class="input-group nlForm">
                <input type="text" class="form-control" name="txtNewsletter" placeholder="Email Address" required>
                <div class="input-group-append">
                    <input type="submit" class="form-control bg-danger" name="btnNewsletter" value="Subscribe">
                </div>
            </div>
        </form>
        <div class="smLinks d-flex justify-content-around mt-5 mb-3 ">
            <ul>
                <li><a href="https://www.facebook.com"><img src="images/facebook.png" alt="facebook_icon"></a></li>
                <li><a href="https://www.instagram.com"><img src="images/instagram.png" alt="instagram_icon"></a></li>
                <li><a href="https://www.skype.com"><img src="images/skype.png" alt="skype_icon"></a></li>
                <li><a href="https://www.twitter.com"><img src="images/twitter.png" alt="twitter_icon"></a></li>
                <li><a href="https://www.linkedin.com"><img src="images/linkedin.png" alt="linkedin_icon"></a></li>
                <li><a href="https://www.tumblr.com"><img src="images/tumblr.png" alt="tubmlr_icon"></a></li>
            </ul>
        </div>
    </div>
    <div class="foot col-sm-3">
        <h2>Quick Links</h2>
        <div class="row text-center">
            <div class="col-sm-6">
                <p><a href="index.php">Home</a></p>
                <p><a href="profile.php">Profile</a></p>
                <p><a href="sports.php">Sports</a></p>
            </div>
            <div class="col-sm-6">
                <p><a href="events.php">Events</a></p>
                <p><a href="forum.php">Forum</a></p>
                <p><a href="index.php">Donation</a></p>
            </div>
        </div>
    </div>
    </footer>



    <!-- Lower footer from here -->
    <div class="lower-footer row text-left">
        <div class="col-sm-12 mt-2">
            <label>copyright &copy 2018 Aryan Rajbhandari. All right reserved </label>
        </div>
    </div>
</div>