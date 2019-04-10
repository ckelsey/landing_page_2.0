<?php
require '../inc/functions.php';

$json_params = file_get_contents("php://input");

if (strlen($json_params) > 0 && isValidJSON($json_params)) {
  $registerDetails = json_decode($json_params);
}

if(isset($registerDetails)) {
  //register user first
  $registerData = CallAPI("POST", "https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_cai_users/incoming_webhook/addUser?secret=95785b96f6a42f559674", array(
    "email" => $registerDetails->email,
    "password" => $registerDetails->pass,
    "id" => $registerDetails->id,
    "fname" => $registerDetails->fname,
    "lname" => $registerDetails->lname,
  ));

  //then signin
  $registerData = CallAPI("POST", "https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_cai_users/incoming_webhook/userLogin?secret=78174b9de7640e8b6277", array(
    "email" => $registerDetails->email,
    "password" => $registerDetails->pass,
    "id" => "abc123"       //   <== replace with incoming_traffic ID once site is live
  ));

  $registerJson = json_decode($registerData);

  if($registerJson->result) {
    if(!isset($_SESSION)) { session_start(); }
    $_SESSION['EMAIL'] = $registerDetails->email;
    $_SESSION['LAST_ACTIVITY'] = time();
    $_SESSION['CREATED'] = time();
    $_SESSION['USERID'] = $registerJson->uid;
    $_SESSION['TOKEN'] = $registerJson->token;

    http_response_code(200);
    header('Content-type: text/json');
    echo '{"token":"' . $registerJson->token . '"}';
  } else {
    http_response_code(500);
    header('Content-type: text/json');
    echo '{"error":"Invalid email address and/or password."}';
  }
} else {
  http_response_code(500);
  header('Content-type: text/json');
  echo '{"error":"Invalid email address and/or password."}';
}

?>