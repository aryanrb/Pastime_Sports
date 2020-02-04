<!-- Admin Events page -->
<?php
    session_start();
    include 'connection.php';
    include 'nav.php';

    if(isset($_POST['btnAddEvent']))
    {
    $eTitle = $_POST['txtEtitle'];
    $eDetail = $_POST['txtEdetail'];
    $eDay = $_POST['txtEdate'];
    $eTime = $_POST['txtEtime'];
    $eloc = $_POST['txtElocation'];
    $eImg = $_FILES['fileEimg']['name'];
    $etmpImg = $_FILES['fileEimg']['tmp_name'];
    
    // Changing suitable/unique name for every image
    $query_selE="SELECT * FROM events";
    $res = $connection->query($query_selE);
    $uCount = $res->num_rows + 1;

    $imgType=substr($eImg, -4);
    $newEimg="Events".$uCount.$imgType;
    move_uploaded_file($etmpImg,"imgEvents/".$newEimg);
    
    // Inserting Events detail into the database
    $query_insEvents = "INSERT INTO events VALUES('','$eTitle','$eDetail','$eDay','$eTime','$newEimg','$eloc')";
    $connection->query($query_insEvents);
    }

    // In case of Editing Events detail
    if(isset($_GET['eeId']))
    {
        $eId = $_GET['eeId'];
        $query_selE = "SELECT * FROM events WHERE id = '$eId'";
        $res = $connection->query($query_selE);
        $result = $res->fetch_assoc();

        if(isset($_POST['btnUpdEvent']))
        {
            $event = $_POST['txtEtitle'];
            $desc = $_POST['txtEdetail'];
            $day = $_POST['txtEdate'];
            $time = $_POST['txtEtime'];
            $loc = $_POST['txtElocation'];
            
            if(isset($_FILES['fileEimg']['name']))
            {
                $pName = $result['image'];
                $ptmpName = $_FILES['fileEimg']['tmp_name'];
                
                move_uploaded_file($ptmpName,"imgEvents/".$pName);

                $query_editEvents="UPDATE events SET title='$event',description='$desc',day='$day',time='$time', 
                            image='$pName',venue='$loc' WHERE id = '$eId'";
            }
            else
            {
                $query_editEvents="UPDATE events SET title='$event',description='$desc',day='$day',time='$time',venue='$loc' 
                            WHERE id = '$eId'";
            }
            $connection->query($query_editEvents);
        } 
    }

    // In case of Deleting Events detail
    if(isset($_GET['edId']))
    {
        $dId = $_GET['edId'];
        $query_delEvents = "DELETE FROM events where id = ".$dId."";
        $connection->query($query_delEvents);
    }
?>


<!-- Form and table for Events Page -->
<div class="container text-center">
    <h1 class="mt-3"> 
        <span class="ps_icon_md"><img src="images/psLogo.png" alt="logo"></span> 
        Admin Event Panel
    </h1>
    <hr>
    <form method="post" enctype="multipart/form-data">
    <div class="d-flex justify-content-center">
        <div class="frmAddEvents p-3 col-md-8 row">
            <div class="form-group col-md-12">
                <input type="text" name="txtEtitle" class="form-control" Placeholder="Event Title" required
                        value="<?php if(isset($_GET['eeId'])){echo $result['title'];}?>">
            </div>
            <br>
            <div class="form-group col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span>Date</span>
                        </div>
                    </div>
                    <input type="date" name="txtEdate" class="form-control" 
                    value="<?php if(isset($_GET['eeId'])){echo $result['day'];}?>" required>                
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span>Time</span>
                        </div>
                    </div>
                    <input type="time" name="txtEtime" class="form-control" 
                    value="<?php if(isset($_GET['eeId'])){echo $result['time'];}?>" required>                
                </div>
            </div>
            <div class="form-group col-md-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span>Choose Location</span>
                        </div>
                    </div>
                    <input type="text" name="txtElocation" class="form-control" 
                    value="<?php if(isset($_GET['eeId'])){echo $result['venue'];}?>" required>                
                </div>
            </div>
            
            <div class="form-group col-md-12">
                <textarea name="txtEdetail" class="form-control" Placeholder="Event Description" rows="3" required>
                        <?php if(isset($_GET['eeId'])){echo $result['description'];}?></textarea>
            </div>

            <!-- For uploading file -->
            <div class="input-group mb-3 col-md-12">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload Image</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="fileEimg" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose Image file</label>
                </div>
            </div>

            <div class="form-group col-md-12">
                <input type="submit" name="btnAddEvent" class="btn btn-info pr-5 pl-5" value="Publish Event">
                <input type="submit" name="btnUpdEvent" class="btn btn-info pr-5 pl-5" value="Update Event">
            </div>
        </div>
    </div>
    </form>


    <!-- Events detail in tabular form -->
    <table class="table table-striped table-hover">
        <caption>Event Detail</caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Event</th>
                <th scope="col">Description</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Image</th>
                <th scope="col">Location</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
        <!-- Select all the data from the Events table and Show it in a web table -->
        <?php
            $query_selEvents = "SELECT * FROM events";
            $selData = $connection->query($query_selEvents);
            $i = 0;
            while($result = $selData->fetch_assoc())
            {
                $i = $i + 1;   
                echo"
                <tr>
                    <th scope='row'>".$i."</th>
                    <td>".$result['title']."</td>
                    <td>".$result['description']."</td>
                    <td>".$result['day']."</td>
                    <td>".$result['time']."</td>
                    <td><img src='imgEvents/".$result['image']."' style='width:30px;height:30px;'></td>
                    <td>".$result['venue']."</td>
                    <td><a href='adminEvents.php?eeId=".$result['id']."'>Edit</a></td>
                    <td><a href='adminEvents.php?edId=".$result['id']."'>Delete</a></td>
                </tr>";
            }
        ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php'; ?>