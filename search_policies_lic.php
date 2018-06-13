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
                <h3 class="page_title">Search By Mobile</h3>
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
 $topic = mysql_query("select * from user_policies a,user b where a.user_id=b.user_id and b.name LIKE '%$name%' and a.policy_type LIKE 'Life' order by a.policy_id desc limit 10");
   
    }

if(isset($_REQUEST['btnmobile'])){
    $mobile=mysql_real_escape_string($_REQUEST['mobile']);
    $topic = mysql_query("select * from user_policies a,user b where a.user_id=b.user_id and b.mobile LIKE '%$mobile%' and a.policy_type LIKE 'Life' order by a.policy_id desc limit 10");
 
}

if(isset($_REQUEST['btndate'])){
    $sdate=mysql_real_escape_string($_REQUEST['sdate']);
    $topic = mysql_query("select * from user_policies a,user b where a.user_id=b.user_id and a.premium_duedate LIKE '%$sdate%' and a.policy_type LIKE 'Life' order by a.policy_id desc limit 10");
}

?>
<div class="col-md-12">
                <h3 class="page_title"><a href="topics.php">All Policies</a></h3>
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Policy No</th>
                                <th>Premium Amount</th>
                                <th>Policy Date</th>
                                
                            </tr>
                            <?php
                           
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['name']."</td>";   
                                 echo "<td>".$tt['mobile']."</td>";
                                  echo "<td>".$tt['email']."</td>";                        
                                echo "<td>".$tt ['policy_no']."</td>";
                                echo "<td>".$tt['premium_amount']."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['premium_duedate']))."</td>";
                               
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