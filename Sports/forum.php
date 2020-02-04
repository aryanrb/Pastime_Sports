<!-- Try using text-truncate for more and less -->

<?php
    session_start();
    include 'connection.php';
    include 'nav.php';

    // To check the user session

    if(!isset($_SESSION['login']))
    {
        header('location:index.php');
    }
    
    // Adding new question
    if(isset($_POST['btnAddQns']))
    {
        $qns = $_POST['txtAddQns'];
        $uid = $_SESSION['login'];
        $query = "INSERT INTO forumquestion VALUES('','$uid','','$qns')";
        if(!$connection->query($query))
        {
            die("Sorry Error Occured:".$connection->connect_error);
        }
    }

    // To check if the user wants to Edit his question
    if(isset($_GET['qnEId']))
    {
        $qnEdit = $_GET['qnEId'];
        $query_editQn = "SELECT * FROM forumquestion WHERE qnId = '$qnEdit'";
        $data_editQn = $connection->query($query_editQn);
        $result_editQn = $data_editQn -> fetch_assoc();
        
    }

    //To check if the user wants to edit his answer
    if(isset($_GET['ansEId']))
    {
        $ansId = $_GET['ansEId'];
        $query_editAns = "SELECT qnId FROM forumanswer WHERE ansId = '$ansId'";
        $data_editAns = $connection->query($query_editAns);
        $result = $data_editAns->fetch_assoc();
        $relQnId= $result['qnId'];

        $ansTxt = 'txtAddAns'.$relQnId;

        $result_editAns = $data_editAns -> fetch_assoc();
        if(isset($_POST['btnAddAns'.$relQnId]))
        {
            $newAns = $_POST[$ansTxt];
            $query_updAns="UPDATE forumanswer SET answer = '$newAns' WHERE ansId = '$ansId'";
            $result_updAns = $connection->query($query_updAns);
        }
    }
        
?>


<!-- Question and Answer forum -->
<div class="container mt-5">
        <hr>
    <h2 class='text-center tophd'>Community Forum</h2>
        <hr>
    <div>
        <form method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="txtAddQns" placeholder="Add Questions....." 
                    value="<?php if(isset($_GET['qnEId'])){echo $result_editQn['question'];}?>" required>
                <div class="input-group-append">
                    <input type="submit" class="form-control bg-success" name="btnAddQns" value="Add Question">
                </div>
            </div>
        </form>
    </div>

    <div class="d-flex justify-content-center row">
        <?php 
        
            // For Pagination from here
            $start =0;
            $max=4;
            $page = 1;

            $query_qn = "SELECT forumquestion.*, memberprofile.uname FROM forumquestion INNER JOIN memberprofile ON forumquestion.accName = memberprofile.id ORDER BY qnId DESC";
            $data_qn = $connection->query($query_qn);

            $total=$data_qn->num_rows;
            $pages= ceil($total/$max);
    
            if (isset($_GET['pg'])) 
            {
                $page = $_GET['pg'];
                $start = ($_GET['pg']-1)*$max;
            }

            $query_qn = "SELECT forumquestion.*, memberprofile.uname FROM forumquestion INNER JOIN memberprofile ON forumquestion.accName = memberprofile.id ORDER BY qnId DESC LIMIT $start, $max";
            $data_qn = $connection->query($query_qn);
            $uid = $_SESSION['login'];
            
            echo "<div class='col-md-10'>
                  <ul>";
            while($res=$data_qn->fetch_assoc())
            {
                echo "
                <div class='text-left p-3'> 
                    <div class='pr-5 pl-5'>
                        <div class='row'>
                            <div class='blockquote text-uppercase col-md-10'>
                                <h3> ".$res['question']."</h3>
                                <p class='blockquote-footer font-weight-light'> By ".$res['uname']."</p>
                            </div>
                            <div class='col-sm-2'>";
                                if($uid == $res['accName']){
                                    echo"
                                    <li class='list-inline-item'><a href='forum.php?qnEId=".$res['qnId']."'>Edit</a></li>
                                    <li class='list-inline-item'><a href='#' onclick='delQuestion(".$res['qnId'].")'>Delete</a></li>";
                                }
                                echo"
                            </div>
                        </div>";
                        
                        $rel_QId=$res['qnId'];
                        if(isset($_POST['btnAddAns'.$rel_QId]))
                        {
                            $ans = $_POST['txtAddAns'.$rel_QId];
                            $query_ansAdd = "INSERT INTO forumanswer VALUES('','$uid','$ans','$rel_QId')";
                            if(!$connection->query($query_ansAdd))
                            {
                                die('Error Adding Answer'.$connection->error);
                            }
                        }
                        
                        // Showing Answers
                        $query_ans = "SELECT * from forumanswer where qnId = '$rel_QId' ORDER BY ansId DESC";
                        $data_ans = $connection->query($query_ans);
                        while($res_ans = $data_ans->fetch_assoc())
                        {
                            echo"
                            <div>
                                <ul class='list-inline font-weight-light'>
                                    <li class='list-inline-item'>By: ".$res_ans['accName']."</li>";
                                    if($uid == $res_ans['accName']){
                                        echo"
                                        <li class='list-inline-item'><a href='forum.php?ansEId=".$res_ans['ansId']."'>Edit</a></li>
                                        <li class='list-inline-item'><a href='#' onclick='delAnswer(".$res_ans['ansId'].")'>Delete</a></li>";
                                    }
                                    echo"
                                </ul>
                                <p>".$res_ans['answer']."</p></br>
                            </div>";
                        }
                        echo"
                    </div>";

                    // Answer Text field here
                    echo "
                    <p class='addAns'>Add Answer</p>
                    <form method='post'>
                        <div class='input-group'>
                            <input type='text' class='ans form-control' name='txtAddAns".$res['qnId']."' placeholder='Add Answer....' required>
                            <div class='input-group-append'>
                                <input type='submit' class='ans form-control bg-success' name='btnAddAns".$res['qnId']."' value='Add Answer'>                                    
                            </div>
                        </div>
                    </form>
                </div>";
            }
            
            //Pagination Part below:
            echo "<ul class='pagination justify-content-center'>";
            if($page > 1)
                {
                    echo"
                    <li class='page-item'>
                        <a class='page-link' href='forum.php?pg=".($page-1)."' aria-label='Previous'>
                        <span aria-hidden='true'>&laquo;</span>
                        </a>
                    </li>";
                }

                for($i=1;$i<=$pages;$i++)
                {
                    echo "<li class='page-item'> <a href ='forum.php?pg=".$i."' class='page-link'>".$i."</a></li>";
                }

                if($page < 5)
                {
                    echo"<li class='page-item'>
                        <a class='page-link' href='forum.php?pg=".($page+1)."' aria-label='Previous'>
                        <span aria-hidden='true'>&raquo;</span>
                        </a>
                    </li>";
                }
                
                echo"</ul>
                </ul>
            </div>";  
        ?>
    </div>
</div>
<?php include 'footer.php'; ?>

<script src="jquery.js"></script>
<script>
    $(document).ready(function(){

        $(".addAns").click(function(){
            $(".ans").toggle();
        });
    });

    // JavaScript for deleting Question with confirm box.
    function delQuestion(delQns)
    {
        if(confirm("Are you sure to delete this question?")){
            window.location.href='deleteQuestion.php?qnDId='+delQns+'';
            return true;    
        }
    }

    // JavaScript for deleting Answer with confirm box.
    function delAnswer(delAns)
    {
        if(confirm("Are you sure to delete this answer?")){
            window.location.href='deleteAnswer.php?ansDId='+delAns+'';
            return true;    
        }
    }

</script>