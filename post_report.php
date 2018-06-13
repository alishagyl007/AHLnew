<?php include 'header.php'; include 'assets/page/func.php'; ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title"><?php num_of_data('report_post') ?> - Post Reports </h3>
            </div>
            <div class="col-md-12">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">                         
                            <tr>
                                <th>Post ID</th>
                                <th>Post Name</th>                                
                                <th class="text-center">Count</th>
                                <th class="text-center">Hide Post</th>
                            </tr>
                            <tbody>
                            <?php                            

                            $topic = mysql_query("select * from report_post order by report_post_id desc limit $start_from, $num_rec_per_page");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                
    $post_sql = mysql_query("select * from post where `post_id` = '".$tt['post_id']."' limit 1");
    $get_result = mysql_fetch_assoc($post_sql);
    echo "<td>".$get_result['post_id']."</td>";
    echo "<td>".$get_result['text']."</td>";
    echo "<td class='text-center'>".$tt['count']."</td>";
?>
<td class="text-center"><a class="deletetopic" href="assets/page/report_disable.php?table=post&id=<?php echo $get_result['post_id']; ?>&report=<?php echo $tt['report_post_id']; ?>"><i class="material-icons">delete</i></a></td>
<?php

                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center paginasion">
                        <?php                        
                        $total_records = mysql_num_rows(mysql_query("select * from report_post where `is_visible` = '1'"));
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