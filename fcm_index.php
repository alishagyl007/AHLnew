<?php include 'header.php'; include 'assets/page/func.php'; ?>
<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title">Send Notification</h3>
            </div>
            <div class="col-md-6 important">
                <div class="whitebg">

            <form class="pure-form pure-form-stacked" method="get">
                <div class="form-group hidden">
                    <label for="redId">Firebase Reg Id</label>
                    <input type="text" id="redId" name="regId" class="form-control" placeholder="Enter firebase registration id">
                </div>
                <div class="form-group hidden">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter title" value="CampusJabber">

                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" rows="5" name="message" id="message" placeholder="Notification message!"></textarea>
                </div>
                    <input type="hidden" name="push_type" value="individual"/>
                    <button type="submit" class="btn btn-danger" name="sendnoti">Send</button>
            </form>
                    <?php
                    if(isset($_REQUEST['sendnoti'])){
    
    $message = mysql_real_escape_string($_REQUEST['message']);
    $schoolid = mysql_real_escape_string($_REQUEST['school']);
    
    $sql = "select * from `user`";
    $ex = mysql_query($sql);
    $c = mysql_num_rows($ex);

        require_once __DIR__ . '/fcm_firebase.php';
        require_once __DIR__ . '/fcm_push.php';
    while($row = mysql_fetch_assoc($ex)){
        $reg_id = $row['reg_id'];
        $message = $_REQUEST['message'];

        $firebase = new Firebase();
        $push = new Push();

        $payload = array();
        $payload['notification_type'] = 'Broadcast';
        $title = 'CampusJabber';
        $push_type = 'individual';
        
       
	$response1['body']=$message;
	$response1['title']='CampusJabber';


        $push->setTitle($title);
        $push->setMessage($message);
        
        $push->setImage('');
       
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);


        $json = '';
        $response = '';

        if ($push_type == 'topic') {
            $json = $push->getPush();
           $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            $regId =$reg_id;
            $firebase->send($regId, $json,$response1);
        }



    }
    }
                    ?>
                <?php if ($json != '') { ?>
                    <label><b>Notification send successfully:</b></label>
<?php } ?>                    
            <div class="fl_window hidden">
                <?php if ($json != '') { ?>
                    <label><b>Request:</b></label>
                    <div class="json_preview">
                        <pre><?php echo json_encode($json) ?></pre>
                    </div>
                <?php } ?>
                <?php if ($response != '') { ?>
                    <label><b>Response:</b></label>
                    <div class="json_preview">
                        <pre><?php echo json_encode($response) ?></pre>
                    </div>
                <?php } ?>

            </div>
            
        </div>
<?php include 'footer.php'; ?>