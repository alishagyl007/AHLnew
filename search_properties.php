<?php include 'header.php'; include 'assets/page/func.php'; 
$user_id = $_GET['id']; 
$sql = mysql_query("select * from user where user_id = '$user_id'");
$user = mysql_fetch_assoc($sql);
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">Search by Name</h3>
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
                        </div>
                        
                                          
                        <div class="text-right">
                            <button type="submit" name="btnname" class="btn btn-default">Search</button>
                        </div>
                    </form>
                </div>                                
            </div>
            <div class="col-md-4 important">
                <h3 class="page_title">Search By Address</h3>
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" class="form-control" name="mobile" required>
                        </div>
                        <div class="text-right">
                            <button type="submit" name="btnmobile" class="btn btn-default">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 important">
                <h3 class="page_title">Search By Date</h3>
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" name="sdate" required>
                        </div>
                        <div class="text-right">
                            <button type="submit" name="btndate" class="btn btn-default">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            </div>
      
<?php include 'footer.php';

if(isset($_REQUEST['btnname'])){
$name=mysql_real_escape_string($_REQUEST['name']);
    $topic = mysql_query("select * from properties where name LIKE '%$name%' order by property_id desc limit $start_from, $num_rec_per_page");
    }

if(isset($_REQUEST['btnmobile'])){
    $mobile=mysql_real_escape_string($_REQUEST['mobile']);
    $topic = mysql_query("select * from properties where address LIKE '%$mobile%' order by property_id desc limit $start_from, $num_rec_per_page");
}

if(isset($_REQUEST['btndate'])){
    $sdate=mysql_real_escape_string($_REQUEST['sdate']);
    $topic = mysql_query("select * from properties where address LIKE '%$mobile%' order by property_id desc limit $start_from, $num_rec_per_page");
}

?>
<div class="col-md-12">
                
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Size</th>
                               
                            <tbody>
                            <?php                            
                        
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['name']."</td>";                           
                                echo "<td>".$tt ['address']."</td>";
                                echo "<td>".$tt['city']."</td>";
                                echo "<td>".$tt['size']."</td>";
                          
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>

  </div>
    </div>
</div>
