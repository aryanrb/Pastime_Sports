<link rel="icon" href="images/psLogo.png">

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<!-- <link rel="stylesheet" href="css/style.css"> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="js/jquery.js"></script>
<script src="js/modalJquery.js"></script>
<script src="js/bootstrap.min.js"> </script>

<?php
    include 'connection.php';

    //To check if the user membership is expired or not
    if(isset($_SESSION['user']))
    {
        $user = $_SESSION['user'];
        $query_sel = "SELECT * FROM members WHERE user = '$user'";
        $res = $connection->query($query_sel);
        $data = $res->fetch_assoc();
    
        $expDate = $data['endDate'];
        $today = date("Y-m-d");
        if($today >= $expDate)
        {
            $query_delMember = "DELETE FROM members WHERE user = '$user'";
            $connection->query($query_delMember);   
        }
    }

    if(isset($_POST['btnLogin']))
    {
        $name = $_POST['lName'];
        $pass = $_POST['lPass']; 
        if(isset($_COOKIE[$name]) && $_COOKIE[$name] >= 3)
        {
            echo "You have been blocked for 3 minutes";
            die();
        }
        $query_login = "select * from memberprofile where uname = '$name' && password = '$pass'";
        $data = $connection->query($query_login);
        if($data->num_rows >= 1)
        {
            $res = $data->fetch_assoc();
            $_SESSION['login'] =$res['id'];
            $_SESSION['user'] =$res['uname'];
            $_SESSION['uType'] =$res['type'];
        }
        else
        {
            setcookie($name,1);
            if(isset($_COOKIE[$name]))
            {
                setcookie($name,$_COOKIE[$name]+1,time()+180);
                $left = 3 - $_COOKIE[$name];
                echo"<div class='bg-danger text-white text-center loginFail'>Login Failed. Wrong Input!! Try Left: ".$left."</div>";
            }
            else
            {
                echo"<div class='bg-danger text-white text-center loginFail'>Login Failed. Wrong Input!!</div>";
            }
        }
    }

?>

<div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"> <span><img src="images/psLogo.png" alt=""></span> <label class="h3"> Pastime Sports </label></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a href="index.php" class="nav-link" id="ihome"> 
            <span class="imgNav" id="home"></span> 
            <div class="linkLabel">Home</div> 
        </a>
      </li>
      <li class="nav-item">
        <a href="event.php" class="nav-link" id="ievents"> 
            <span class="imgNav" id="events"></span> 
            <div class="linkLabel">Events</div> 
        </a>
      </li>
      <li class="nav-item">
        <a href="sports.php" class="nav-link" id="isports"> 
            <span class="imgNav" id="sports"></span> 
            <div class="linkLabel">Sports</div> 
        </a>
      </li>
      <li class="nav-item" <?php if(!isset($_SESSION['login'])) {echo "hidden";} ?>>
        <a href="forum.php" class="nav-link" id="iforum"> 
            <span class="imgNav" id="forum"></span> 
            <div class="linkLabel">Forum</div> 
        </a>
      </li>
      <li class="nav-item dropdown" <?php 
                    if(!isset($_SESSION['uType']) || $_SESSION['uType']!='admin') {
                            echo "hidden";
                        }
                        ?> >
        <a class="nav-link dropdown" id="imore" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false">
            <span class="imgNav" id="more"></span> 
            <div class="linkLabel">More</div> 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="adminSports.php">Add Sports</a>
          <a class="dropdown-item" href="adminEvents.php">Add Events</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="memberRequest.php">Member Requests</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown" id="ilogin" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" 
                                    aria-haspopup="true" aria-expanded="false">
            <span class="imgNav" id="login"></span> 
            <div class="linkLabel"><?php if(isset($_SESSION['user'])) { echo $_SESSION['user'];} else { echo'Profile';}?></div>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#loginModal" data-whatever="@mdo" 
                    <?php if(isset($_SESSION['login'])) {echo 'hidden';}?>>Login/SignUp</a>
            <a class="dropdown-item" href="profile.php" <?php if(!isset($_SESSION['login'])) {echo 'hidden';}?>>Profile</a>            
            <a class="dropdown-item" href="beMem.php" <?php if(!isset($_SESSION['login']) || 
                    $_SESSION['uType']=='member' || $_SESSION['uType']=='admin') {echo 'hidden';}?>>Be Member</a>
            <a class="dropdown-item" href="reMem.php" <?php if(!isset($_SESSION['login']) || 
                    $_SESSION['uType']=='user' || $_SESSION['uType']=='admin') {echo 'hidden';}?>>Renew Member</a>
            <a class="dropdown-item" href="logout.php" <?php if(!isset($_SESSION['login'])) {echo 'hidden';}?>>Log out</a>
        </div>
      </li>
    </ul>
</nav>

    <!-- Login and Sign up modal -->
    <div class="modal fade" id="loginModal" role="dialog">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header">
                    <div class="modal-title">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#" class="active nav-link aLogin">Login</a>   
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link aSignUp">Sign Up</a>   
                            </li>
                        </ul>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>

                <!-- Modal Body -->
            <div class="modal-body">
                <form method="post">

                    <!-- Login Division -->
                    <div class="login">
                        <label class="sr-only" for="loginUname">Username</label>
                        <div class="input-group mb-4 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-user ico">.</span>
                                </div>
                            </div>
                            <input type="text" name="lName" class="form-control" id="loginUname" placeholder="Username" required>
                        </div>

                        <label class="sr-only" for="loginPass">Password</label>
                        <div class="input-group mb-4 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-key ico"></span>
                                </div>
                            </div>
                            <input type="password" name="lPass" class="form-control" id="loginPass" placeholder="Password" required>
                        </div>

                        <!-- checkbox -->
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <a href="#">Forget Password?</a>
                            </div>
                        </div>
                        <!-- Checkbox upto here-->
                        <div class="btnLogin">
                            <input type="submit" name="btnLogin" class="btn btn-primary container" value="Login">
                        </div>
                    </div>
                </form>

                    <!-- Sign Up Division -->
                <form method="post" action="signup.php">                
                    <div class="signup form-row">
                        <label class="sr-only" for="signupFName">First Name</label>
                        <div class="input-group nomar mb-2 col-md-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="ico"> Fn</span>
                                </div>
                            </div>
                            <input type="text"  name="sFname" class="form-control" id="signupFName" placeholder="First Name" required>
                        </div>

                        <label class="sr-only" for="signupLName">Last Name</label>
                        <div class="input-group nomar mb-2 col-md-6">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="ico"> Ln </span>
                                </div>
                            </div>
                            <input type="text" name="sLname" class="form-control" id="signupLName" placeholder="Last Name" required>
                        </div>
                        
                        <label class="sr-only" for="signupEmail">Email</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-envelope ico"></span>
                                </div>
                            </div>
                            <input type="email" name="sEmail" class="form-control" id="signupEmail" placeholder="Email" required>
                        </div>
                        
                        <label class="sr-only" for="signupDate">Date of birth</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-calendar ico"></span>
                                </div>
                            </div>
                            <input type="date" name="sDob" id="signupDate" class="form-control" required>
                        </div>
                        <label class="sr-only" for="signupPaddress">Postal address</label>
                        <div class="input-group nomar mb-2 col-md-8">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-map-signs ico"></span>
                                </div>
                            </div>
                            <input type="text" name="sPaddress" class="form-control" id="signupPaddress" placeholder="Postal Address" required>
                        </div><label class="sr-only" for="signupPcode">Postal Code</label>
                        <div class="input-group nomar mb-2 col-md-4">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-home ico"></span>
                                </div>
                            </div>
                            <input type="text" name="sPcode" class="form-control" id="signupPcode" placeholder="Postal Code" required>
                        </div><label class="sr-only" for="signupUser">Username</label>
                        <div class="input-group nomar mb-2 mr-2 col-md-8">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-user ico">.</span>
                                </div>
                            </div>
                            <input type="text" name="sUser" class="form-control" onkeyup="CheckUser()" id="signupUser" placeholder="Username" required>
                        </div>

                        <!-- For Unique Username check -->
                        <span class="col-md-3 short px-0" id="cUsername"></span>

                        <label class="sr-only" for="signupPass">Password</label>
                        <div class="input-group nomar mb-2 mr-2 col-md-8">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-key ico"></span>
                                </div>
                            </div>
                            <input type="password" name="sPass" class="form-control" id="signupPass" placeholder="Password" required>
                        </div>

                        <!-- For Password strength check -->
                        <span class="col-md-3 linetext" id="result"></span>
                        
                        <label class="sr-only" for="signupCpass">Confirm Password</label>
                        <div class="input-group nomar mb-3 mr-2 col-md-8">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="fa fa-undo ico"></span>
                                </div>
                            </div>
                            <input type="password" name="sConPass" class="form-control" id="signupCpass" onkeyup="ConfirmPass()" 
                                        placeholder="Confirm Password" required>
                        </div>

                        <!-- For Confirm Password check -->
                        <span class="col-md-3 px-0 linetext" id="confirm"></span>
                    
                        <div class="btnSignUp mt-3 container px-0">
                            <input type="submit" name="btnSignUp" class="btn btn-info container" value="SignUp">
                        </div>
                    </div>
                </form>
            </div>

            </div>
        </div>
    </div>

    <!-- Login and Sign up modal upto here-->

    <!-- Jquery for login/Signup -->
    <script>
	$(document).ready(function () {
        $('.signup').hide();
        $('.btnSignUp').hide();

        $('.nav li a').click(function() {
            $('.nav li a.active').removeClass('active');
            $(this).addClass('active');
        });

        $('.aLogin').click(function()
        {
            $('.login').show(500);
            $('.btnLogin').show(300);
            $('.signup').hide(500);
            $('.btnSignUp').hide(300);
        });

        $('.aSignUp').click(function()
        {
            $('.btnSignUp').show(300);
            $('.signup').show(500);
            $('.btnLogin').hide(300);
            $('.login').hide(500);
        });
    });
    </script>
    <!-- Jquery for login/Signup upto here -->

    <!-- Jquery for Password Strength Checker -->
    <script>
    $(document).ready(function() {
        $('#signupPass').keyup(function() {
            $('#result').html(checkStrength($('#signupPass').val()))
        });
        function checkStrength(password) {
            var strength = 0;
            if (password.length < 6) {
                $('#result').removeClass();
                $('#result').addClass('short');
                return 'Too short';
        }
        if (password.length > 7) strength += 1;
        // If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;
        // If it has numbers and characters, increase strength value.
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1;
        // If it has one special character, increase strength value.
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;
        // If it has two special characters, increase strength value.
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;
        // Calculated strength value, we can return messages   // If value is less than 2
        if (strength < 2) {
            $('#result').removeClass();
            $('#result').addClass('weak');
            return 'Weak'; } 
        else if (strength == 2) {
            $('#result').removeClass();
            $('#result').addClass('good');
            return 'Good';}
        else {
            $('#result').removeClass();
            $('#result').addClass('strong');
            return 'Strong';}
        }
        });
    </script>
    <!-- Jquery for Password Strength Checker upto here -->


    <!-- Ajax for Username checking -->
    <script>
		function CheckUser(){

            var txtUser = document.getElementById("signupUser").value;
			var req = new XMLHttpRequest();
		
            req.onreadystatechange = function(){
                if(req.readyState == 4)
                {
                    document.getElementById('cUsername').innerHTML = req.responseText;
                }
            }
            req.open("GET","checkUser.php?txtValue="+txtUser,true);
            req.send();
		}
	</script>

    <!-- Java script for Confirm Password -->
    <script>
        $("#signupCpass").keyup(function(){
            if($(this).val() == $("#signupPass").val()){
                $("#confirm").html("Password match");
                $("#confirm").css({color:'green'});                
            }
            else{
                $("#confirm").html("Password not match");
                $("#confirm").css({color:'red'});
            }
        });
    </script>
    
    <!-- Java Script for login error -->
    <script>
        $(".loginFail").delay(2000);
        $(".loginFail").hide(500);
    </script>
</div>