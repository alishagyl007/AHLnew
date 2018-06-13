<?php include 'header.php'; include 'assets/page/func.php'; 
$topic_id = $_GET['id'];
$topic = mysql_query("select * from reply where `reply_id` = $topic_id");
$tt = mysql_fetch_assoc($topic);
$mysql = mysql_query("select * from post where `post_id` = '".$tt['post_id']."'");
$topciname = mysql_fetch_array($mysql);
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title">View Comment</h3>
                <div class="card">
                    <p>Post :<br><?php echo $topciname['text']; ?></p>
                </div>
            </div>
            <div class="col-md-12 important">
                <div class="whitebg" style="display:block;">
                    <div class="row posts">
                        <div class="col-md-12">
                            <?php //echo $tt['text']; 
                            $post_sql = mysql_query("select * from user where `id` = '".$tt['user_id']."' limit 1");
                            $get_result = mysql_fetch_assoc($post_sql);
                            ?>
                            
                            <div class="row showicons replys">
                                <div class="col-md-3">
                                    <p><i class='material-icons'>face</i> <?php echo $get_result['username']; ?></p>
                                    <p><i class='material-icons'>mail_outline</i> <?php echo $get_result['email']; ?></p>
                                </div>
                                <div class="col-md-2">
                                    <p><i class='material-icons'>event</i> <?php echo date("d/m/Y",strtotime($tt['timestamp'])); ?></p>
                                    <p><i class='material-icons'>timer</i> <?php echo date("h:i:sa",strtotime($tt['timestamp'])); ?></p>
                                </div>
                                <div class="col-md-7">
                                    <?php echo $tt['text']; ?>
                                </div>
                                <a href="assets/page/disable.php?table=reply&id=<?php echo $tt['reply_id']; ?>"><i class='material-icons'>delete</i></a>
                            </div>        
                        </div>
                    </div>
                </div>
            </div>
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
