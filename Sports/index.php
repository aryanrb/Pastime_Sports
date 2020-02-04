<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
    <title>Pastime Sports</title>

</head>
<body>
    <?php
        $conn = mysqli_connect("localhost","root","");
        $Databse = mysqli_select_db($conn,"pastime_sports");
        if (!$Databse) {
        header("location: setup.php");
    }
    ?>
    <?php 
        session_start();
        include 'nav.php';
    ?>
    
<div class="container-fluid px-0">

    <!-- Image Slider from here -->
    <div class="imgSlider">
        <!-- <img id="img" class="img-fluid" src="images/Sports1.jpg" alt=""> -->
        <img id="img" src="images/Sports1.jpg" alt="">
        <div id="leftMover" onclick="slide(-1)" onmouseover="effectLeft()" onmouseout="effectLeftOut()"><img src="images/left.png" alt=""></div>
        <div id="rightMover" onclick="slide(1)" onmouseover="effectRight()" onmouseout="effectRightOut()"><img src="images/right.png" alt=""></div>
    </div>

    <div class="container bg-secondary mt-3">
        <div class="row p-1">
            <div class="col-md-3">
                <label class="display-4">About Us</label>
            </div>
            <div class="col-md-9 p-2 text-justify">
                <p> Pastime Sports need a dynamic website to attract new donators to the
                     website which is funded through donations and advertisements. The 
                     website needs to include member login which records invalid login 
                     attempts and locks the user out after 3 attempts. The reset should 
                     be allowed after 3 minutes. You have been commissioned by the owners
                     to produce a web-based application, which will enable members to find 
                     out about the group and to join as an annual member. The website must 
                     be able to be viewed on mobile devices including at least two different 
                     devices.
                </p>

            </div>
        </div>
    </div>

</div>

<div class="container visc">
    <?php
        // Update Query for Visitor Counter
        $counter_query="UPDATE counter SET count = count+1";
        $execute=$connection->query($counter_query);

        // Select Query for Visitor Counter
        $counter_query="SELECT count FROM counter WHERE count_id = '1'";
        $count_value = $connection->query($counter_query);

        //For user information for expiry date
        if(isset($_SESSION['login']))
        {
            $member = $_SESSION['user'];
            $query_selMember = "SELECT * FROM members WHERE user = '$member'";
            $member_data = $connection->query($query_selMember);

            $resDate = $member_data->fetch_assoc();
        }


        while($result=$count_value->fetch_assoc())
        {
            echo"
                <div class='row pt-2 pb-1'>
                    <div class='col-md-6 text-center'>
                        <label class='h4 text-success'>Total Visitors: ".$result['count']."</label>
                    </div>
                    <div class='col-md-6 text-right'>
                        <small class='text-white text-right'>Expiring on: ".$resDate['endDate']."</small>
                    </div>
                </div>";
        }
        
    ?>
</div>
    <?php
        include 'chat.php';
        include 'footer.php';
    ?>


    <!-- Java Script for Image Slider -->
    <script>
        var imgCount = 1;
        var total = 4;
        //Automated sliding of images
        setInterval(function(){
            var images = document.getElementById("img");
            imgCount = imgCount + 1;
            
            if(imgCount > total)
            {
                imgCount = 1;
            }
            images.src = "images/Sports"+imgCount+".jpg";
        },4000);
        //Manual sliding of images
        function slide(n){
            var images = document.getElementById("img");
            imgCount = imgCount + n;
            
            if(imgCount > total)
            {
                imgCount = 1;
            }
            if(imgCount < 1)
            {
                imgCount = total;
            }
            images.src = "images/Sports"+imgCount+".jpg";
        }
        function effectLeft(){
            document.getElementById("leftMover").style.background="grey";
            document.getElementById("leftMover").style.opacity="0.5";
        }
        function effectLeftOut(){
            document.getElementById("leftMover").style.background="";
            document.getElementById("leftMover").style.opacity="0.7";
        }
        function effectRight(){
            document.getElementById("rightMover").style.background="grey";
            document.getElementById("rightMover").style.opacity="0.5";
        }
        function effectRightOut(){
            document.getElementById("rightMover").style.background="";
            document.getElementById("rightMover").style.opacity="0.7";
        }
    </script>
</body>
</html>