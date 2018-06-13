<?php include 'header.php'; include 'assets/page/func.php'; 
$id = $_GET['id']; 
$sql = mysql_query("select * from policies_general  where id = '$id'");
$ipo = mysql_fetch_assoc($sql);
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-6 important">
                <h3 class="page_title">Edit General Policy</h3>
                <div class="whitebg">
                    <form method="post">
                 
                      <div class="form-group">
                        <label>Vehicle No</label>
                            <input type="text" name="vehicleno" class="form-control" required value="<?php echo $ipo['vehicleno'];?>" />
                        </div>
                        <div class="form-group">
                        <label>Policy Number</label>
                            <input type="text" name="policy_no" class="form-control" required value="<?php echo $ipo['policy_no'];?>" />
                        </div>
                        <div class="form-group">
                        <label>Preimum Amount</label>
                            <input type="text" name="premium_amount" class="form-control" required value="<?php echo $ipo['premium_amount'];?>" />
                        </div>
                        <div class="form-group">
                        <label>Policy Expire Date</label>
                            <input type="date" name="last_date" class="form-control" value="<?php echo $ipo['expire_date'];?>" />
                        </div>                     
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Update</button>
                        </div>
                    </form>
<?php
if(isset($_REQUEST['sbt'])){
    $vehicleno= mysql_real_escape_string($_REQUEST['vehicleno']);
    $policy_no= mysql_real_escape_string($_REQUEST['policy_no']);
    $premium_amount= mysql_real_escape_string($_REQUEST['premium_amount']);
    $lastdate= mysql_real_escape_string($_REQUEST['last_date']);
    
    mysql_query("UPDATE `policies_general` SET `vehicleno`='$vehicleno',`policy_no`='$policy_no',`expire_date`='$lastdate',`premium_amount`='$premium_amount' WHERE id='$id'");
    header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
   }   

?>

           
                </div>                                
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>