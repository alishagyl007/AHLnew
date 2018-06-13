<?php


class Firebase {

    // sending push message to single user by firebase reg id
    public function send($to, $message,$response1) {
    
    					$response['to']=$to;
	                 	$response['priority']='high';
	                 	$response['content_available']=true;
	                 	$response['notification']=$response1;
	                 	$response['data']=$message;
        
        return $this->sendPushNotification(json_encode($response));
    }

  
    // function makes curl request to firebase servers
    private function sendPushNotification($fields) {
    
  
        require_once __DIR__ . '/config.php';

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;
    }
}

?>