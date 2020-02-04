<?php
    session_start();
    include 'nav.php';
    include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>PS Sports</title> 
   
</head>
<body>
    <div class="container mt-3">
        <hr>
    <h2 class='text-center tophd'>Events</h2>
        <hr>
        <?php
            $qry = "SELECT * FROM events";
            $res = $connection->query($qry);
            while($data = $res->fetch_assoc()){
            echo"
            <div class='row d-flex justify-content-around mb-4'>
                <div class='col-md-4 bg-info p-0'>
                   
                    <img class='img-sport' src='imgEvents/".$data['image']."' alt='imageofEvent'>
                </div>
                <div class='col-md-6' style='background-color: #eee'>
                    <h4 class='p-1'>".$data['title']."</h4>
                    <p class='p-1 text-justify'>".$data['description']."</p>
                    <button class='btn-success mb-1'>Interested</button>
                    <button class='btn-primary mb-1'>Going</button>
                </div>
                <div class='bg-secondary col-md-2 text-white'>
                    <h5 class='pt-1 pl-1  m-0'>Location:</h5>
                    <p class='pl-1'>".$data['venue']."</p>
                    <h5 class='pl-1 m-0'>Time:</h5>
                    <p class=' pl-1 m-0'>".$data['day']."</p>
                    <p class=' pl-1 m-0'>".$data['time']."</p>
                </div>
            </div>";
            }
        ?>
    </div>
<?php include 'footer.php'; ?>
</body>
</html>