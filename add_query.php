<?php include 'header.php'; include 'assets/page/func.php'; 

?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">Add Query</h3>
                <div class="whitebg">
                    <form method="post">
                    <div class="form-group">
                            <select class="form-control" required name="product_id">
                                <option value="" class="hidden">-- Select Product--</option>
                                <?php
                                $topic = mysql_query("select * from product order by id desc");
                                while($tt = mysql_fetch_assoc($topic)){
                                    echo "<option value='".$tt['id']."'>".$tt['name']."</option>";
                                }
                                ?>
                            </select>
                            </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" class="form-control" name="mobile" value="<?php echo $user['mobile']; ?>" required>
                        </div>
                        
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
    $name = mysql_real_escape_string($_REQUEST['name']);
    $email = mysql_real_escape_string($_REQUEST['email']);
    $mobile= mysql_real_escape_string($_REQUEST['mobile']);
    $product= mysql_real_escape_string($_REQUEST['product_id']);
    
    $fdate=mysql_real_escape_string($_REQUEST['follow_date']);
    $ftime=mysql_real_escape_string($_REQUEST['follow_time']);
    $comment=mysql_real_escape_string($_REQUEST['comment']);
   
    
   
   
    mysql_query("INSERT INTO `queries`(`name`, `email`, `mobile`, `product_id`) VALUES ('$name','$email','$mobile','$product')");
   $id=mysql_insert_id();
    mysql_query("INSERT INTO `query_details`(`qid`, `followdate`, `followtime`, `comment`) VALUES ('$id','$fdate','$ftime','$comment')");
   
    
   


}

?>