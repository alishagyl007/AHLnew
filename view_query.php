<?php include 'header.php'; include 'assets/page/func.php'; 
$query_id = $_GET['id'];
$query= mysql_query("select a.id,a.name,a.mobile,a.email,b.name as pname from queries a,product b where a.product_id=b.id and a.id = $query_id");
$tt = mysql_fetch_assoc($query);

?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
           <div class="col-md-8 text-center">
                   <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                           <label for="name"><?php echo $tt['name']; ?></label>
                        </div>
                        <div class="form-group">
                           <label for="email"><?php echo $tt['email']; ?></label>
                        </div>
                        <div class="form-group">
                           <label for="mobile"><?php echo $tt['mobile']; ?></label>
                        </div>
                        <div class="form-group">
                           <label for="pname"><?php echo $tt['pname']; ?></label>
                        </div>
                        
                        
                    </form>
                    </div>
                    </div>
                    
               <div class="col-md-8 text-center">
               
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Follow Date</th>
                                <th>Follow Time</th>
                                <th>Comment</th>
                                
                            </tr>
                            <?php
                            $topic = mysql_query("select * from query_details where qid='$query_id' order by id desc");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['followdate']."</td>";                           
                                echo "<td>".$tt ['followtime']."</td>";
                                echo "<td>".$tt['comment']."</td>";
                              
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>                
            </div>
            <div class="col-md-4 important">
                <h3 class="page_title">Add Follow up</h3>
                <div class="whitebg">
                    <form method="post">
                    
                        
                        
                             <div class="form-group">
                             <label>Follow up date</label>
                            <input type="date" name="follow_date" class="form-control" >
                        </div>
                         <div class="form-group">
                             <label>Follow up time</label>
                        <input type="time" name="follow_time" class="form-control" >
                        </div>
                        
                         <div class="form-group">
                           <label>Comment</label>
                            <textarea required name="comment" autofocus class="form-control" placeholder="Enter Comment" rows="5"></textarea>
                        </div>
                                          
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Save</button>
                        </div>
                    </form>
                </div>                                
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php';

if(isset($_REQUEST['sbt'])){
   
    
    $fdate=mysql_real_escape_string($_REQUEST['follow_date']);
    $ftime=mysql_real_escape_string($_REQUEST['follow_time']);
    $comment=mysql_real_escape_string($_REQUEST['comment']);
   
    
   
   
   
    mysql_query("INSERT INTO `query_details`(`qid`, `followdate`, `followtime`, `comment`) VALUES ('$query_id ','$fdate','$ftime','$comment')");
   
    
   


}

?>