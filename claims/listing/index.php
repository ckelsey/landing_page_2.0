<?php
require("../../inc/config.php");

include '../../inc/template_start.php';
include '../../inc/page_head.php';

$userData = CallAPI("POST", "https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/svc_cai_users/incoming_webhook/getMyClaims?secret=5c60b2380c650a740cb6d465", array(
  "user_id" => $_SESSION['UID']
));

//$json = json_decode(stripslashes(json_decode($userData)));
//var_dump($json);

if (strlen($userData) <= 0 || !isValidJSON($userData)) {
  $bNoData = true;
}

?>

<section class="site-content site-section" style="height:820px;background:#FFF;">
  <div class="container" style="margin-top:75px;">
    <div class="row mb30">
      <a href="/clarence/?<?= base64_encode("bptkn=" . $_SESSION['TOKEN']) ?>" class="btn btn-lg btn-success btn-alt pull-right">Find Settlements</a>
    </div>
    <h2 class="text-primary mb20"><strong>My Claims</strong></h2>
    <?php
    if(isset($bNoData) && $bNoData) { ?>
      <h3 class="text-primary">Uh-oh! You haven't filed any claims with us yet. Click the 'Find Settlements' button to get started!</h3>
    <?php } else { ?>
      <table id="claims-listing" class="table table-vcenter table-condensed table-hover"></table>
    <?php } ?>
  </div>
</section>

<?php include '../../inc/page_footer.php'; ?>
<?php include '../../inc/template_scripts.php'; ?>
<script>
  const claimData = JSON.parse(<?= $userData ?>);
  console.log(claimData);

  App.datatables();
  let data = Array();

  $.each(claimData.claimData, function(idx, item) {
    let sett = claimData.settsData.find(x => x.settlement_id == item.settlement_id);

    const estPerItem = sett.CAA_calculations.est_amt_per_item;
    const darFlag = sett.CAA_calculations.use_claimData_for_DAR;
    let estValue = '$0.00';

    if(darFlag) {
      estValue = Object.keys(item.clientClaims.claimData).map(x => {
        return (parseFloat(item.clientClaims.claimData[x]) * estPerItem);
      }).reduce((partial_sum, a) => partial_sum + a).toFixed(2);
    } else {
      estValue = '$' + estPerItem.toLocaleString('en');
    }

    data.push({
      Settlement_Name: sett.settlement_name,
      Claim_Date: formatStrToDteTimeStr(item.clientClaims.createTS),
      Status: 'Filing Preparation',
      //final_approval_hearing: formatStrToDteTimeStr(sett.settlement_timeline.dateValue, true),
      Estimated_Settlement_Amount: '$' + estValue.toLocaleString('en')
    })
  });

  $('#claims-listing').DataTable({
    data: data,
    columnDefs: [
        { sClass: "text-center", targets: [3] },
        { targets: '_all', orderable: true, createdCell: function (td, cellData, rowData, row, col) {
                $(td).css('padding', '2px 10px')
            }
        }
    ],
    columns: Object.keys(data[0]).map(x => {
        return {data:x, title: x.replace(/_/g," ")};
    })
  });

  function formatStrToDteTimeStr(strInput, bJustDate = false) {
    if(strInput == null) { return ''; }

    let temp = moment(strInput);

    if(bJustDate) {
      return temp.format("MMM DD YYYY");
    } else {
      return temp.format("MMM DD YYYY hh:mm:ss a");
    }
  }

  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }
</script>
<?php include '../../inc/template_end.php'; ?>