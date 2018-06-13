<?php include 'header.php'; include 'assets/page/func.php'; 
$user = $_GET['user']; 
$sql = mysql_query("select * from user where `email` = '$user'");
$getsql = mysql_fetch_array($sql);
$userid = $getsql['id'];
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title"> User Statistics</h3>
                <div class="whitebg">
                    <form onsubmit="return false">
                        <div class="form-group">
                            <label>Search</label>
                            <input type="search" class="searchuser form-control">
                        </div>
                        <div class="divdata"></div>
                    </form>
                </div>                                
                <?php 
                if($user){
                    echo "<div class='charts'><div class='loader'><img src='assets/img/preloader.gif'>Please Wait...</div></div><div class='com_charts'></div>";
                }
                ?>
            </div>
            <?php 
            if($user){
                echo "<div class='rightside'><div class='loader'><img src='assets/img/preloader.gif'>Please Wait...</div></div>";
            }
            ?>            
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<script>
    $(".searchuser").keyup(function(){
        $value = $(this).val();
        if($value.trim() == ''){
            $(".divdata").fadeTo(500,0.5);
        }else{
            $(".divdata").fadeTo(500,1);
            $('.divdata').html('Wait...');
            $.ajax({ 
                type: 'GET', 
                url: 'assets/page/user.php', 
                data: { q: $value }, 
                success: function (data) { 
                    $('.divdata').html(data);
                }
            });
        }
    });
    <?php if($user){ ?>
    
    $(window).bind('load',function(){
        setTimeout(post,1000);
        setTimeout(chart,1000);
        setTimeout(com_charts,1000);
    });
    
    function post(){
        $.ajax({ 
            type: 'GET', 
            url: 'assets/page/user_post.php', 
            data: { q: '<?php echo $user; ?>' }, 
            success: function (data) { 
                $('.rightside').html(data);
            }
        });
    }
    
    function com_charts(){
        $.ajax({ 
            type: 'GET', 
            url: 'assets/page/user_reply.php', 
            data: { q: '<?php echo $user; ?>' }, 
            success: function (data) { 
                $('.com_charts').html(data);
            }
        });
    }
    
    function chart(){
        $.ajax({ 
            type: 'GET', 
            url: 'assets/page/user_chart.php', 
            data: { q: '<?php echo $user; ?>' }, 
            success: function (data) { 
                $('.charts').html(data);
            }
        });
    }
    
    <?php } ?>
</script>
<style>
    
    .loader img{
        display: block;
        margin: 10px auto;
        width: 50px;
    }
    .loader{
        text-align: center;
        margin-top: 35px;
    }
    
    .whitebg form{
        margin: 0;
    }
    .whitebg{
        margin-bottom: 25px;
    }
    .divdata a:first-child{
        border: 0;
    }
    .divdata a{
        display: block;
        color: #000;
        border-top: 1px dashed #ccc;
        padding: 5px;
    }
</style>