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
                            <input type="text" name="mobile" class="form-control" placeholder="Mobile" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="policy_number" class="form-control" placeholder="Policy Number" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="policy_amount" class="form-control" placeholder="Premium Amount" required>
                        </div>
                         <div class="form-group">
                            <input type="date" name="last_date" class="form-control" >
                        </div>
                        <div class="radio-inline">
                            <input type="radio" name="policy_mode"  value="A">Yearly &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="policy_mode"  value="B">Half Yearly &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="policy_mode" value="C">Quarterly &nbsp;&nbsp;&nbsp;&nbsp;
                            
                        </div>
                        <div class="form-group">
                            <label>Reference</label>
                            <select class="form-control" name="reference">
                                <?php
                                $selec = mysql_query("select * from reference order by name asc");
                                while($ref= mysql_fetch_assoc($selec)){
                                        echo "<option value='".$ref['id']."'>".$ref['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>  

                       
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Add Policy</button>
                        </div>
                    </form>
                </div>           
<?php
    if(isset($_REQUEST['sbt'])){
        $mobile = mysql_real_escape_string($_REQUEST['mobile']);
        $name = mysql_real_escape_string($_REQUEST['name']);
	$policy_mode = 0;
	$policy_number = mysql_real_escape_string($_REQUEST['policy_number']);
	$policy_amount = mysql_real_escape_string($_REQUEST['policy_amount']);
	$last_date = mysql_real_escape_string($_REQUEST['last_date']);
	$reference = mysql_real_escape_string($_REQUEST['reference']);
	$selected_radio = $_POST['policy_mode'];
		// echo $selected_radio;
		if($selected_radio == 'A') {
			$policy_mode = "12";	
			}
		if($selected_radio == 'B') {
			$policy_mode = "6";
			}
		if($selected_radio == 'C') {
			$policy_mode = "3";
			}

        mysql_query("INSERT INTO `Policies_lic`(`name`, `mobile`, `policy_no`, `policy_amount`,`policy_mode`,`due_date`, `status`, `reference`, `user_id`) VALUES ('".$name."','".$mobile."','".$policy_number."', '".$policy_amount."', '".$policy_mode."', '".$last_date."', '1', '".$reference."', '1' )");
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
                            $topic = mysql_query("select * from Policies_lic order by policy_id desc limit 10");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['name']."</td>";                           
                                echo "<td>".$tt ['policy_no']."</td>";
                                echo "<td>".$tt['policy_amount']."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['due_date']))."</td>";
                                echo "<td>".$tt['policy_mode']."</td>";
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
                <h3 class="page_title"><?php num_rows('1','topic') ?> - Topics </h3>
            </div>
            <div class="col-md-12">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">                         
                            <tr>
                                <th>Name</th>
                                <th>Policy No</th>
                                <th>Premium Amount</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th class="text-center">View Topic</th>
                                <th class="text-center">Edit Topic</th>
                                <th class="text-center">Delete Topic</th>
                            </tr>
                            <tbody>
                            <?php                            
                            $topic = mysql_query("select * from Policies_lic order by policy_id desc limit $start_from, $num_rec_per_page");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['name']."</td>";                           
                                echo "<td>".$tt ['policy_no']."</td>";
                                echo "<td>".$tt['policy_amount']."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['premium_duedate']))."</td>";
                                echo "<td>".$tt['policy_mode']."</td>";
                              
                            ?>
                            <td class="text-center"><a href="view_topics.php?id=<?php echo $tt['topic_id']; ?>"><i class="material-icons">visibility</i></a></td>
                            <td class="text-center"><a href="edit_topics.php?id=<?php echo $tt['topic_id']; ?>"><i class="material-icons">edit</i></a></td>
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
                        $total_records = mysql_num_rows(mysql_query("select * from topic where status = '1'"));
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