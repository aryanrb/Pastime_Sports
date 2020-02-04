<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">

<script src="js/jquery.js"></script>

<!-- Chat box from here -->
<div class="chat">
    <div class="message-box">
        <div class="message-history">
            <p>hello</p>
        </div>
        <form method="POST">
            <div class="input-group nlForm">
                <input type="text" class="form-control" name="txtMessage" placeholder="Write a message..">
                <div class="input-group-append">
                    <input type="submit" class="form-control" name="btnMessage" value="Send">
                </div>
            </div>
        </form>
    </div>
    <div class="message-icon rounded-circle">
        <img src="images/message.png" alt="message_icon" class="msg">
        <img src="images/close.png" alt="message_close_icon" class="msg-close">
    </div>
</div>

<!-- script for Chat Box -->
<script>
    $(document).ready(function(){
        $(".msg-close").hide(10);
        $(".message-box").hide(10);

        $(".msg").click(function(){
            $(this).hide();
            $(".msg-close").show(10);
            $(".message-box").show(10);
        });
        $(".msg-close").click(function(){
            $(this).hide();
            $(".msg").show(10);
            $(".message-box").hide(10);
        });
    });
</script>