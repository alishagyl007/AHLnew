<?php include 'header.php'; include 'assets/page/func.php'; 

$video_id = $_GET['id'];
$sql=mysql_query("SELECT videoid, title, COUNT( * ) AS votes FROM voting where videoid='$video_id' GROUP BY videoid");
$res=mysql_fetch_assoc($sql)
?>
<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                
                <h3 class="page_title"><?php echo($res['title'] .' - '. $res['votes']); ?> </h3>
            </div>
            <div class="col-md-12">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">                         
                            <tr>
                                 <th>Name</th>
                                 <th>Mobile</th>
                                <th>Comments</th>
                               
                               
                              
                            </tr>
                            <tbody>
                            <?php                            
                            $topic = mysql_query("SELECT a.name, a.mobile, b.comment FROM voting b, user a WHERE a.user_id = b.userid AND b.videoid ='$video_id'");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['name']."</td>";                           
                                echo "<td>".$tt ['mobile']."</td>";
                                echo "<td>".$tt ['comment ']."</td>";
                                
                              
                            ?>
                           
                          
                            <?php
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center paginasion">
                        <?php                        
                        $total_records = mysql_num_rows(mysql_query("select * from queries"));
                        $total_pages = ceil($total_records / $num_rec_per_page);
                        for ($i=1; $i<=$total_pages; $i++) { 
                            echo "<a href='?page=".$i."' class='active$i'>".$i."</a> "; 
                        }
                        ?>   
                        <style>
                            .paginasion a.active<?php echo $page; ?>{
                                background: #1976d2;
                                color: #fff;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<style>
    th.text-center {
        width: 16px;
    }
    .hidetime{
        display: none;
    }
    p#aboutresult {
        margin: 5px 0 0 5px;
    }
    .redbg *{
        background: #f00;
        color: #fff;
    }
</style>

<script>
      
    $(".deletetopic").click(function(){
        $(this).parent().parent().addClass("redbg");
        $(".redbg").fadeOut();
        $.ajax({
            type: "POST",
            url: $(this).attr('href'),
            data: "123",
            success: function(login){
                
            }
        });
        return false;
    });
    
    
</script>
<?php  ?>