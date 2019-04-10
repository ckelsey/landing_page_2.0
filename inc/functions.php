<?php

function CallAPI($method, $url, $data = false, $headers = array())
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data) {

                if(is_array($data)) {
                    $data = json_encode($data);
                }

                array_push($headers, 'Content-Type: application/json', ('Content-Length: ' . strlen($data)));

                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    if(is_array($headers) && count($headers) > 0) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

function isValidJSON($str) {
    json_decode($str);
    return json_last_error() == JSON_ERROR_NONE;
}

function isAnyUserLoggedIn() {
	$userId = (isset($_SESSION['USERID']) && $_SESSION['USERID'])?$_SESSION['USERID']:'';
	$lastActivity = (isset($_SESSION['LAST_ACTIVITY']) && $_SESSION['LAST_ACTIVITY'])?(time() - $_SESSION['LAST_ACTIVITY']):9999;

	if ($userId != '') {
        //set 120 minute limit since last login/activity
        if($lastActivity < 7200) {
            if(!isset($_SESSION['FULLNAME'])) {
                $userData = CallAPI("POST", "https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_cai_users/incoming_webhook/getUser?secret=31df8cbafe14b5f144ab", array(
                    "email" => $_SESSION['EMAIL']
                ));
                
                $json = json_decode($userData);
                $_SESSION['FULLNAME'] = $json->fname . ' ' . $json->lname;
                $_SESSION['UID'] = $json->user_id;
                $_SESSION['CLAIMCNT'] = $json->claimcount;
            }

            $_SESSION['LAST_ACTIVITY'] = time();

            if (!isset($_SESSION['CREATED'])) {
                $_SESSION['CREATED'] = time();
            } else if (time() - $_SESSION['CREATED'] > 1800) {
                // session started more than 30 minutes ago - change session id for security
                session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
                $_SESSION['CREATED'] = time();  // update creation time
            }

            return true;
        } else {
            session_unset();
            session_destroy();
            return false;
        }
    } else {
        session_unset();
        session_destroy();
        return false;
    }
}

?>