<?php 
    include 'connection.php';
    include 'nav.php'; 
?>

<div class="container mt-5">
<p class="h1 text-center">Member Requests</p>
<table class="table table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">S.No</th>
            <th scope="col">User</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Fee</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
    
    <!-- Select all the data from the Events table and Show it in a web table -->
    <?php
        
        $query_selReqs = "SELECT * FROM members";
        $selData = $connection->query($query_selReqs);

        $i = 0;
        while($result = $selData->fetch_assoc())
        {
            $i = $i + 1;   
            echo"
            <tr>
                <th scope='row'>".$i."</th>
                <td>".$result['user']."</td>
                <td>".$result['startDate']."</td>
                <td>".$result['endDate']."</td>
                <td>".$result['fee']."</td>
                <td><a href='#' onClick='updateMem(".$result['id'].")'>Accept</a> 
                    <label> / </label>
                    <a href='#' onClick='deleteMem(".$result['id'].")'>Reject</a></td>
            </tr>
            ";
        }
    ?>
    </tbody>
</table>
    <script>
        function updateMem(updId){
            if(confirm("Are you sure to accept this membership?")){
                window.location.href = 'memUpdate.php?uId='+ updId +'' ;
                return true;
                
            }
        }
        function deleteMem(delId){
            if(confirm("Are you sure to Reject this membership?")){
                window.location.href = 'memDelete.php?dId='+ delId +'' ;
                return true;
            }
        }
    </script>
</div>
