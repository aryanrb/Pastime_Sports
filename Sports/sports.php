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
    <h2 class='text-center tophd'>Sports</h2>
        <hr>
        <?php
            $qry = "SELECT * FROM sports";
            $res = $connection->query($qry);
            while($data = $res->fetch_assoc()){
            echo"
            <div class='row d-flex justify-content-around mb-4'>
                <div class='col-md-5 bg-info p-0'>                  
                    <img class='img-sport' src='imgSports/".$data['photo']."' alt='imageofEvent'>
                </div>
                <div class='col-md-7' style='background-color: #eee'>
                    <h4 class='p-1'>".$data['game']."</h4>
                    <p class='p-1 text-justify'>".$data['description']."</p>
                    <button class='btn-Success mb-1'>Play</button>
                    <button class='btn-Primary mb-1'>Watch</button>
                </div>
            </div>";
            }
        ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>