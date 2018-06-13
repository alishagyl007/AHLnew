<?php include 'header.php'; include 'assets/page/func.php'; ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title">Send Notification</h3>
            </div>
            <div class="col-md-6 important">
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>School</label>
                            <select class="form-control" name="school" required>
                                <option value="" class="hidden">-- Select School --</option>
                                <?php
                                $school = mysql_query("select * from `school`");
                                while($ss = mysql_fetch_assoc($school)){
                                    echo "<option value='".$ss['id']."'>".$ss['name']."</option>";
                                }
                                ?>
                            </select>                            
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" class="form-control" rows="7" required></textarea>
                        </div>
                        <hr>
                        <div class="text-left">
                            <button type="submit" class="btn btn-danger" name="sbt">Send Notification</button>
                            <h3 class="text-danger">Notification Send Successfully...</h3>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>.text-danger{display:none;font-weight: 100;}</style>
<?php include 'footer.php'; 
    
if(isset($_REQUEST['sbt'])){
    
    $message = mysql_real_escape_string($_REQUEST['message']);
    $schoolid = mysql_real_escape_string($_REQUEST['school']);
    
    $sql = "select * from `user` where `school_id` = '$schoolid' and `is_varify` = '1'";
    $ex = mysql_query($sql);
    $c = mysql_num_rows($ex);
    while($row = mysql_fetch_assoc($ex)){
        $requestid = $row['reg_id'];
        $title = "Title";
        $url = 'https://gcm-http.googleapis.com/gcm/send';
        $role = 'news';
        /*
        $post = '{"to":"'.$requestid.'","priority":"high","content_available":true,"time_to_live":2419200,"data":{"title":"Sunflower","message":"'.$message.'","role":"'.$role.'"}}';             
        
        $headers = array("Authorization:key=AIzaSyC5ONWHyj0Y6Ttmbp3H20S21k1ZVDbZnSI",'Content-Type:application/json');
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $result = curl_exec($ch);
        if(curl_errno($ch)){
            echo 'GCM error: '.curl_error($ch);
        }
        curl_close( $ch );
        */
    }
    echo "<style>.text-danger{display:block}</style>";
}
?>