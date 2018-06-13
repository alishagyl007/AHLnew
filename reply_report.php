<?php include 'header.php'; include 'assets/page/func.php'; ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title"><?php num_of_data('report_reply') ?> - Comment Reports </h3>
            </div>
            <div class="col-md-12">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">                         
                            <tr>

                                <th>Comment Id</th>
                                <th>Post</th>
                                <th>Comment</th>
                                <th class="text-center">Count</th>
                                <th class="text-center">Hide Comment</th>
                            </tr>
                            <tbody>
                            <?php                            

                            $topic = mysql_query("select * from report_reply order by report_reply_id desc limit $start_from, $num_rec_per_page");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                
    $reply_sql = mysql_query("select * from reply where `reply_id` = '".$tt['reply_id']."' limit 1");
    $get_result = mysql_fetch_assoc($reply_sql);

    $reply_sql1 = mysql_query("select * from post where `post_id` = '".$tt['post_id']."' limit 1");
    $get_result1 = mysql_fetch_assoc($reply_sql1);

    echo "<td>".$get_result['reply_id']."</td>";
    echo "<td>".$get_result1['text']."</td>";
    echo "<td>".$get_result['text']."</td>";
    echo "<td class='text-center'>".$tt['count']."</td>";
?>
<td class="text-center"><a class="deletetopic" href="assets/page/reply_disable.php?table=reply&id=<?php echo $get_result['reply_id']; ?>&report=<?php echo $tt['report_reply_id']; ?>"><i class="material-icons">delete</i></a></td>
<?php

                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center paginasion">
                        <?php                        
                        $total_records = mysql_num_rows(mysql_query("select * from report_reply where `is_visible` = '1'"));
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