<?php include 'header.php'; include 'assets/page/func.php'; 
if($_GET['Add'] == 'Add'){ ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">Add LIC Policy</h3>
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <input type="text" name="add_company_name" class="form-control" placeholder="Mobile" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="add_company_name" class="form-control" placeholder="Name" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="add_company_name" class="form-control" placeholder="Policy Number" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="add_company_name" class="form-control" placeholder="Premimum Amount" required>
                        </div>
                         <div class="form-group">
                            <input type="date" name="last_date" class="form-control" >
                        </div>
                       
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Add Policy</button>
                        </div>
                    </form>
                </div>           
<?php
    if(isset($_REQUEST['sbt'])){
        $topicname = mysql_real_escape_string($_REQUEST['topic']);
        $school_id = mysql_real_escape_string($_REQUEST['school']);
        mysql_query("INSERT INTO `topic`(`name`, `number_of_post`, `school_id`) VALUES ('".$topicname."','0','".$school_id."')");
?>
            <div class="col-md-12 text-center">
                <p><br>Topic Added</p>
            </div>
<?php } ?>
                    
                     
            </div>
            <div class="col-md-8">
                <h3 class="page_title"><a href="topics.php">All Policies</a></h3>
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Policy No</th>
                                <th>Premium Amount</th>
                                <th>Date</th>
                                <th>Type</th>
                            </tr>
                            <?php
                            $topic = mysql_query("select * from user_policies where policy_type LIKE 'Life' order by policy_id desc limit 10");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['name']."</td>";                           
                                echo "<td>".$tt ['policy_no']."</td>";
                                echo "<td>".$tt['premium_amount']."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['premium_duedate']))."</td>";
                                echo "<td>".$tt['policy_type']."</td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
}else{
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title"><?php num_rows('1','queries') ?> - Queries</h3>
            </div>
            <div class="col-md-12">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">                         
                            <tr>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Product</th>
                                <th class="text-center">View Query</th>
                               <th class="text-center">Delete Query</th>
                            </tr>
                            <tbody>
                            <?php                            
                            $topic = mysql_query("select a.id,a.name,a.mobile,a.email,b.name as pname from queries a,product b where a.product_id=b.id order by a.id desc limit $start_from, $num_rec_per_page");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['name']."</td>";                           
                                echo "<td>".$tt ['mobile']."</td>";
                                echo "<td>".$tt['email']."</td>";
                                echo "<td>".$tt['pname']."</td>";
                              
                            ?>
                            <td class="text-center"><a href="view_query.php?id=<?php echo $tt['id']; ?>"><i class="material-icons">visibility</i></a></td>
                            <td class="text-center"><a class="deletetopic" href="assets/page/disable.php?table=topic&id=<?php echo $tt['topic_id']; ?>"><i class="material-icons">delete</i></a></td>
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
<?php } ?>