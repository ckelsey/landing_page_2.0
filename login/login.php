<?php
require '../inc/functions.php';

$json_params = file_get_contents("php://input");

if (strlen($json_params) > 0 && isValidJSON($json_params)) {
  $loginDetails = json_decode($json_params);
}

if(isset($loginDetails)) {
  $loginData = CallAPI("POST", "https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_cai_users/incoming_webhook/userLogin?secret=78174b9de7640e8b6277", array(
    "email" => $loginDetails->email,
    "password" => $loginDetails->pass,
    "session_id" => "abc123"       //   <== replace with incoming_traffic ID once site is live
  ));

  $loginJson = json_decode($loginData);

  if($loginJson->result) {
    http_response_code(200);
    header('Content-type: text/json');
    echo '{"token":"' . $loginJson->token . '"}';
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