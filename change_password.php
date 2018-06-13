<?php include 'header.php'; include 'assets/page/func.php'; ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title">Change Password</h3>
            </div>
            <div class="col-md-6 important">
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" name="oldpass" class="form-control" required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="newpass" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Repeat Password</label>
                            <input type="password" name="reppass" class="form-control" required>
                        </div>
                        <hr>
                        <div class="text-left">
                            <button type="submit" class="btn btn-danger" name="sbt">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; 

if(isset($_REQUEST['sbt'])){
    $oldpass = mysql_real_escape_string($_REQUEST['oldpass']);
    $newpass = mysql_real_escape_string($_REQUEST['newpass']);
    $reppass = mysql_real_escape_string($_REQUEST['reppass']);
    
    if($newpass == $reppass){
        
        $sql = mysql_query("select * from `admin` where `password` = '".$oldpass."' and `check` = 'checked' order by id asc limit 1");
        $result = mysql_num_rows($sql);
        if($result == '1'){
            mysql_query("UPDATE `admin` SET `password`='".$reppass."' WHERE `check` = 'checked'");
            header('Location: index.php');
        }else{
            echo "<script>alert('Old Password Not Match')</script>";
        }
        
    }else{
        echo "<script>alert('New Password and Repeat Password Not Match')</script>";
    }

}
?>