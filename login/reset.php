<?php
require '../inc/functions.php';

$json_params = file_get_contents("php://input");

if (strlen($json_params) > 0 && isValidJSON($json_params)) {
  $resetDetails = json_decode($json_params);
}

if(isset($resetDetails)) {
  $resetData = CallAPI("POST", "https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_cai_users/incoming_webhook/requestPasswordReset?secret=e1338af071415f776d09", array(
    "email" => $resetDetails->email
  ));

  $resetJson = json_decode($resetData);

  if($resetJson) {
    http_response_code(200);
    header('Content-type: text/json');
    echo '{"msg":"Please check your email for the password reset link."}';
  } else {
    http_response_code(500);
    header('Content-type: text/json');
    echo '{"error":"Uh-oh! We could not find your email address."}';
  }
} else {
  http_response_code(500);
  header('Content-type: text/json');
  echo '{"error":"Uh-oh! We could not find your email address."}';
}

?>