<?php
    session_start();
    include 'nav.php';
    include 'connection.php';

    if(!isset($_SESSION['login']))
    {
        header('location:index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Document</title>

</head>
<body>
    <?php 
        
        if(isset($_POST['btnProfileSave']))
        {
            $pEmail = $_POST['profileEmail'];
            $pAdd = $_POST['profileAddress'];
            $pACode = $_POST['profileACode'];
            $user = $_SESSION['user'];

            
            if(isset($_POST['checkPass']))
            {
                $pass = $_POST['newPassword'];
                $query_updProfile = "UPDATE memberprofile SET email = '$pEmail', postalAddress = '$pAdd', postCode = '$pACode', password ='$pass' WHERE uname = '$user'";
                $connection->query($query_updProfile);
                echo"<div class='bg-success text-white text-center profileUpdate'>Profile Updated</div>";
            
            }
            else
            {
                $query_updProfile = "UPDATE memberprofile SET email = '$pEmail', postalAddress = '$pAdd', postCode = '$pACode' WHERE uname = '$user'";
                $connection->query($query_updProfile);
                echo"<div class='bg-success text-white text-center profileUpdate'>Profile Updated</div>";    
            }
        }
        
        


        $member = $_SESSION['user'];
        $query_selMember = "SELECT * FROM members m, memberprofile mp WHERE mp.uname = m.user and uname = '$member'";
        $member_data = $connection->query($query_selMember);

        $res = $member_data->fetch_assoc();
    ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 mt-2">
                <h2>Pastime Sports Profile</h2>
            </div>
            <div class="col-md-4">

            </div>
        </div>

        <hr>

        <div class="row">

            <!-- For Profile Detail -->
            <div class="col-md-7 divProfile">
                <form method="post">
                    <!-- Full Name -->
                    <div class="form-group row">
                        <label for="profileName" class="col-sm-3 col-form-label text-left">Full Name</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="profileName" required value="<?php echo $res['fname']." ".$res['lname'];?>">
                        </div>
                    </div>
                    <!-- Date of Birth -->
                    <div class="form-group row">
                        <label for="profileDob" class="col-sm-3 col-form-label text-left">Birth Date</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="profileDob" required value="<?php echo $res['dob'];?>">
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="form-group row">
                        <label for="profileEmail" class="col-sm-3 col-form-label text-left">Email</label>
                        <div class="col-sm-9">
                        <input type="email" class="form-control" id="profileEmail" name="profileEmail" placeholder="example@gmail.com" required value="<?php echo $res['email'];?>">
                        </div>
                    </div>
                    <!-- Postal Address -->
                    <div class="form-group row">
                        <label for="profilePadd" class="col-sm-3 col-form-label text-left">Postal Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="profileAddress" id="profilePadd" required value="<?php echo $res['postalAddress'];?>">
                        </div>
                    </div>
                    <!-- Postal Code -->
                    <div class="form-group row">
                        <label for="profilePcode" class="col-sm-3 col-form-label text-left">Postal Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="profileACode" id="profilePcode" required value="<?php echo $res['postCode'];?>">
                        </div>
                    </div>
                    <!-- Username -->
                    <div class="form-group row">
                        <label for="profileUser" class="col-sm-3 col-form-label text-left">User Name</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" id="profileUser" required value="<?php echo $res['uname'];?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="changePass" name="checkPass">
                                <label class="form-check-label" for="changePass">
                                    Change Password
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="passChange">
                        <div class="form-group row">
                            <label for="oldPassword" class="col-sm-3 col-form-label text-left">Old Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="*********">
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="checkOld col-sm-9"></div>
                        </div>
                        <div class="form-group row">
                            <label for="newPassword" class="col-sm-3 col-form-label text-left">New Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="*********">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cNewPassword" class="col-sm-3 col-form-label text-left">Confirm Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="cNewPassword" name="cNewPassword" placeholder="*********">
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="matchNew col-sm-9"></div>
                        </div>
                    </div>
                    
                    <!--Save and Cancel Button-->
                    <div class="form-group row mt-1">
                        <div class="col-md-6 d-flex justify-content-around">
                            <input type="submit" class="btn btn-success px-5 mb-1" name="btnProfileSave" value="Save">                        
                        </div>
                        <div class="col-md-6 d-flex justify-content-around">
                            <input type="submit" class="btn btn-danger px-5 mb-1" name="btnProfileCancel" value="Cancel">
                        </div>
                    </div>
                </form>
            </div>


            <div class="col-md-1"></div>


            <!-- For Account detail -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header h4">Account Status</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label text-left">Status</label>
                            <label class="col-sm-6 col-form-label text-left"><?php echo $res['status'];?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label text-left">Created Date</label>
                            <label class="col-sm-6 col-form-label text-left"><?php echo $res['startDate'];?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label text-left">Last Renewed</label>
                            <label class="col-sm-6 col-form-label text-left"><?php echo $res['renewedDate'];?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label text-left">Expiry Date</label>
                            <label class="col-sm-6 col-form-label text-left"><?php echo $res['endDate'];?></label>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>

    <script>
        $(document).ready(function(){
            $(".passChange").hide();

            $("#changePass").click(function(){
                $(".passChange").toggle();
            });
        });
    </script>

    <script>
    $(document).ready(function () {

        // Checking valid password 
        $("#oldPassword").keyup(function(){
            var password = $("#oldPassword").val()
            $.ajax({
                type: "GET",
                url : "checkPassword.php",
                data: {"oldPass":password},
                success: function(result){
                    $(".checkOld").html(result);
                }
            });
        });

       //checking matching password
         $("#cNewPassword").keyup(function(){
            if($(this).val() == $("#newPassword").val()){
                $(".matchNew").html("Password match.");
                $(".matchNew").css({color:'green'});
            }
            else{
                $(".matchNew").html("Passwords do not match!");
                $(".matchNew").css({color:'red'});
            }
        });
    });
  </script>

  <!-- Java Script for Profile update message -->
  <script>
        $(".profileUpdate").delay(2000);
        $(".profileUpdate").hide(500);
    </script>
</html>