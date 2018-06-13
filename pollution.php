<?php include 'header.php'; include 'assets/page/func.php'; 
if($_GET['Add'] == 'Add'){ ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">Add Pollution Info</h3>
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <input type="text" name="mobile" class="form-control" placeholder="Mobile" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="vehicle_number" class="form-control" placeholder="Vehicle Number" required>
                        </div>
 			<div class="form-group">
                            <input type="text" name="description" class="form-control" placeholder="Description" required>
                        </div>

                         <div class="form-group">
                            <input type="date" name="due_date" class="form-control" >
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
	$vehicle_number = mysql_real_escape_string($_REQUEST['vehicle_number']);
	$description = mysql_real_escape_string($_REQUEST['description']);
	$due_date = mysql_real_escape_string($_REQUEST['due_date']);
		

        mysql_query("INSERT INTO `polluion`(`vehicleno`, `description`, `duedate`, `user_id`, `status`) VALUES ('".$vehicle_number."','".$description."','".$due_date."','".$userid."', '1' )");
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
                                <th>Vehicle No</th>
                                <th>Description</th>
                                <th>Due Date</th>

                            </tr>
                            <?php
                            $topic = mysql_query("select * from pollution order by policy_id desc limit 10");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['name']."</td>";                           
                                echo "<td>".$tt ['vehicleno']."</td>";
                                echo "<td>".$tt['descriptiont']."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['duedate']))."</td>";
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
                                <th>Vehicle No</th>
                                <th>Description</th>
                                <th>Due Date</th>
                             </tr>
                            <tbody>
                            <?php                            
                            $topic = mysql_query("select * from pollution order by policy_id desc limit $start_from, $num_rec_per_page");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
				echo "<td>".$tt['name']."</td>";  
                                echo "<td>".$tt['vehicleno']."</td>";                           
                                echo "<td>".$tt ['description']."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['duedate']))."</td>";
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

<?php } ?>