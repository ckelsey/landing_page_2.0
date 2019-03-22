<?php

require '../inc/functions.php';
require '../vendor/autoload.php';

use Zendesk\API\HttpClient as ZendeskAPI;

$subdomain = "classaction";
$username  = "jeremiah@classactionapp.com"; 
$token     = "w7yAgGSUQJIEXg3M8o7HxtPDheI27276oGCIqL4Z"; 

$client = new ZendeskAPI($subdomain);
$client->setAuth('basic', ['username' => $username, 'token' => $token]);

$name = (isset($_POST['contact-name']) and $_POST['contact-name'])?$_POST['contact-name']:'';
$email = (isset($_POST['contact-email']) and $_POST['contact-email'])?$_POST['contact-email']:'';
$msg = (isset($_POST['contact-message']) and $_POST['contact-message'])?$_POST['contact-message']:'';

$userData = CallAPI("POST", "https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_cai_users/incoming_webhook/getUser?secret=31df8cbafe14b5f144ab", array(
  "email" => $email
));

$json = json_decode($userData);
$body = $msg . '<br /><br /><strong>Email:</strong> ' . $email;

if($json->email_current) {
  //contact is a user in our system
  $body .= '<br /><strong>User ID:</strong> ' . $json->user_id;
  $body .= '<br /><strong>First Name:</strong> ' . $json->fname;
  $body .= '<br /><strong>Last Name:</strong> ' . $json->lname;
  $body .= '<br /><strong>Email Confirmed:</strong> ' . ($json->email_conf ? 'Yes' : 'No');
  $body .= '<br /><strong>Client:</strong> ' . ($json->client_YN ? 'Yes' : 'No');
} else {
  //contact was not found in our system
  $body .= '<br /><strong>Name:</strong> ' . $name;
}

try {
  $requestor_id = -1;

  // Search the current customer
  $params = array('query' => $email);
  $search = $client->users()->search($params);
  
  // verify if this email address exists
  if (empty($search->users)) {
    $query = $client->users()->create(
      [
        'name' => $name,
        'email' => $email,
        'role'  => 'end-user'
      ]
    );

    if(isset($query->user) && isset($query->user->id)) {
      $requestor_id = $query->user->id;
    } else {
      $requestor_id = null;
    }
  } else {
      foreach ($search->users as $zdUser) {
        //should only be 1, but using a loop to be safe
        $requestor_id = $zdUser->id;
      }
  }
  
  // Create a new ticket
  $newTicket = $client->tickets()->create([
      'tags'  => array('website_contact_form'),
      'subject'  => 'New Message - Website Contact Form',
      'comment'  => array(
          'html_body' => $body,
          'public' => false
      ),
      'requester_id' => $requestor_id,
      'priority' => 'normal',
      'is_public' => false
  ]);
} catch (\Zendesk\API\Exceptions\ApiResponseException $e) {
  echo $e->getMessage().'</br>';
}

?>