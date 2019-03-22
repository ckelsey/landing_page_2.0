<?php
require '../../inc/functions.php';

$_POST = json_decode(file_get_contents('php://input'), true);

$articleID = (isset($_POST['i']) and $_POST['i'])?$_POST['i']:'';
$vote = (isset($_POST['v']) and $_POST['v'])?$_POST['v']:'';

if($articleID != '' && $vote != null) {
  $voteEndpoint = ($vote == '1') ? 'up' : 'down';

  $result = CallAPI("POST", "https://classaction.zendesk.com/api/v2/help_center/articles/" . $articleID . "/" . $voteEndpoint . ".json", false, array(
    'Authorization: Basic amVyZW1pYWhAY2xhc3NhY3Rpb25hcHAuY29tL3Rva2VuOnc3eUFnR1NVUUpJRVhnM004bzdIeHRQRGhlSTI3Mjc2b0dDSXFMNFo='
  ));

  var_dump($result);
}

?>