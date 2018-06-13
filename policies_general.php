<?php include 'header.php'; include 'assets/page/func.php'; 
if($_GET['Add'] == 'Add'){ ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">Add Policy</h3>
                <div class="whitebg">
                    <form method="post" action="policies_general.php?Add=Add">
                    <div class="form-group">
                            <input type="text" name="mobile" class="form-control" placeholder="Mobile" required>
                        </div>
                        <div class="text-right">
                            <button type="submit" name="sbtuser" class="btn btn-default">Search User</button>
                        </div>
                        <?php
 if(isset($_REQUEST['sbtuser'])){
 $mobile=mysql_real_escape_string($_REQUEST['mobile']);
 $res=mysql_query("select * from user where mobile='$mobile'");
 
 $ttt = mysql_fetch_assoc($res);
 $result=$ttt['name'];
 $userid=$ttt['user_id'];
 $_SESSION['user_id'] = $userid;
 echo "Result: <input type='text' value='$result'/>";	
 

 
 } 
 ?>
                        </form>
                        
                        
                         <form method="post">
                           <div class="form-group">
                            <label>Policy Type</label>
                            <select class="form-control" name="school">
                                <?php
                                $selec = mysql_query("select * from policy_type order by id desc");
                                while($type= mysql_fetch_assoc($selec)){
                                        echo "<option value='".$type['id']."'>".$type['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>   
                        <div class="form-group">
                            <input type="text" name="vno" class="form-control" placeholder="Vehicle Number" required>
                        </div>
                        
                         <div class="form-group">
                            <input type="text" name="policyno" class="form-control" placeholder="Policy Number" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="amount" class="form-control" placeholder="Premimum Amount" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="tax" class="form-control" placeholder="Tax" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="total" class="form-control" placeholder="Total Amount" required>
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
                         <div class="form-group">
                            <input type="date" name="last_date" class="form-control" required>
                        </div>
                       
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Add Policy</button>
                        </div>
                    </form>
                </div>           
<?php
  if(isset($_REQUEST['sbt'])){
        $policyno= mysql_real_escape_string($_REQUEST['policyno']);
        $type_id = mysql_real_escape_string($_REQUEST['school']);
        $amount= mysql_real_escape_string($_REQUEST['amount']);
        $tax= mysql_real_escape_string($_REQUEST['tax']);
        $total= mysql_real_escape_string($_REQUEST['total']);
        $reference= mysql_real_escape_string($_REQUEST['reference']);
        $lastdate= mysql_real_escape_string($_REQUEST['last_date']);
        $vno= mysql_real_escape_string($_REQUEST['vno']);
         $vno= strtoupper($vno);
        $user_idd=$_SESSION['user_id'];
        mysql_query("INSERT INTO `policies_general`(`user_id`, `policy_no`, `expire_date`, `premium_amount`,`reference`,`policy_type_id`,`vehicleno`,`tax`,`total_amount`) 
        VALUES ('$user_idd','$policyno','$lastdate','$amount','$reference','$type_id','$vno','$tax','$total')");
        header('Location: policies_general.php?Add=Add');
?>
            <div class="col-md-12 text-center">
                <p><br>Policy Added</p>
            </div>
<?php } ?>
                    
                     
            </div>
            <div class="col-md-8">
                <h3 class="page_title"><a href="">All General Policies</a></h3>
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Vehicle No</th>
                                <th>Policy No</th>
                                <th>Premium Amount</th>
                                <th>Expire Date</th>
                                
                            </tr>
                            <?php
                            $topic = mysql_query("select a.vehicleno,a.policy_no,a.expire_date,a.premium_amount,b.name,b.mobile,c.name as type
 from policies_general a, user b,policy_type c where a.user_id=b.user_id and a.policy_type_id=c.id order by a.id desc
 limit 10");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['name']."</td>";                           
                                echo "<td>".$tt ['mobile']."</td>";
                                echo "<td>".$tt['vehicleno']."</td>";
                                echo "<td>".$tt['policy_no']."</td>";
                                 echo "<td>".$tt['premium_amount']."</td>";
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

<?php
include 'footer.php';
}else{
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title"><?php num_rows('1','policies_general') ?> - General Policies</h3>
            </div>
            <div class="col-md-12">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">                         
                            <tr>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Vehicle No</th>
                                <th>Policy No</th>
                                <th>Premium Amount</th>
                                <th>Date</th>
                                
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            <tbody>
                            <?php                            
                            $topic = mysql_query("select a.id,a.vehicleno,a.policy_no,a.expire_date,a.premium_amount,b.name,b.mobile,c.name as type
 from policies_general a, user b,policy_type c where a.user_id=b.user_id and a.policy_type_id=c.id order by a.id desc limit $start_from, $num_rec_per_page");
                            while($tt = mysql_fetch_assoc($topic)){
                                 echo "<tr>";
                                echo "<td>".$tt['name']."</td>";                           
                                echo "<td>".$tt ['mobile']."</td>";
                                echo "<td>".$tt['vehicleno']."</td>";
                                echo "<td>".$tt['policy_no']."</td>";
                                 echo "<td>".$tt['premium_amount']."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['expire_date']))."</td>";
                              
                            ?>
                            
                            <td class="text-center"><a href="edit_general_policy.php?id=<?php echo $tt['id']; ?>"><i class="material-icons">edit</i></a></td>
                          <td class="text-center"><a class="deletetopic" href="assets/page/disable.php?table=policies_general&id=<?php echo $tt['id']; ?>"><i class="material-icons">delete</i></a></td>
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