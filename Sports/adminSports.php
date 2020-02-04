<!-- Admin Sports page -->
<?php
    session_start();
    include 'connection.php';
    include 'nav.php';

    if(isset($_POST['btnAddSports']))
    {
    $sTitle = $_POST['txtStitle'];
    $sDetail = $_POST['txtSdetail'];
    $sImg = $_FILES['fileSimg']['name'];
    $stmpImg = $_FILES['fileSimg']['tmp_name'];
    
    // Changing suitable/unique name for every image
    $query_selS="SELECT * FROM sports";
    $res = $connection->query($query_selS);
    $uCount = $res->num_rows + 1;

    $imgType=substr($sImg, -4);
    $newSimg="Sports".$uCount.$imgType;
    move_uploaded_file($stmpImg,"imgSports/".$newSimg);
    
    // Inserting Sports detail into the database
    $query_insSports = "INSERT INTO sports VALUES('','$sTitle','$sDetail','$newSimg')";
    $connection->query($query_insSports);
    }

    // In case of Editing Sports detail
    if(isset($_GET['seId']))
    {
        $eId = $_GET['seId'];
        $query_selS = "SELECT * FROM sports WHERE id = '$eId'";
        $res = $connection->query($query_selS);
        $result = $res->fetch_assoc();

        if(isset($_POST['btnUpdSports']))
        {
            $game = $_POST['txtStitle'];
            $desc = $_POST['txtSdetail'];
            
            if(isset($_FILES['fileSimg']['name']))
            {
                $pName = $result['photo'];
                $ptmpName = $_FILES['fileSimg']['tmp_name'];
                
                move_uploaded_file($ptmpName,"imgSports/".$pName);

                $query_editSports="UPDATE sports SET game='$game',description='$desc', photo='$pName' WHERE id = '$eId'";
            }
            else
            {
                $query_editSports="UPDATE sports SET game='$game',description='$desc' WHERE id = '$eId'";
            }
            $connection->query("$query_editSports");
        } 
    }

    // In case of Deleting Sports detail
    if(isset($_GET['sdId']))
    {
        $dId = $_GET['sdId'];
        $query_delSports = "DELETE FROM sports where id = ".$dId."";
        $connection->query($query_delSports);
    }
?>



<!-- Form and table for Sports Page -->
<div class="container text-center">
    <h1 class="mt-3"> 
        <span class="ps_icon_md"><img src="images/psLogo.png" alt="logo"></span> 
        Admin Sports Panel
    </h1>
    <hr>
    <form method="post" enctype="multipart/form-data">
        <div class="frmAddSports d-flex justify-content-center p-3 row">
            <div class="form-group col-md-8">
                <input type="text" name="txtStitle" class="form-control" Placeholder="Sports Title" required
                        value="<?php if(isset($_GET['seId'])){echo $result['game'];}?>">
            </div>

            <div class="form-group col-md-8">
                <textarea name="txtSdetail" class="form-control" Placeholder="Sports Description" rows="3" required>
                        <?php if(isset($_GET['seId'])){echo $result['description'];}?></textarea>
            </div>

            <!-- For uploading file -->
            <div class="input-group mb-3 col-md-8">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload Image</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="fileSimg" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose Image file</label>
                </div>
            </div>
            
            <div class="form-group col-md-8">
                <input type="submit" name="btnAddSports" class="btn btn-info pr-5 pl-5" value="Publish Sports">
                <input type="submit" name="btnUpdSports" class="btn btn-info pr-5 pl-5" value="Update Sports">
            </div>
        </div>
    </form>


    <!-- Sports detail in tabular form -->
    <table class="table table-striped table-hover">
        <caption>Sports Detail</caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Sports</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
        <!-- Select all the data from the Sports table and Show it in a web table -->
        <?php
            $query_selSports = "SELECT * FROM sports";
            $selData = $connection->query($query_selSports);

            $i = 0;
            while($result = $selData->fetch_assoc())
            {
                $i = $i + 1;   
                echo"
                <tr>
                    <th scope='row'>".$i."</th>
                    <td>".$result['game']."</td>
                    <td>".$result['description']."</td>
                    <td><img src='imgSports/".$result['photo']."' style='width:30px;height:30px;'></td>
                    <td><a href='adminSports.php?seId=".$result['id']."'>Edit</a></td>
                    <td><a href='adminSports.php?sdId=".$result['id']."'>Delete</a></td>
                </tr>
                ";
            }
        ?>
        </tbody>
    </table>
</div>
<?php include 'footer.php'; ?>
