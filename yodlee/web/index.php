<?php
require("../../inc/config.php");

include '../../inc/template_start.php';
include '../../inc/page_head.php';

if(isset($_SESSION['YODLEE'])) {
	$yodleeUID = $_SESSION['YODLEE'];
} else {
	$yodleeUID = 'caitest01';    // <=== TESTING DEFAULT ONLY -- Setup session
}

?>
<style>
	.panel.accnames{
		background-border:none;
		box-shadow: none;
		margin-top:30px;
		width:auto;
		text-align: center;
	}
	.panel-heading.accdetails{
		height:50px;
	}

	.panel-heading.active {
		background-color: #2a658b;
		color: #FFF;
	}

	#accountsListDiv {
		max-height: 400px;
		overflow-y: auto;
	}

	.panel-heading.active > a {
		color: #FFF !important;
	}

	.table-responsive {
		max-height:295px;
		overflow-y: auto;
	}
</style>
<section class="site-content site-section" style="height:820px;background:#FFF;">
	<div class="container mt50">
		<div class="row  justify-content-center">
			<div id="loading_container" class="loading_no"></div>		
			<div class="col-md-12">
				<h2 class="text-primary mb20"><strong>My Linked Accounts</strong></h2>
			</div>
			<!--Link-Accounts-->
			<div class="col-md-3">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4 style="text-align: center;"><strong>Linked Accounts</strong></h4>
					</div>
					<div class="panel-body">

						<div align="center">
							<button type="button" id="fastlinkbutton"
									class="btn btn-primary" data-toggle="modal"
									data-target="#itMyModal"><strong>Link Account</strong></button>
						</div>
						<hr>
						<div id="accountsListDiv">
							<div class="panel panel-default accnames">
								<div class="panel-heading">
									<a href="#"><strong>Account Name</strong></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end-->

			<!--Account-details-->

			<div class="col-md-9">
				<div class="row">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4><strong>Account Details</strong></h4>
						</div>
						<div id="accountDetailsDiv" class="panel-body hidden">
							<div class="row">
								<div class="col-md-6">
									<div class="panel panel-default ">
										<div class="panel-heading accdetails">
											<strong class="pull-left">Account Name :</strong>
											<p class="pull-right mb0" id="accountName">XXXXXXX</p>
										</div>

									</div>
								</div>
								<div class="col-md-6">
									<div class="panel panel-default">
										<div class="panel-heading accdetails">
											<strong class="pull-left">Account Balance :</strong>
											<p class="pull-right" id="accountBalance">XXXXXXX</p>
										</div>
									</div>
								</div>
							</div>
							<!--<div class="row">
								<div class="col-md-6">
									<div class="panel panel-default ">
										<div class="panel-heading accdetails">
											<strong class="pull-left">Container :</strong>
											<p class="pull-right" id="accountContainer">XXXXXXX</p>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="panel panel-default">
										<div class="panel-heading accdetails">
											<strong class="pull-left">Account Type :</strong>
											<p class="pull-right" id="accountType">XXXXXXX</p>
										</div>
									</div>
								</div>
							</div>-->

							<div class="row">
								<div class="col-md-12" align="right">
									<div id="unlinkButtonDiv" data-accountId="123">
										<button id="unlinkButton" class="btn btn-warning"
												style="margin-left: 165px;" onClick="unlinkAccount();">Unlink
											Account</button>
									</div>
								</div>
							</div>

							<hr class="mb0">
							<!--Transaction-Summary-->

							<div class="row">
								<div class="panel mb0">
									<div class="panel-heading pt0">
										<h4 class="text-primary"><strong>Transaction Summary</strong></h4>

									</div>
									<div class="panel-body table-responsive pt0">
										<table class="table table-striped" id="txnTable">

											<thead>
											<tr>
												<th>Date</th>
												<th>Amount</th>
												<th>Category</th>
												<th>Description(Simple)</th>
												<th>Description(Original)</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td colspan="5">Select Account to load Transactions
													Data</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>

							<!--end-->
						</div>
						<div id="emptyAccountDetailsDiv" class="panel-body">
							<div class="alert alert-info">Select account from list to
								load account details and transactions</div>
						</div>
					</div>
				</div>
			</div>

			<!--end-->
		</div>
	</div>
</section>

<div id="unlinkAccountModal" class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" style="color:#000000; opacity: inherit;">&times;</button>
				<h4 class="modal-title"><strong>Unlink Account</strong></h4>
			</div>
			<div class="modal-body">
				<p>Account unlinked successfully.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<div id="itMyModal" class="modal fade"  tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="close-button">
					<button type="button" id="closeFastlink"  data-dismiss="modal" aria-label="Close" class="close" ><span aria-hidden="true"><b>&#x2715;</b></button>
				</div>
				<div class="embed-responsive embed-responsive-4by3">
					<div id="container-fastlink"></div>

				</div>
			</div>
		</div>
	</div>
</div>

<?php include '../../inc/page_footer.php'; ?>
<?php include '../../inc/template_scripts.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="https://cdn.yodlee.com/v1/fastlink/initialize.js"></script>
<script>
	//Load user selected account details and then call to get transactions for selected account
	function loadAccount(accountId, type, amount, container, name) {
		$("#accountType").text(type);
		$("#accountName").text(name);
		if(container!="insurance"){
			$("#accountBalance").text("$" + amount.toLocaleString('en'));
		}

		$("#accountContainer").text(container);
		$('#unlinkButtonDiv').data('accountId',accountId); //setter

		$('#emptyAccountDetailsDiv').addClass("hidden");
		$('#accountDetailsDiv').removeClass("hidden");

		$('#txnTable tbody').remove();
		$("#txnTable").append('<tbody><tr><td colspan="5" class="text-center"><div align="center" class="alert alert-info"><p>Loading Transactions....<i class="fa fa-spinner fa-spin" style="font-size:24px"></i></p></div></td></tr></tbody>');

		$.get( "../YodleeSampleApp.php",{ action: "getTransactions",accountId:accountId} ).done(function( data ) {
			//data = data.replace(/\'/g, '\"');
			var responseObj = jQuery.parseJSON(data);
			var trHTML = '';
			
			$.each(responseObj.transaction, function (i, item) {
					trHTML += '<tr><td>' + formatStrToDteTimeStr(item.transactionDate) + '</td><td class="text-right">$' + item.amount.amount + '</td><td>' + item.category + '</td><td>' + (item.description.simple || '') + '</td><td>' + item.description.original + '</td></tr>';
			});

			//$('#txnTable tbody').empty();
			$('#txnTable tbody').remove();
			$("#txnTable").append('<tbody>'+trHTML+'</tbody>');
		});
	}

	//calls sample app user definded function to unlink selected account.
	function unlinkAccount(){

			//window.console.log('unlink acct');
			var id =  $('#unlinkButtonDiv').data('accountId');

			$.get( "../YodleeSampleApp.php",{ action: "deleteAccount", accountId:id} )
					.done(function( data ) {

							$('#unlinkAccountModal').modal('show')
					});

	}

	function formatStrToDteTimeStr(strInput, bJustDate = false) {
    if(strInput == null) { return ''; }

    let temp = moment(strInput);

    if(bJustDate) {
      // return temp.format("MMM DD YYYY");
      return temp.format("MM/DD/YY");
    } else {
      // return temp.format("MMM DD YYYY hh:mm:ss a");
      return temp.format("MM/DD/YY");
    }
  }


	$(document).ready(function(){
		//Launch FastLink
			$('#fastlinkbutton').click(function() {
				$.get("../YodleeSampleApp.php",{ action: "getFastLinkToken"}).done(function( data ) {
					var fastlinkTokensObj = data;
					console.log("FastLink token is:" +fastlinkTokensObj.jwtToken)
					window.fastlink.open({
						fastLinkURL: fastlinkTokensObj.nodeUrl,
						jwtToken: fastlinkTokensObj.jwtToken,
						params: fastlinkTokensObj.dataset,
						onSuccess: function (data) {
							console.log(data);
						},
						onError: function (data) {
							console.log(data);
						},
						onExit: function (data) {
							console.log(data);
							document.getElementById('btn-close').style.display = "none";
							document.getElementById('loader').style.display = "none";
							document.getElementById('btn-fastlink').style.display = "block";
						},
						onEvent: function (data) {
							console.log(data);
						}
					}, 'container-fastlink')
				});
			});

			//reload after fastlink close to trigger loading newly added accounts.
			$("#closeFastlink").click(function() {
					location.reload();
			});

			//reload after unlinking account to do fresh get accounts call.
			$('#unlinkAccountModal').on('hidden.bs.modal', function (e) {
					location.reload();
			})

			$('#loading_container').removeClass('loading_no').addClass('loading_yes');
			$.post("../YodleeSampleApp.php",{ username:'<?= $yodleeUID ?>'}).then(data => {    
				//Load user accounts in Sample Web App
				$.get( "../YodleeSampleApp.php",{ action: "getAccounts"} )
				.done(function( data ) {
					data = data.replace(/\'/g, '\"');
					var responseObj = jQuery.parseJSON(data);

					$("#accountsListDiv").empty();

					var accountsListHTML = "";

					$.each(responseObj.account, function (i, item) {
						var paramsList=null;
						if(item.CONTAINER!="insurance" && item.CONTAINER!="reward" ){
							paramsList = "'"+item.id+"', '"+item.accountType+"', '"+item.balance.amount+"', '"+item.CONTAINER+"', '"+item.accountName+"'";
						}
						else {
							paramsList = "'"+item.id+"', '"+item.accountType+"', '"+"null"+"', '"+item.CONTAINER+"', '"+item.accountName+"'";
						}

						accountsListHTML += '<div class="panel panel-default accnames"><div class="panel-heading"><a href="#" onClick="loadAccount('+paramsList+');backgroundColor(this);" ><strong>'+item.accountName+'</strong></a></div></div>';
					});

					$("#accountsListDiv").html(accountsListHTML);
					$('#loading_container').removeClass('loading_yes').addClass('loading_no');
				});
			});
	});

	function backgroundColor(element){
		$('.panel-heading').removeClass('active');
		$(element).parent().addClass('active');
	}

	/*$('#txnTable tbody').slimscroll({
		height: '160px',
		width: '100%',
		alwaysVisible: true,
		color: '#333'
	})*/
</script>
<?php include '../../inc/template_end.php'; ?>