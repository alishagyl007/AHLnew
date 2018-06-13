<?php include 'header.php'; include 'assets/page/func.php'; 

?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">Add Doctor</h3>
                <div class="whitebg">
                    <form method="post">
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
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" required>
                        </div>
                                          
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Add</button>
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
     $address =mysql_real_escape_string($_REQUEST['address']);
    $city = mysql_real_escape_string($_REQUEST['city']);
    
    if($n_pass == $r_pass){
   
    mysql_query("INSERT INTO `doctors`(`name`, `address`, `city`, `contactno`, `email`) VALUES ('$name','$address','$city','$mobile','$email')");
   
    header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);

   
    
     }else{
        echo "<script>alert('Password Not Match...')</script>";
}

}

?>