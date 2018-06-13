<?php include 'header.php'; include 'assets/page/func.php'; 
$user_id = $_GET['id']; 
$sql = mysql_query("select * from user where user_id = '$user_id'");
$user = mysql_fetch_assoc($sql);
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">Edit User</h3>
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
                                          
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Update</button>
                        </div>
                    </form>
                </div>                                
            </div>
            <div class="col-md-4 important">
                <h3 class="page_title">Change Password</h3>
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="text" class="form-control" name="n_pass" required>
                        </div>
                        <div class="form-group">
                            <label>Repeat Password</label>
                            <input type="text" class="form-control" name="r_pass" required>
                        </div>
                        <div class="text-right">
                            <button type="submit" name="sub" class="btn btn-default">Update Password</button>
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
    mysql_query("UPDATE `user` SET `name`='$name', `email`='$email', `mobile`='$mobile' WHERE `user_id` = '$user_id'");
    header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
}

if(isset($_REQUEST['sub'])){
    $n_pass = md5(mysql_real_escape_string($_REQUEST['n_pass']));
    $r_pass = md5(mysql_real_escape_string($_REQUEST['r_pass']));
    if($n_pass == $r_pass){
        mysql_query("UPDATE `user` SET `password`='$r_pass' WHERE `user_id` = '$user_id'");
        header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    }else{
        echo "<script>alert('Password Not Match...')</script>";
    }
}

?>