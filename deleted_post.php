<?php include 'header.php'; include 'assets/page/func.php'; ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title"><?php num_rows('0','post') ?> - deleted post </h3>
            </div>
            <div class="col-md-12">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">                         
                            <tr>
                                <th>Name</th>
                                <th>No. Of Comment</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th class="text-center">View Post</th>
                                <th class="text-center">Edit Post</th>
                                <th class="text-center">Active Post</th>
                            </tr>
                            <tbody>
                            <?php                            
                            $topic = mysql_query("select * from post where `status` = '0' order by post_id desc limit $start_from, $num_rec_per_page");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['text']."</td>";
                                echo "<td>".$tt['number_of_reply']."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['timestamp']))."</td>";
                                echo "<td>".date("h:i:sa",strtotime($tt['timestamp']))."</td>";
                            ?>
                            <td class="text-center"><a href="view_post.php?id=<?php echo $tt['post_id']; ?>"><i class="material-icons">visibility</i></a></td>
                            <td class="text-center"><a href="edit_post.php?id=<?php echo $tt['post_id']; ?>"><i class="material-icons">edit</i></a></td>
                            <td class="text-center"><a class="deletetopic" href="assets/page/enabled.php?table=post&id=<?php echo $tt['post_id']; ?>"><i class="material-icons">done</i></a></td>
                            <?php
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center paginasion">
                        <?php                        
                        $total_records = mysql_num_rows(mysql_query("select * from post where `status` = '0'"));
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