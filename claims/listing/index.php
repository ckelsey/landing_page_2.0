<?php
require("../../inc/config.php");

//'', JSON.stringify({user_id:userID})

$userData = CallAPI("POST", "https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_cai_users/incoming_webhook/getUserByID?secret=a69cbb6bf35c32be34d1", array(
  "user_id" => "667677424"
));

$json = json_decode(stripslashes(json_decode($userData)));
//var_dump($json);
$sessionActive = true;

include '../../inc/template_start.php';
include '../../inc/page_head.php';

?>

<section class="site-content site-section" style="height:820px;background:#FFF;">
  <div class="container" style="margin-top:135px;">
  <h2 class="text-primary"><strong>My Claims</strong></h2>
    <table class="table table-vcenter table-condensed table-hover">
      <tr>
        <th style="background:#FFF;">Claim</th>
        <th style="background:#FFF;">Submission Date</th>
        <th style="background:#FFF;">Status</th>
        <th style="background:#FFF;">Actions</th>
      </tr>
      <tr>
        <td>Optical Disk Drive</td>
        <td>Feb 12, 2019 10:33 AM</td>
        <td>Filing Preparation</td>
        <td>
          <div class="btn-group">
            <a href="#" title="Edit" class="btn btn-xs btn-primary btnEdit"><i class="fa fa-pencil"></i></a>
            <a href="#" title="Cancel" class="btn btn-xs btn-danger btnDelete"><i class="fa fa-trash"></i></a>
          </div>
        </td>
      </tr>
      <tr>
        <td>Lithium Ion Battery</td>
        <td>Feb 3, 2019 11:03 AM</td>
        <td>Filing Preparation</td>
        <td>
          <div class="btn-group">
            <a href="#" title="Edit" class="btn btn-xs btn-primary btnEdit"><i class="fa fa-pencil"></i></a>
            <a href="#" title="Cancel" class="btn btn-xs btn-danger btnDelete"><i class="fa fa-trash"></i></a>
          </div>
        </td>
      </tr>
      <tr>
        <td>Dial Soap</td>
        <td>Mar 1, 2019 1:43 PM</td>
        <td>Filing Preparation</td>
        <td>
          <div class="btn-group">
            <a href="#" title="Edit" class="btn btn-xs btn-primary btnEdit"><i class="fa fa-pencil"></i></a>
            <a href="#" title="Cancel" class="btn btn-xs btn-danger btnDelete"><i class="fa fa-trash"></i></a>
          </div>
        </td>
      </tr>
    </table>
  </div>
</section>

<?php include '../../inc/page_footer.php'; ?>
<?php include '../../inc/template_scripts.php'; ?>
<?php include '../../inc/template_end.php'; ?>