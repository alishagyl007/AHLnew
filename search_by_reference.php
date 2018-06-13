<?php include 'header.php'; include 'assets/page/func.php'; 
$user_id = $_GET['id']; 
$sql = mysql_query("select * from user where user_id = '$user_id'");
$user = mysql_fetch_assoc($sql);
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">Search General Polices</h3>
                <div class="whitebg">
                    <form method="post">
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
                        <div class="form-group">
                             <label>From Date</label>
                            <input type="date" class="form-control" name="sdate" required>
                        </div>
                        <div class="form-group">
                            <label>To Date</label>
                            <input type="date" class="form-control" name="edate" required>
                        </div>
                        
                                          
                        <div class="text-right">
                            <button type="submit" name="btnname" class="btn btn-default">Search</button>
                        </div>
                    </form>
                </div>                                
            </div>
           
           
            </div>
      
<?php include 'footer.php';

if(isset($_REQUEST['btnname'])){
$reference=mysql_real_escape_string($_REQUEST['reference']);
$sdate=mysql_real_escape_string($_REQUEST['sdate']);
$edate=mysql_real_escape_string($_REQUEST['edate']);

 $topic = mysql_query("select * from policies_general a,user b where a.user_id=b.user_id and a.reference='$reference' and a.timestamp between '$sdate' and '$edate'  order by a.id desc");
   
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
                                <th>Tax</th>
                                <th>Total Amount</th>
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
                                echo "<td>".$tt['tax']."</td>";
                                echo "<td>".$tt['total_amount']."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['expire_date']))."</td>";
                               
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
