<?php
require("../../inc/config.php");

include '../../inc/template_start.php';
include '../../inc/page_head.php';
?>

<section class="site-content site-section" style="height:820px;background:#FFF;">
	<div class="container" style="margin-top: 5%;">
		<div class="col-md-4 offset-md-4">
			<div class="card border-primary">
				<div class="card-header text-white bg-primary">Cobrand Login</div>
				<div class="card-body">

					<div class="row">
						<div class="col-xs-12">
							<div id="initCheck" class="alert alert-success">
								<p>Provide username from Yodlee API dashboard page</p>
							</div>
						</div>
					</div>
					<!-- Login Form -->

					<!-- Username Field -->
					<div class="row">
						<div class="form-group col-12">
							<label for="username"><span class="text-danger" style="margin-right: 5px;">*</span>Username:</label>
							<div class="input-group">
								<div class="input-group-text bg-primary text-white" id="btnGroupAddon"><i class="fa fa-user"></i></div><input class="form-control" id="username" type="text" name="username"
									   autofocus placeholder="Username" required>
							</div>
						</div>
					</div>


					<!-- Login Button -->
					<div class="row">
						<div class="form-group col-12">
							<button id="submitButton" class="btn btn-primary" type="button">Login</button>
						</div>
					</div>

					<!-- End of Login Form -->

				</div>
			</div>
		</div>
	</div>
</section>
<?php include '../../inc/page_footer.php'; ?>
<?php include '../../inc/template_scripts.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script>

$(document).ready(function(){
	//User login
	$('#submitButton').click(function() {
		var userName = $("#username").val();
		$('#submitButton').prop('disabled', true);
		$('#submitButton').html("Loading...");
	
		$.post("../YodleeSampleApp.php",{ username:userName} ).done(function( data ) {

			var dataObj = data;
			console.log("Data is :" +dataObj)
			console.log("Data error :" +dataObj.error)

			if(dataObj && dataObj.error && dataObj.error == "false"){
				//window.location.href="accounts.html";
			}else{
				$("#initCheck").removeClass("alert-info");
				$("#initCheck").addClass("alert-danger");
				$("#initCheck").append("<p>Error in User login, please check user/key details(from Yodlee API Dashboard)..</p>");

				$('#submitButton').prop('disabled', false);
				$('#submitButton').html("Login");
			}  
		});  
	});
		
	$("#username").keyup(function(event){
		if(event.keyCode == 13) {
			$("#submitButton").click();
		}
	});
	
	$("#password").keyup(function(event){
		if(event.keyCode == 13) {
			$("#submitButton").click();
		}
	});
});

</script>
<?php include '../../inc/template_end.php'; ?>