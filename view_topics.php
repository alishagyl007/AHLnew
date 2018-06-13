<?php include 'header.php'; include 'assets/page/func.php'; 
$topic_id = $_GET['id'];
$topic = mysql_query("select * from tasks where `id` = $topic_id");
$tt = mysql_fetch_assoc($topic);
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title">View Task</h3>
                <div class="card">
                    <p>Task :<br><?php echo $tt['task']; ?></p>
                    
                </div>
            </div>
            <?php 
            $count = '1';
            $post_sql = mysql_query("select * from post where `topic_id` = $topic_id and status = '1' order by post_id desc");
            while($post = mysql_fetch_assoc($post_sql)){
            ?>
            <div class="col-md-12 important">
                <div class="customadd">
                <div class="next">Post <?php echo $count." : ".$post['text']; ?></div>
                <div class="whitebg">
                    <div class="row posts">
                        <div class="col-md-3 showicons">
                            <?php
                            userid($post['user_id']); 
                            echo "<p><i class='material-icons'>event</i> ".date("d/m/Y",strtotime($post['timestamp']))."</p>"; 
                            echo "<p><i class='material-icons'>timer</i>  ".date("h:i:sa",strtotime($post['timestamp']))."</p>"; 
                            echo "<p><i class='material-icons'>thumb_up</i>  ".$post['number_of_like']."</p>"; 
                            echo "<p><i class='material-icons'>comment</i>  ".$post['number_of_reply']."</p>"; 
                            ?>
                        </div>
                        <div class="col-md-9">
                            <div class="topics">
                                Post <?php echo $count; $count++ ?> :<br>
                                <?php echo $post['text']; ?>
                            </div>
                        </div>
                        <a href="assets/page/disable.php?table=post&id=<?php echo $post['post_id']; ?>"><i class='material-icons'>delete</i></a>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-md-offset-0">
                            <?php replyall($post['post_id']); ?>
                        </div>
                    </div>
                </div>
                    </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<style>
    .whitebg{
        margin-bottom: 0px;
        display: none;
    }
    .showicons i{
        vertical-align: bottom;
        margin-right: 7px;
    }
    .showicons p{
        color: #727272;
    }
    .topicname{
        font-size: 18px;
    }
    .replys {
        position: relative;
        margin: 20px -15px;
    }
    hr{
        margin: 5px 0;
        border-top: 1px dashed #eee;
    }
    h4{
        font-weight: 400;
    }
    .row{
        position: relative;
    }
    .whitebg a{
        position: absolute;
        top: 50%;
        transform: translate(-30px);
        margin-top: -25px;
        left: 15px;
        vertical-align: middle;
        background: #1976d2;
        width: 45px;
        color: #fff;
        padding: 10px;
        border-radius: 50%;
        height: 45px;
        box-shadow: 0 0 10px #000 !important;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
    }
    .replys:hover a{
        transform: translate(0px);
        opacity: 1;
        visibility: visible;
    }
    
    .posts:hover a{
        transform: translate(0px);
        opacity: 1;
        visibility: visible;
    }
    
    .next {
        background: #fff;
        padding: 15px;
        margin-top: 0px;
        cursor: pointer;
        box-shadow: 0 3px 10px #ccc;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    div#scroll {
        transition: all .5s;
        margin-top: 0px;
    }   
    .customadd{
        border: 1px solid #ccc;
        margin-bottom: 15px;
    }
</style>
    
<script>
    $(".next").click(function(){  
        $(".next").removeAttr("id");
        $(".next").next().slideUp();
        $(this).attr("id","scroll");
        $(this).next().slideToggle(function(){
            $('html, body').animate({
                scrollTop: $("#scroll").offset().top-58
            }, 500);
        });        
    });
    
    $(".whitebg a").click(function(){
        $(this).parent().fadeOut();
        $.ajax({
            type: "POST",
            url: $(this).attr('href'),
            data: "123",
            cache:1,
            success: function(login){
                
            }
        });
        return false;
    });
</script>
